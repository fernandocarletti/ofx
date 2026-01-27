<?php

declare(strict_types=1);

namespace Ofx\Model\CreditCard;

use Ofx\Aggregate\Aggregate;

/**
 * Credit Card Messages Request V1 aggregate.
 *
 * Container for credit card request messages.
 */
class CreditCardMessagesRequestV1 extends Aggregate
{
    /**
     * Statement transaction requests.
     *
     * @var array<CreditCardStatementTransactionRequest>
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
    protected static array $listProperties = ['CCSTMTTRNRQ'];
}
