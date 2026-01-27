<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;

/**
 * Contribution Info aggregate.
 *
 * Contains contribution information for 401k.
 */
class ContributionInfo extends Aggregate
{
    /**
     * Contribution securities.
     *
     * @var array<ContributionSecurity>
     */
    public array $contributionSecurities {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List property for contribution securities.
     *
     * @var array<string>
     */
    protected static array $listProperties = ['CONTRIBSECURITY'];
}
