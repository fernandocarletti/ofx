<?php

declare(strict_types=1);

namespace Ofx\Element;

use Ofx\Exception\ValidationException;

/**
 * Decimal/money amount element.
 *
 * Values are kept as strings to preserve precision.
 * Use bcmath functions for arithmetic operations.
 */
final class AmountElement extends Element
{
    /**
     * @param int|null $scale Number of decimal places (null for no rounding)
     * @param bool $required Whether the element value is required
     */
    public function __construct(
        public readonly ?int $scale = null,
        bool $required = false,
    ) {
        parent::__construct($required);
    }

    /**
     * Convert and validate OFX decimal value.
     *
     * @param string|null $value Raw OFX value
     *
     * @throws ValidationException If value is not a valid decimal
     *
     * @return string|null Normalized decimal string
     */
    public function convert(?string $value): ?string
    {
        $this->enforceRequired($value);

        if ($value === null || $value === '') {
            return null;
        }

        $value = trim($value);

        // Handle European decimal separators (comma instead of period)
        // Only replace if there's no period already
        if (!str_contains($value, '.') && str_contains($value, ',')) {
            $value = str_replace(',', '.', $value);
        }

        // Remove thousands separators (commas when period is decimal separator)
        if (str_contains($value, '.')) {
            $value = str_replace(',', '', $value);
        }

        if (!is_numeric($value)) {
            throw new ValidationException("Invalid decimal value: '$value'");
        }

        // Normalize to specified scale if provided
        if ($this->scale !== null) {
            $value = bcadd($value, '0', $this->scale);
        }

        return $value;
    }
}
