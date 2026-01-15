<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The summarized state of this card payment.
 *
 * @phpstan-type StateShape = array{
 *   authorizedAmount: int,
 *   fuelConfirmedAmount: int,
 *   incrementedAmount: int,
 *   refundAuthorizedAmount: int,
 *   refundedAmount: int,
 *   reversedAmount: int,
 *   settledAmount: int,
 * }
 */
final class State implements BaseModel
{
    /** @use SdkModel<StateShape> */
    use SdkModel;

    /**
     * The total authorized amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required('authorized_amount')]
    public int $authorizedAmount;

    /**
     * The total amount from fuel confirmations in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required('fuel_confirmed_amount')]
    public int $fuelConfirmedAmount;

    /**
     * The total incrementally updated authorized amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required('incremented_amount')]
    public int $incrementedAmount;

    /**
     * The total refund authorized amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required('refund_authorized_amount')]
    public int $refundAuthorizedAmount;

    /**
     * The total refunded amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required('refunded_amount')]
    public int $refundedAmount;

    /**
     * The total reversed amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required('reversed_amount')]
    public int $reversedAmount;

    /**
     * The total settled amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required('settled_amount')]
    public int $settledAmount;

    /**
     * `new State()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * State::with(
     *   authorizedAmount: ...,
     *   fuelConfirmedAmount: ...,
     *   incrementedAmount: ...,
     *   refundAuthorizedAmount: ...,
     *   refundedAmount: ...,
     *   reversedAmount: ...,
     *   settledAmount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new State)
     *   ->withAuthorizedAmount(...)
     *   ->withFuelConfirmedAmount(...)
     *   ->withIncrementedAmount(...)
     *   ->withRefundAuthorizedAmount(...)
     *   ->withRefundedAmount(...)
     *   ->withReversedAmount(...)
     *   ->withSettledAmount(...)
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
    public static function with(
        int $authorizedAmount,
        int $fuelConfirmedAmount,
        int $incrementedAmount,
        int $refundAuthorizedAmount,
        int $refundedAmount,
        int $reversedAmount,
        int $settledAmount,
    ): self {
        $self = new self;

        $self['authorizedAmount'] = $authorizedAmount;
        $self['fuelConfirmedAmount'] = $fuelConfirmedAmount;
        $self['incrementedAmount'] = $incrementedAmount;
        $self['refundAuthorizedAmount'] = $refundAuthorizedAmount;
        $self['refundedAmount'] = $refundedAmount;
        $self['reversedAmount'] = $reversedAmount;
        $self['settledAmount'] = $settledAmount;

        return $self;
    }

    /**
     * The total authorized amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    public function withAuthorizedAmount(int $authorizedAmount): self
    {
        $self = clone $this;
        $self['authorizedAmount'] = $authorizedAmount;

        return $self;
    }

    /**
     * The total amount from fuel confirmations in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    public function withFuelConfirmedAmount(int $fuelConfirmedAmount): self
    {
        $self = clone $this;
        $self['fuelConfirmedAmount'] = $fuelConfirmedAmount;

        return $self;
    }

    /**
     * The total incrementally updated authorized amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    public function withIncrementedAmount(int $incrementedAmount): self
    {
        $self = clone $this;
        $self['incrementedAmount'] = $incrementedAmount;

        return $self;
    }

    /**
     * The total refund authorized amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    public function withRefundAuthorizedAmount(
        int $refundAuthorizedAmount
    ): self {
        $self = clone $this;
        $self['refundAuthorizedAmount'] = $refundAuthorizedAmount;

        return $self;
    }

    /**
     * The total refunded amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    public function withRefundedAmount(int $refundedAmount): self
    {
        $self = clone $this;
        $self['refundedAmount'] = $refundedAmount;

        return $self;
    }

    /**
     * The total reversed amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    public function withReversedAmount(int $reversedAmount): self
    {
        $self = clone $this;
        $self['reversedAmount'] = $reversedAmount;

        return $self;
    }

    /**
     * The total settled amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    public function withSettledAmount(int $settledAmount): self
    {
        $self = clone $this;
        $self['settledAmount'] = $settledAmount;

        return $self;
    }
}
