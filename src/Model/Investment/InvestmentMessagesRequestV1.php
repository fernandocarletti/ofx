<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;

/**
 * Investment Messages Request V1 aggregate.
 *
 * Container for investment request messages.
 */
class InvestmentMessagesRequestV1 extends Aggregate
{
    /**
     * Statement transaction requests.
     *
     * @var array<InvestmentStatementTransactionRequest>
     */
    public array $statementTransactionRequests {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List property for statement transaction requests.
     *
     * @var array<string>
     */
    protected static array $listProperties = ['INVSTMTTRNRQ'];
}
