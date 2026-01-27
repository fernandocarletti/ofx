<?php

declare(strict_types=1);

namespace Ofx\Model\Bank;

use Ofx\Aggregate\Aggregate;

/**
 * Bank Messages Request V1 aggregate.
 *
 * Container for bank request messages.
 */
class BankMessagesRequestV1 extends Aggregate
{
    /**
     * Statement transaction requests.
     *
     * @var array<StatementTransactionRequest>
     */
    public array $statementTransactionRequests {
        get => array_filter(
            $this->listItems,
            fn($item) => $item instanceof StatementTransactionRequest,
        );
    }

    /**
     * Statement transaction requests.
     *
     * @var array<string>
     */
    protected static array $listProperties = ['STMTTRNRQ'];
}
