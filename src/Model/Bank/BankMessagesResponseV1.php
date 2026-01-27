<?php

declare(strict_types=1);

namespace Ofx\Model\Bank;

use Ofx\Aggregate\Aggregate;

/**
 * Bank Messages Response V1 aggregate.
 *
 * Container for bank response messages.
 */
class BankMessagesResponseV1 extends Aggregate
{
    /**
     * Statement transaction responses.
     *
     * @var array<StatementTransactionResponse>
     */
    public array $statementTransactionResponses {
        get => array_filter(
            $this->listItems,
            fn($item) => $item instanceof StatementTransactionResponse,
        );
    }

    /**
     * Statement transaction responses.
     *
     * @var array<string>
     */
    protected static array $listProperties = ['STMTTRNRS'];
}
