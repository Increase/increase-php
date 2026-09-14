<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * An UK Faster Payment System Transfer Acceptance object. This field will be present in the JSON response if and only if `category` is equal to `uk_faster_payment_system_transfer_acceptance`. A UK Faster Payment System Transfer Acceptance is created when a UK Faster Payment System Transfer sent from Increase is accepted by the recipient's bank.
 *
 * @phpstan-type UkFasterPaymentSystemTransferAcceptanceShape = array{
 *   acceptedAt: \DateTimeInterface, settlementAmount: int
 * }
 */
final class UkFasterPaymentSystemTransferAcceptance implements BaseModel
{
    /** @use SdkModel<UkFasterPaymentSystemTransferAcceptanceShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the recipient's bank accepted the transfer.
     */
    #[Required('accepted_at')]
    public \DateTimeInterface $acceptedAt;

    /**
     * The transfer amount in USD cents.
     */
    #[Required('settlement_amount')]
    public int $settlementAmount;

    /**
     * `new UkFasterPaymentSystemTransferAcceptance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UkFasterPaymentSystemTransferAcceptance::with(
     *   acceptedAt: ..., settlementAmount: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UkFasterPaymentSystemTransferAcceptance)
     *   ->withAcceptedAt(...)
     *   ->withSettlementAmount(...)
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
        \DateTimeInterface $acceptedAt,
        int $settlementAmount
    ): self {
        $self = new self;

        $self['acceptedAt'] = $acceptedAt;
        $self['settlementAmount'] = $settlementAmount;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the recipient's bank accepted the transfer.
     */
    public function withAcceptedAt(\DateTimeInterface $acceptedAt): self
    {
        $self = clone $this;
        $self['acceptedAt'] = $acceptedAt;

        return $self;
    }

    /**
     * The transfer amount in USD cents.
     */
    public function withSettlementAmount(int $settlementAmount): self
    {
        $self = clone $this;
        $self['settlementAmount'] = $settlementAmount;

        return $self;
    }
}
