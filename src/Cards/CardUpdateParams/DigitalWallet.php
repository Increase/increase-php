<?php

declare(strict_types=1);

namespace Increase\Cards\CardUpdateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The contact information used in the two-factor steps for digital wallet card creation. At least one field must be present to complete the digital wallet steps.
 *
 * @phpstan-type DigitalWalletShape = array{
 *   digitalCardProfileID?: string|null, email?: string|null, phone?: string|null
 * }
 */
final class DigitalWallet implements BaseModel
{
    /** @use SdkModel<DigitalWalletShape> */
    use SdkModel;

    /**
     * The digital card profile assigned to this digital card.
     */
    #[Optional('digital_card_profile_id')]
    public ?string $digitalCardProfileID;

    /**
     * An email address that can be used to verify the cardholder via one-time passcode over email. Send `null` to clear the email address. Omit this field to leave it unchanged.
     */
    #[Optional(nullable: true)]
    public ?string $email;

    /**
     * A phone number that can be used to verify the cardholder via one-time passcode over SMS. Accepts formats like `+14155550123`, `4155550123`, `415-555-0123`, or `(415) 555-0123`. Send `null` to clear the phone number. Omit this field to leave it unchanged.
     */
    #[Optional(nullable: true)]
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
        ?string $digitalCardProfileID = null,
        ?string $email = null,
        ?string $phone = null,
    ): self {
        $self = new self;

        null !== $digitalCardProfileID && $self['digitalCardProfileID'] = $digitalCardProfileID;
        null !== $email && $self['email'] = $email;
        null !== $phone && $self['phone'] = $phone;

        return $self;
    }

    /**
     * The digital card profile assigned to this digital card.
     */
    public function withDigitalCardProfileID(string $digitalCardProfileID): self
    {
        $self = clone $this;
        $self['digitalCardProfileID'] = $digitalCardProfileID;

        return $self;
    }

    /**
     * An email address that can be used to verify the cardholder via one-time passcode over email. Send `null` to clear the email address. Omit this field to leave it unchanged.
     */
    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * A phone number that can be used to verify the cardholder via one-time passcode over SMS. Accepts formats like `+14155550123`, `4155550123`, `415-555-0123`, or `(415) 555-0123`. Send `null` to clear the phone number. Omit this field to leave it unchanged.
     */
    public function withPhone(?string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }
}
