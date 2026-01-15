<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletToken;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If your application approves the provisioning attempt, this contains metadata about the digital wallet token that will be generated.
 *
 * @phpstan-type ApprovalShape = array{email?: string|null, phone?: string|null}
 */
final class Approval implements BaseModel
{
    /** @use SdkModel<ApprovalShape> */
    use SdkModel;

    /**
     * An email address that can be used to verify the cardholder via one-time passcode.
     */
    #[Optional]
    public ?string $email;

    /**
     * A phone number that can be used to verify the cardholder via one-time passcode over SMS.
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
     * An email address that can be used to verify the cardholder via one-time passcode.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * A phone number that can be used to verify the cardholder via one-time passcode over SMS.
     */
    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }
}
