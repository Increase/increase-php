<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Push Transfer Acceptance object. This field will be present in the JSON response if and only if `category` is equal to `card_push_transfer_acceptance`. A Card Push Transfer Acceptance is created when an Outbound Card Push Transfer sent from Increase is accepted by the receiving bank.
 *
 * @phpstan-type CardPushTransferAcceptanceShape = array{
 *   settlementAmount: int, transferID: string
 * }
 */
final class CardPushTransferAcceptance implements BaseModel
{
    /** @use SdkModel<CardPushTransferAcceptanceShape> */
    use SdkModel;

    /**
     * The transfer amount in USD cents.
     */
    #[Required('settlement_amount')]
    public int $settlementAmount;

    /**
     * The identifier of the Card Push Transfer that led to this Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new CardPushTransferAcceptance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardPushTransferAcceptance::with(settlementAmount: ..., transferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardPushTransferAcceptance)->withSettlementAmount(...)->withTransferID(...)
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
    public static function with(int $settlementAmount, string $transferID): self
    {
        $self = new self;

        $self['settlementAmount'] = $settlementAmount;
        $self['transferID'] = $transferID;

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

    /**
     * The identifier of the Card Push Transfer that led to this Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}
