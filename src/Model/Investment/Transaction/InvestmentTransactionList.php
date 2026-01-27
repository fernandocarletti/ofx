<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Investment Transaction List aggregate.
 *
 * Contains a list of investment transactions.
 */
class InvestmentTransactionList extends Aggregate
{
    /**
     * Start date/time of transaction list.
     */
    public DateTimeImmutable $startDate;

    /**
     * End date/time of transaction list.
     */
    public DateTimeImmutable $endDate;

    /**
     * All transactions.
     *
     * @var array<Aggregate>
     */
    public array $transactions {
        get => $this->listItems;
    }

    /**
     * List properties for various transaction types.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'BUYDEBT',
        'BUYMF',
        'BUYOPT',
        'BUYOTHER',
        'BUYSTOCK',
        'CLOSUREOPT',
        'INCOME',
        'INVBANKTRAN',
        'INVEXPENSE',
        'JRNLFUND',
        'JRNLSEC',
        'MARGININTEREST',
        'REINVEST',
        'RETOFCAP',
        'SELLDEBT',
        'SELLMF',
        'SELLOPT',
        'SELLOTHER',
        'SELLSTOCK',
        'SPLIT',
        'TRANSFER',
    ];

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'DTSTART' => 'startDate',
            'DTEND' => 'endDate',
        ];
    }
}
