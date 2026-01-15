<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletToken;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If your application declines the provisioning attempt, this contains details about the decline.
 *
 * @phpstan-type DeclineShape = array{reason?: string|null}
 */
final class Decline implements BaseModel
{
    /** @use SdkModel<DeclineShape> */
    use SdkModel;

    /**
     * Why the tokenization attempt was declined. This is for logging purposes only and is not displayed to the end-user.
     */
    #[Optional]
    public ?string $reason;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $reason = null): self
    {
        $self = new self;

        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    /**
     * Why the tokenization attempt was declined. This is for logging purposes only and is not displayed to the end-user.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
