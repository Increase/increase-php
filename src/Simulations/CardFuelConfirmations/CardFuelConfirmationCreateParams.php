<?php

declare(strict_types=1);

namespace Increase\Simulations\CardFuelConfirmations;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Simulates the fuel confirmation of an authorization by a card acquirer. This happens asynchronously right after a fuel pump transaction is completed. A fuel confirmation can only happen once per authorization.
 *
 * @see Increase\Services\Simulations\CardFuelConfirmationsService::create()
 *
 * @phpstan-type CardFuelConfirmationCreateParamsShape = array{
 *   amount: int, cardPaymentID: string
 * }
 */
final class CardFuelConfirmationCreateParams implements BaseModel
{
    /** @use SdkModel<CardFuelConfirmationCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The amount of the fuel_confirmation in minor units in the card authorization's currency.
     */
    #[Required]
    public int $amount;

    /**
     * The identifier of the Card Payment to create a fuel_confirmation on.
     */
    #[Required('card_payment_id')]
    public string $cardPaymentID;

    /**
     * `new CardFuelConfirmationCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardFuelConfirmationCreateParams::with(amount: ..., cardPaymentID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardFuelConfirmationCreateParams)->withAmount(...)->withCardPaymentID(...)
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
    public static function with(int $amount, string $cardPaymentID): self
    {
        $self = new self;

        $self['amount'] = $amount;
        $self['cardPaymentID'] = $cardPaymentID;

        return $self;
    }

    /**
     * The amount of the fuel_confirmation in minor units in the card authorization's currency.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier of the Card Payment to create a fuel_confirmation on.
     */
    public function withCardPaymentID(string $cardPaymentID): self
    {
        $self = clone $this;
        $self['cardPaymentID'] = $cardPaymentID;

        return $self;
    }
}
