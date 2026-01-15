<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletAuthentication;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If your application was able to deliver the one-time passcode, this contains metadata about the delivery. Exactly one of `phone` or `email` must be provided.
 *
 * @phpstan-type SuccessShape = array{email?: string|null, phone?: string|null}
 */
final class Success implements BaseModel
{
    /** @use SdkModel<SuccessShape> */
    use SdkModel;

    /**
     * The email address that was used to verify the cardholder via one-time passcode.
     */
    #[Optional]
    public ?string $email;

    /**
     * The phone number that was used to verify the cardholder via one-time passcode over SMS.
     */
    #[Optional]
    public ?string $phone;

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
        ?string $email = null,
        ?string $phone = null
    ): self {
        $self = new self;

        null !== $email && $self['email'] = $email;
        null !== $phone && $self['phone'] = $phone;

        return $self;
    }

    /**
     * The email address that was used to verify the cardholder via one-time passcode.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * The phone number that was used to verify the cardholder via one-time passcode over SMS.
     */
    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }
}
