<?php

declare(strict_types=1);

namespace Ofx\Element;

use Ofx\Exception\ValidationException;

/**
 * Integer element with optional max digits validation.
 */
final class IntegerElement extends Element
{
    /**
     * @param int|null $maxDigits Maximum number of digits allowed (null for unlimited)
     * @param bool $required Whether the element value is required
     */
    public function __construct(
        public readonly ?int $maxDigits = null,
        bool $required = false,
    ) {
        parent::__construct($required);
    }

    /**
     * Convert and validate OFX integer value.
     *
     * @param string|null $value Raw OFX value
     *
     * @throws ValidationException If value is not a valid integer or exceeds max digits
     *
     * @return int|null Converted integer
     */
    public function convert(?string $value): ?int
    {
        $this->enforceRequired($value);

        if ($value === null || $value === '') {
            return null;
        }

        $value = trim($value);

        if (!is_numeric($value)) {
            throw new ValidationException("Invalid integer value: '$value'");
        }

        // Check for decimal point
        if (str_contains($value, '.')) {
            throw new ValidationException("Invalid integer value (contains decimal): '$value'");
        }

        $intValue = (int) $value;

        if ($this->maxDigits !== null) {
            $digitCount = \strlen((string) abs($intValue));
            if ($digitCount > $this->maxDigits) {
                throw new ValidationException(
                    "Integer exceeds max digits of {$this->maxDigits}: $value",
                );
            }
        }

        return $intValue;
    }
}
