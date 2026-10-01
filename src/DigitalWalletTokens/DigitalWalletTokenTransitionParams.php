<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokens;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\DigitalWalletTokens\DigitalWalletTokenTransitionParams\Status;

/**
 * Submit a Digital Wallet Token status transition to the card network. The Digital Wallet Token will move to `pending_transitioning` until the card network confirms the transition, and a `digital_wallet_token.updated` webhook will be sent once the transition has been confirmed.
 *
 * @see Increase\Services\DigitalWalletTokensService::transition()
 *
 * @phpstan-type DigitalWalletTokenTransitionParamsShape = array{
 *   status: Status|value-of<Status>
 * }
 */
final class DigitalWalletTokenTransitionParams implements BaseModel
{
    /** @use SdkModel<DigitalWalletTokenTransitionParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The status to transition the Digital Wallet Token to.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * `new DigitalWalletTokenTransitionParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalWalletTokenTransitionParams::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalWalletTokenTransitionParams)->withStatus(...)
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
     * @param Status|value-of<Status> $status
     */
    public static function with(Status|string $status): self
    {
        $self = new self;

        $self['status'] = $status;

        return $self;
    }

    /**
     * The status to transition the Digital Wallet Token to.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
