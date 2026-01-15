<?php

declare(strict_types=1);

namespace Increase\Cards\Card;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The contact information used in the two-factor steps for digital wallet card creation. At least one field must be present to complete the digital wallet steps.
 *
 * @phpstan-type DigitalWalletShape = array{
 *   digitalCardProfileID: string|null, email: string|null, phone: string|null
 * }
 */
final class DigitalWallet implements BaseModel
{
    /** @use SdkModel<DigitalWalletShape> */
    use SdkModel;

    /**
     * The digital card profile assigned to this digital card. Card profiles may also be assigned at the program level.
     */
    #[Required('digital_card_profile_id')]
    public ?string $digitalCardProfileID;

    /**
     * An email address that can be used to verify the cardholder via one-time passcode over email.
     */
    #[Required]
    public ?string $email;

    /**
     * A phone number that can be used to verify the cardholder via one-time passcode over SMS.
     */
    #[Required]
    public ?string $phone;

    /**
     * `new DigitalWallet()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalWallet::with(digitalCardProfileID: ..., email: ..., phone: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalWallet)
     *   ->withDigitalCardProfileID(...)
     *   ->withEmail(...)
     *   ->withPhone(...)
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
    public static function with(
        ?string $digitalCardProfileID,
        ?string $email,
        ?string $phone
    ): self {
        $self = new self;

        $self['digitalCardProfileID'] = $digitalCardProfileID;
        $self['email'] = $email;
        $self['phone'] = $phone;

        return $self;
    }

    /**
     * The digital card profile assigned to this digital card. Card profiles may also be assigned at the program level.
     */
    public function withDigitalCardProfileID(
        ?string $digitalCardProfileID
    ): self {
        $self = clone $this;
        $self['digitalCardProfileID'] = $digitalCardProfileID;

        return $self;
    }

    /**
     * An email address that can be used to verify the cardholder via one-time passcode over email.
     */
    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * A phone number that can be used to verify the cardholder via one-time passcode over SMS.
     */
    public function withPhone(?string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }
}
