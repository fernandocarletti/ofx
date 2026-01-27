<?php

declare(strict_types=1);

namespace Ofx\Element;

use Ofx\Exception\ValidationException;

/**
 * Base class for OFX element types.
 *
 * Elements are data-bearing leaf nodes in the OFX hierarchy.
 * Each element type handles conversion from OFX string format
 * to PHP native types and validation of values.
 */
abstract class Element
{
    /**
     * @param bool $required Whether the element value is required
     */
    public function __construct(
        public readonly bool $required = false,
    ) {}

    /**
     * Convert OFX string value to PHP type.
     *
     * @param string|null $value Raw OFX value
     *
     * @throws ValidationException If value is invalid
     *
     * @return mixed Converted PHP value
     */
    abstract public function convert(?string $value): mixed;

    /**
     * Validate that required values are present.
     *
     * @param string|null $value The value to check
     *
     * @throws ValidationException If required value is missing
     */
    protected function enforceRequired(?string $value): void
    {
        if (($value === null || $value === '') && $this->required) {
            throw new ValidationException('Value is required');
        }
    }
}
