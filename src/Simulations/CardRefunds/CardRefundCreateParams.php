<?php

declare(strict_types=1);

namespace Increase\Simulations\CardRefunds;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Simulates refunding a card transaction. The full value of the original sandbox transaction is refunded.
 *
 * @see Increase\Services\Simulations\CardRefundsService::create()
 *
 * @phpstan-type CardRefundCreateParamsShape = array{
 *   amount?: int|null,
 *   pendingTransactionID?: string|null,
 *   transactionID?: string|null,
 * }
 */
final class CardRefundCreateParams implements BaseModel
{
    /** @use SdkModel<CardRefundCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The refund amount in cents. Pulled off the `pending_transaction` or the `transaction` if not provided.
     */
    #[Optional]
    public ?int $amount;

    /**
     * The identifier of the Pending Transaction for the refund authorization. If this is provided, `transaction` must not be provided as a refund with a refund authorized can not be linked to a regular transaction.
     */
    #[Optional('pending_transaction_id')]
    public ?string $pendingTransactionID;

    /**
     * The identifier for the Transaction to refund. The Transaction's source must have a category of card_settlement.
     */
    #[Optional('transaction_id')]
    public ?string $transactionID;

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
        ?int $amount = null,
        ?string $pendingTransactionID = null,
        ?string $transactionID = null,
    ): self {
        $self = new self;

        null !== $amount && $self['amount'] = $amount;
        null !== $pendingTransactionID && $self['pendingTransactionID'] = $pendingTransactionID;
        null !== $transactionID && $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * The refund amount in cents. Pulled off the `pending_transaction` or the `transaction` if not provided.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier of the Pending Transaction for the refund authorization. If this is provided, `transaction` must not be provided as a refund with a refund authorized can not be linked to a regular transaction.
     */
    public function withPendingTransactionID(string $pendingTransactionID): self
    {
        $self = clone $this;
        $self['pendingTransactionID'] = $pendingTransactionID;

        return $self;
    }

    /**
     * The identifier for the Transaction to refund. The Transaction's source must have a category of card_settlement.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}
