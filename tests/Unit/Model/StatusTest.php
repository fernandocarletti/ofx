<?php

declare(strict_types=1);

namespace Ofx\Tests\Unit\Model;

use Ofx\Enum\Severity;
use Ofx\Model\Common\Status;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Unit tests for Status model.
 *
 * Tests the isSuccess() and isError() methods:
 * - isSuccess() returns true when code is 0
 * - isError() returns true when severity is ERROR
 */
final class StatusTest extends TestCase
{
    #[Test]
    public function isSuccessReturnsTrueForCodeZero(): void
    {
        $status = $this->createStatus(0, Severity::INFO);

        self::assertTrue($status->isSuccess());
    }

    #[Test]
    public function isSuccessReturnsFalseForNonZeroCode(): void
    {
        $status = $this->createStatus(2000, Severity::ERROR);

        self::assertFalse($status->isSuccess());
    }

    #[Test]
    public function isSuccessReturnsFalseForWarningCode(): void
    {
        $status = $this->createStatus(1, Severity::WARNING);

        self::assertFalse($status->isSuccess());
    }

    #[Test]
    public function isErrorReturnsTrueForErrorSeverity(): void
    {
        $status = $this->createStatus(2000, Severity::ERROR);

        self::assertTrue($status->isError());
    }

    #[Test]
    public function isErrorReturnsFalseForInfoSeverity(): void
    {
        $status = $this->createStatus(0, Severity::INFO);

        self::assertFalse($status->isError());
    }

    #[Test]
    public function isErrorReturnsFalseForWarnSeverity(): void
    {
        $status = $this->createStatus(1, Severity::WARNING);

        self::assertFalse($status->isError());
    }

    #[Test]
    #[DataProvider('successStatusProvider')]
    public function isSuccessForVariousSuccessScenarios(int $code, Severity $severity): void
    {
        $status = $this->createStatus($code, $severity);

        self::assertTrue($status->isSuccess());
    }

    /**
     * @return array<string, array{int, Severity}>
     */
    public static function successStatusProvider(): array
    {
        // Code 0 always means success, regardless of severity
        return [
            'code 0 with INFO' => [0, Severity::INFO],
            'code 0 with WARN' => [0, Severity::WARNING],
            // Note: code 0 with ERROR severity would be unusual but technically possible
        ];
    }

    #[Test]
    #[DataProvider('errorStatusProvider')]
    public function isErrorForVariousErrorScenarios(int $code, Severity $severity): void
    {
        $status = $this->createStatus($code, $severity);

        self::assertTrue($status->isError());
    }

    /**
     * @return array<string, array{int, Severity}>
     */
    public static function errorStatusProvider(): array
    {
        return [
            'general error' => [2000, Severity::ERROR],
            'account not found' => [2003, Severity::ERROR],
            'invalid request' => [2005, Severity::ERROR],
            'server error' => [15000, Severity::ERROR],
        ];
    }

    #[Test]
    #[DataProvider('commonOfxStatusCodesProvider')]
    public function handlesCommonOfxStatusCodes(int $code, Severity $severity, bool $expectedSuccess, bool $expectedError): void
    {
        $status = $this->createStatus($code, $severity);

        self::assertSame($expectedSuccess, $status->isSuccess(), "isSuccess() should be $expectedSuccess for code $code");
        self::assertSame($expectedError, $status->isError(), "isError() should be $expectedError for severity {$severity->value}");
    }

    /**
     * @return array<string, array{int, Severity, bool, bool}>
     */
    public static function commonOfxStatusCodesProvider(): array
    {
        return [
            // Success
            'success' => [0, Severity::INFO, true, false],

            // Warnings (non-fatal issues)
            'MFA required' => [3000, Severity::WARNING, false, false],
            'duplicate request' => [1, Severity::WARNING, false, false],

            // Errors
            'general error' => [2000, Severity::ERROR, false, true],
            'invalid account' => [2003, Severity::ERROR, false, true],
            'invalid date range' => [2014, Severity::ERROR, false, true],
            'authentication failed' => [15500, Severity::ERROR, false, true],
        ];
    }

    #[Test]
    public function statusCanHaveBothCodeZeroAndErrorSeverity(): void
    {
        // Edge case: theoretically possible but unusual
        $status = $this->createStatus(0, Severity::ERROR);

        // isSuccess checks code only
        self::assertTrue($status->isSuccess());
        // isError checks severity only
        self::assertTrue($status->isError());
    }

    /**
     * Create a Status with the given code and severity.
     *
     * Uses reflection to set the required properties without going through parsing.
     */
    private function createStatus(int $code, Severity $severity, ?string $message = null): Status
    {
        $status = new Status();

        $reflection = new ReflectionClass($status);

        $codeProp = $reflection->getProperty('code');
        $codeProp->setValue($status, $code);

        $severityProp = $reflection->getProperty('severity');
        $severityProp->setValue($status, $severity);

        if ($message !== null) {
            $messageProp = $reflection->getProperty('message');
            $messageProp->setValue($status, $message);
        }

        return $status;
    }
}
