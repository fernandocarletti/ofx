<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099 Response aggregate.
 *
 * Response containing tax 1099 information.
 */
class Tax1099Response extends Aggregate
{
    /**
     * All 1099-INT forms.
     *
     * @var array<Tax1099Int>
     */
    public array $tax1099IntForms {
        get => array_filter($this->listItems, fn($item) => $item instanceof Tax1099Int);
    }

    /**
     * All 1099-DIV forms.
     *
     * @var array<Tax1099Div>
     */
    public array $tax1099DivForms {
        get => array_filter($this->listItems, fn($item) => $item instanceof Tax1099Div);
    }

    /**
     * All 1099-R forms.
     *
     * @var array<Tax1099R>
     */
    public array $tax1099RForms {
        get => array_filter($this->listItems, fn($item) => $item instanceof Tax1099R);
    }

    /**
     * All 1099-B forms.
     *
     * @var array<Tax1099B>
     */
    public array $tax1099BForms {
        get => array_filter($this->listItems, fn($item) => $item instanceof Tax1099B);
    }

    /**
     * All 1099-MISC forms.
     *
     * @var array<Tax1099Misc>
     */
    public array $tax1099MiscForms {
        get => array_filter($this->listItems, fn($item) => $item instanceof Tax1099Misc);
    }

    /**
     * All 1099-OID forms.
     *
     * @var array<Tax1099Oid>
     */
    public array $tax1099OidForms {
        get => array_filter($this->listItems, fn($item) => $item instanceof Tax1099Oid);
    }

    /**
     * All 1099-G forms.
     *
     * @var array<Tax1099G>
     */
    public array $tax1099GForms {
        get => array_filter($this->listItems, fn($item) => $item instanceof Tax1099G);
    }

    /**
     * All 1099-C forms.
     *
     * @var array<Tax1099C>
     */
    public array $tax1099CForms {
        get => array_filter($this->listItems, fn($item) => $item instanceof Tax1099C);
    }

    /**
     * All 1099-CAP forms.
     *
     * @var array<Tax1099Cap>
     */
    public array $tax1099CapForms {
        get => array_filter($this->listItems, fn($item) => $item instanceof Tax1099Cap);
    }

    /**
     * All 1099-LTC forms.
     *
     * @var array<Tax1099Ltc>
     */
    public array $tax1099LtcForms {
        get => array_filter($this->listItems, fn($item) => $item instanceof Tax1099Ltc);
    }

    /**
     * All 1099-Q forms.
     *
     * @var array<Tax1099Q>
     */
    public array $tax1099QForms {
        get => array_filter($this->listItems, fn($item) => $item instanceof Tax1099Q);
    }

    /**
     * All 1099-SA forms.
     *
     * @var array<Tax1099Sa>
     */
    public array $tax1099SaForms {
        get => array_filter($this->listItems, fn($item) => $item instanceof Tax1099Sa);
    }

    /**
     * All 1099-S forms.
     *
     * @var array<Tax1099S>
     */
    public array $tax1099SForms {
        get => array_filter($this->listItems, fn($item) => $item instanceof Tax1099S);
    }

    /**
     * All 1099-H forms.
     *
     * @var array<Tax1099H>
     */
    public array $tax1099HForms {
        get => array_filter($this->listItems, fn($item) => $item instanceof Tax1099H);
    }

    /**
     * All 1099-PATR forms.
     *
     * @var array<Tax1099Patr>
     */
    public array $tax1099PatrForms {
        get => array_filter($this->listItems, fn($item) => $item instanceof Tax1099Patr);
    }

    /**
     * All 1099 forms.
     *
     * @var array<Aggregate>
     */
    public array $allForms {
        get => $this->listItems;
    }

    /**
     * List of tax 1099 form aggregates.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'TAX1099INT_V100',
        'TAX1099DIV_V100',
        'TAX1099R_V100',
        'TAX1099B_V100',
        'TAX1099MISC_V100',
        'TAX1099OID_V100',
        'TAX1099G_V100',
        'TAX1099C_V100',
        'TAX1099CAP_V100',
        'TAX1099LTC_V100',
        'TAX1099Q_V100',
        'TAX1099SA_V100',
        'TAX1099S_V100',
        'TAX1099H_V100',
        'TAX1099PATR_V100',
    ];
}
