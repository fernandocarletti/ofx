<?php

declare(strict_types=1);

namespace Ofx\Element;

use Ofx\Exception\ValidationException;

/**
 * Enum/constrained value element.
 *
 * Validates that value is one of the allowed options.
 * Used for OFX enumerated types like ACCTTYPE, TRNTYPE, etc.
 */
final class OneOfElement extends Element
{
    /**
     * Allowed values.
     *
     * @var array<string>
     */
    public readonly array $allowedValues;

    /**
     * @param array<string> $allowedValues List of allowed values
     * @param bool $required Whether the element value is required
     */
    public function __construct(
        array $allowedValues,
        bool $required = false,
    ) {
        parent::__construct($required);
        $this->allowedValues = array_values($allowedValues);
    }

    /**
     * Validate that value is one of the allowed options.
     *
     * @param string|null $value Raw OFX value
     *
     * @throws ValidationException If value is not in allowed list
     *
     * @return string|null Validated value
     */
    public function convert(?string $value): ?string
    {
        $this->enforceRequired($value);

        if ($value === null || $value === '') {
            return null;
        }

        $value = trim($value);

        if (!\in_array($value, $this->allowedValues, true)) {
            $allowed = implode(', ', $this->allowedValues);

            throw new ValidationException(
                "Invalid value '$value'. Must be one of: $allowed",
            );
        }

        return $value;
    }
}
