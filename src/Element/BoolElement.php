<?php

declare(strict_types=1);

namespace Ofx\Element;

use Ofx\Exception\ValidationException;

/**
 * Boolean element - converts Y/N to bool.
 *
 * Per OFX spec section 3.2.8.1, boolean values are represented as:
 * - Y = true
 * - N = false
 */
final class BoolElement extends Element
{
    /**
     * Convert OFX boolean string to PHP bool.
     *
     * @param string|null $value Raw OFX value ('Y' or 'N')
     *
     * @throws ValidationException If value is not 'Y' or 'N'
     *
     * @return bool|null Converted boolean value
     */
    public function convert(?string $value): ?bool
    {
        $this->enforceRequired($value);

        if ($value === null || $value === '') {
            return null;
        }

        $value = trim($value);

        return match ($value) {
            'Y' => true,
            'N' => false,
            default => throw new ValidationException(
                "Invalid boolean value: '$value'. Expected 'Y' or 'N'",
            ),
        };
    }
}
