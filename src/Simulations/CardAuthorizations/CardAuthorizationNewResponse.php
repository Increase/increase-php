<?php

declare(strict_types=1);

namespace Increase\Simulations\CardAuthorizations;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DeclinedTransactions\DeclinedTransaction;
use Increase\PendingTransactions\PendingTransaction;
use Increase\Simulations\CardAuthorizations\CardAuthorizationNewResponse\Type;

/**
 * The results of a Card Authorization simulation.
 *
 * @phpstan-import-type DeclinedTransactionShape from \Increase\DeclinedTransactions\DeclinedTransaction
 * @phpstan-import-type PendingTransactionShape from \Increase\PendingTransactions\PendingTransaction
 *
 * @phpstan-type CardAuthorizationNewResponseShape = array{
 *   declinedTransaction: null|DeclinedTransaction|DeclinedTransactionShape,
 *   pendingTransaction: null|PendingTransaction|PendingTransactionShape,
 *   type: Type|value-of<Type>,
 * }
 */
final class CardAuthorizationNewResponse implements BaseModel
{
    /** @use SdkModel<CardAuthorizationNewResponseShape> */
    use SdkModel;

    /**
     * If the authorization attempt fails, this will contain the resulting [Declined Transaction](#declined-transactions) object. The Declined Transaction's `source` will be of `category: card_decline`.
     */
    #[Required('declined_transaction')]
    public ?DeclinedTransaction $declinedTransaction;

    /**
     * If the authorization attempt succeeds, this will contain the resulting Pending Transaction object. The Pending Transaction's `source` will be of `category: card_authorization`.
     */
    #[Required('pending_transaction')]
    public ?PendingTransaction $pendingTransaction;

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_card_authorization_simulation_result`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CardAuthorizationNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardAuthorizationNewResponse::with(
     *   declinedTransaction: ..., pendingTransaction: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardAuthorizationNewResponse)
     *   ->withDeclinedTransaction(...)
     *   ->withPendingTransaction(...)
     *   ->withType(...)
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
     *
     * @param DeclinedTransaction|DeclinedTransactionShape|null $declinedTransaction
     * @param PendingTransaction|PendingTransactionShape|null $pendingTransaction
     * @param Type|value-of<Type> $type
     */
    public static function with(
        DeclinedTransaction|array|null $declinedTransaction,
        PendingTransaction|array|null $pendingTransaction,
        Type|string $type,
    ): self {
        $self = new self;

        $self['declinedTransaction'] = $declinedTransaction;
        $self['pendingTransaction'] = $pendingTransaction;
        $self['type'] = $type;

        return $self;
    }

    /**
     * If the authorization attempt fails, this will contain the resulting [Declined Transaction](#declined-transactions) object. The Declined Transaction's `source` will be of `category: card_decline`.
     *
     * @param DeclinedTransaction|DeclinedTransactionShape|null $declinedTransaction
     */
    public function withDeclinedTransaction(
        DeclinedTransaction|array|null $declinedTransaction
    ): self {
        $self = clone $this;
        $self['declinedTransaction'] = $declinedTransaction;

        return $self;
    }

    /**
     * If the authorization attempt succeeds, this will contain the resulting Pending Transaction object. The Pending Transaction's `source` will be of `category: card_authorization`.
     *
     * @param PendingTransaction|PendingTransactionShape|null $pendingTransaction
     */
    public function withPendingTransaction(
        PendingTransaction|array|null $pendingTransaction
    ): self {
        $self = clone $this;
        $self['pendingTransaction'] = $pendingTransaction;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_card_authorization_simulation_result`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
