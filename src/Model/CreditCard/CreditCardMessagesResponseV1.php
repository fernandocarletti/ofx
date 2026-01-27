<?php

declare(strict_types=1);

namespace Ofx\Model\CreditCard;

use Ofx\Aggregate\Aggregate;

/**
 * Credit Card Messages Response V1 aggregate.
 *
 * Container for credit card response messages.
 */
class CreditCardMessagesResponseV1 extends Aggregate
{
    /**
     * Statement transaction responses.
     *
     * @var array<CreditCardStatementTransactionResponse>
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
    protected static array $listProperties = ['CCSTMTTRNRS'];
}
