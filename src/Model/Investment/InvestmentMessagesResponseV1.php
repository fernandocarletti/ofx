<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;

/**
 * Investment Messages Response V1 aggregate.
 *
 * Container for investment response messages.
 */
class InvestmentMessagesResponseV1 extends Aggregate
{
    /**
     * Statement transaction responses.
     *
     * @var array<InvestmentStatementTransactionResponse>
     */
    public array $statementTransactionResponses {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List property for statement transaction responses.
     *
     * @var array<string>
     */
    protected static array $listProperties = ['INVSTMTTRNRS'];
}
