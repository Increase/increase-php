<?php

declare(strict_types=1);

namespace Increase\Simulations\CardAuthentications;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Simulates an attempt at a Card Authentication Challenge. This updates the `card_authentications` object under the [Card Payment](#card_payments). You can also attempt the challenge by navigating to https://dashboard.increase.com/card_authentication_simulation/:card_payment_id.
 *
 * @see Increase\Services\Simulations\CardAuthenticationsService::challengeAttempts()
 *
 * @phpstan-type CardAuthenticationChallengeAttemptsParamsShape = array{
 *   oneTimeCode: string
 * }
 */
final class CardAuthenticationChallengeAttemptsParams implements BaseModel
{
    /** @use SdkModel<CardAuthenticationChallengeAttemptsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The one-time code to be validated.
     */
    #[Required('one_time_code')]
    public string $oneTimeCode;

    /**
     * `new CardAuthenticationChallengeAttemptsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardAuthenticationChallengeAttemptsParams::with(oneTimeCode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardAuthenticationChallengeAttemptsParams)->withOneTimeCode(...)
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
    public static function with(string $oneTimeCode): self
    {
        $self = new self;

        $self['oneTimeCode'] = $oneTimeCode;

        return $self;
    }

    /**
     * The one-time code to be validated.
     */
    public function withOneTimeCode(string $oneTimeCode): self
    {
        $self = clone $this;
        $self['oneTimeCode'] = $oneTimeCode;

        return $self;
    }
}
