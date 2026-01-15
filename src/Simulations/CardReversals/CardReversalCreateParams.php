<?php

declare(strict_types=1);

namespace Increase\Simulations\CardReversals;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Simulates the reversal of an authorization by a card acquirer. An authorization can be partially reversed multiple times, up until the total authorized amount. Marks the pending transaction as complete if the authorization is fully reversed.
 *
 * @see Increase\Services\Simulations\CardReversalsService::create()
 *
 * @phpstan-type CardReversalCreateParamsShape = array{
 *   cardPaymentID: string, amount?: int|null
 * }
 */
final class CardReversalCreateParams implements BaseModel
{
    /** @use SdkModel<CardReversalCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Card Payment to create a reversal on.
     */
    #[Required('card_payment_id')]
    public string $cardPaymentID;

    /**
     * The amount of the reversal in minor units in the card authorization's currency. This defaults to the authorization amount.
     */
    #[Optional]
    public ?int $amount;

    /**
     * `new CardReversalCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardReversalCreateParams::with(cardPaymentID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardReversalCreateParams)->withCardPaymentID(...)
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
    public static function with(string $cardPaymentID, ?int $amount = null): self
    {
        $self = new self;

        $self['cardPaymentID'] = $cardPaymentID;

        null !== $amount && $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier of the Card Payment to create a reversal on.
     */
    public function withCardPaymentID(string $cardPaymentID): self
    {
        $self = clone $this;
        $self['cardPaymentID'] = $cardPaymentID;

        return $self;
    }

    /**
     * The amount of the reversal in minor units in the card authorization's currency. This defaults to the authorization amount.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }
}
