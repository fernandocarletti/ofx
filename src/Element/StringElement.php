<?php

declare(strict_types=1);

namespace Ofx\Element;

use Ofx\Exception\ValidationException;

/**
 * String element with optional max length validation.
 *
 * Handles XML entity decoding and whitespace normalization.
 */
final class StringElement extends Element
{
    /**
     * @param int|null $maxLength Maximum allowed string length (null for unlimited)
     * @param bool $required Whether the element value is required
     */
    public function __construct(
        public readonly ?int $maxLength = null,
        bool $required = false,
    ) {
        parent::__construct($required);
    }

    /**
     * Convert and validate OFX string value.
     *
     * @param string|null $value Raw OFX value
     *
     * @throws ValidationException If value exceeds max length
     *
     * @return string|null Decoded and validated string
     */
    public function convert(?string $value): ?string
    {
        $this->enforceRequired($value);

        if ($value === null || $value === '') {
            return null;
        }

        // Decode XML entities
        $value = html_entity_decode($value, ENT_QUOTES | ENT_XML1, 'UTF-8');

        // Also handle OFX-specific entities
        $value = str_replace('&nbsp;', ' ', $value);

        // Trim whitespace
        $value = trim($value);

        if ($value === '') {
            return null;
        }

        if ($this->maxLength !== null && mb_strlen($value, 'UTF-8') > $this->maxLength) {
            throw new ValidationException(
                "String exceeds max length of {$this->maxLength}: '$value'",
            );
        }

        return $value;
    }
}
