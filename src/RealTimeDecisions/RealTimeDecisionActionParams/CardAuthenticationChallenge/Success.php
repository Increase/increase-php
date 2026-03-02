<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthenticationChallenge;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If your application was able to deliver the one-time code, this contains metadata about the delivery.
 *
 * @phpstan-type SuccessShape = array{email?: string|null, phone?: string|null}
 */
final class Success implements BaseModel
{
    /** @use SdkModel<SuccessShape> */
    use SdkModel;

    /**
     * The email address that was used to deliver the one-time code to the cardholder.
     */
    #[Optional]
    public ?string $email;

    /**
     * The phone number that was used to deliver the one-time code to the cardholder via SMS.
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
     * The email address that was used to deliver the one-time code to the cardholder.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * The phone number that was used to deliver the one-time code to the cardholder via SMS.
     */
    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }
}
