<?php

declare(strict_types=1);

namespace Increase\Simulations\DigitalWalletTokenRequests;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Simulates a user attempting add a [Card](#cards) to a digital wallet such as Apple Pay.
 *
 * @see Increase\Services\Simulations\DigitalWalletTokenRequestsService::create()
 *
 * @phpstan-type DigitalWalletTokenRequestCreateParamsShape = array{cardID: string}
 */
final class DigitalWalletTokenRequestCreateParams implements BaseModel
{
    /** @use SdkModel<DigitalWalletTokenRequestCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Card to be authorized.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * `new DigitalWalletTokenRequestCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalWalletTokenRequestCreateParams::with(cardID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalWalletTokenRequestCreateParams)->withCardID(...)
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
    public static function with(string $cardID): self
    {
        $self = new self;

        $self['cardID'] = $cardID;

        return $self;
    }

    /**
     * The identifier of the Card to be authorized.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

        return $self;
    }
}
