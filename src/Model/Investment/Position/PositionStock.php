<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Position;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\StockType;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Stock Position aggregate.
 *
 * Represents a position in a stock security.
 */
class PositionStock extends Aggregate
{
    /**
     * Base investment position details.
     */
    public InvestmentPosition $investmentPosition;

    /**
     * Stock type (COMMON, PREFERRED, etc.).
     */
    public ?StockType $stockType = null;

    /**
     * Units held on which reinvestment is based.
     */
    public ?string $reinvestDividend = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVPOS' => 'investmentPosition',
            'STOCKTYPE' => 'stockType',
            'REINVDIV' => 'reinvestDividend',
        ];
    }

    /**
     * Parse property value with special handling for enums.
     *
     * @param SimpleXMLElement $child Child element
     * @param ReflectionProperty $property Target property
     *
     * @return mixed Parsed value
     */
    protected function parsePropertyValue(SimpleXMLElement $child, ReflectionProperty $property): mixed
    {
        $tagName = $child->getName();

        if ($tagName === 'STOCKTYPE') {
            return StockType::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
