<?php

declare(strict_types=1);

namespace Increase\Simulations\CardAuthorizationExpirations;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Simulates expiring a Card Authorization immediately.
 *
 * @see Increase\Services\Simulations\CardAuthorizationExpirationsService::create()
 *
 * @phpstan-type CardAuthorizationExpirationCreateParamsShape = array{
 *   cardPaymentID: string
 * }
 */
final class CardAuthorizationExpirationCreateParams implements BaseModel
{
    /** @use SdkModel<CardAuthorizationExpirationCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Card Payment to expire.
     */
    #[Required('card_payment_id')]
    public string $cardPaymentID;

    /**
     * `new CardAuthorizationExpirationCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardAuthorizationExpirationCreateParams::with(cardPaymentID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardAuthorizationExpirationCreateParams)->withCardPaymentID(...)
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
    public static function with(string $cardPaymentID): self
    {
        $self = new self;

        $self['cardPaymentID'] = $cardPaymentID;

        return $self;
    }

    /**
     * The identifier of the Card Payment to expire.
     */
    public function withCardPaymentID(string $cardPaymentID): self
    {
        $self = clone $this;
        $self['cardPaymentID'] = $cardPaymentID;

        return $self;
    }
}
