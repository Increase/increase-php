<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardSettlement;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Surcharge amount details, if applicable. The amount is positive if the surcharge is added to the overall transaction amount (surcharge), and negative if the surcharge is deducted from the overall transaction amount (discount).
 *
 * @phpstan-type SurchargeShape = array{amount: int, presentmentAmount: int}
 */
final class Surcharge implements BaseModel
{
    /** @use SdkModel<SurchargeShape> */
    use SdkModel;

    /**
     * The surcharge amount in the minor unit of the transaction's settlement currency.
     */
    #[Required]
    public int $amount;

    /**
     * The surcharge amount in the minor unit of the transaction's presentment currency.
     */
    #[Required('presentment_amount')]
    public int $presentmentAmount;

    /**
     * `new Surcharge()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Surcharge::with(amount: ..., presentmentAmount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Surcharge)->withAmount(...)->withPresentmentAmount(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(int $amount, int $presentmentAmount): self
    {
        $self = new self;

        $self['amount'] = $amount;
        $self['presentmentAmount'] = $presentmentAmount;

        return $self;
    }

    /**
     * The surcharge amount in the minor unit of the transaction's settlement currency.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The surcharge amount in the minor unit of the transaction's presentment currency.
     */
    public function withPresentmentAmount(int $presentmentAmount): self
    {
        $self = clone $this;
        $self['presentmentAmount'] = $presentmentAmount;

        return $self;
    }
}
