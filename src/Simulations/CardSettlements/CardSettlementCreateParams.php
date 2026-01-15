<?php

declare(strict_types=1);

namespace Increase\Simulations\CardSettlements;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Simulates the settlement of an authorization by a card acquirer. After a card authorization is created, the merchant will eventually send a settlement. This simulates that event, which may occur many days after the purchase in production. The amount settled can be different from the amount originally authorized, for example, when adding a tip to a restaurant bill.
 *
 * @see Increase\Services\Simulations\CardSettlementsService::create()
 *
 * @phpstan-type CardSettlementCreateParamsShape = array{
 *   cardID: string, pendingTransactionID: string, amount?: int|null
 * }
 */
final class CardSettlementCreateParams implements BaseModel
{
    /** @use SdkModel<CardSettlementCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Card to create a settlement on.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * The identifier of the Pending Transaction for the Card Authorization you wish to settle.
     */
    #[Required('pending_transaction_id')]
    public string $pendingTransactionID;

    /**
     * The amount to be settled. This defaults to the amount of the Pending Transaction being settled.
     */
    #[Optional]
    public ?int $amount;

    /**
     * `new CardSettlementCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardSettlementCreateParams::with(cardID: ..., pendingTransactionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardSettlementCreateParams)->withCardID(...)->withPendingTransactionID(...)
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
        string $cardID,
        string $pendingTransactionID,
        ?int $amount = null
    ): self {
        $self = new self;

        $self['cardID'] = $cardID;
        $self['pendingTransactionID'] = $pendingTransactionID;

        null !== $amount && $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier of the Card to create a settlement on.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

        return $self;
    }

    /**
     * The identifier of the Pending Transaction for the Card Authorization you wish to settle.
     */
    public function withPendingTransactionID(string $pendingTransactionID): self
    {
        $self = clone $this;
        $self['pendingTransactionID'] = $pendingTransactionID;

        return $self;
    }

    /**
     * The amount to be settled. This defaults to the amount of the Pending Transaction being settled.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }
}
