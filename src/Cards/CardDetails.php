<?php

declare(strict_types=1);

namespace Increase\Cards;

use Increase\Cards\CardDetails\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * An object containing the sensitive details (card number, CVC, PIN, etc) for a Card. These details are not included in the Card object. If you'd prefer to never access these details directly, you can use the [embedded iframe](/documentation/embedded-card-component) to display the information to your users.
 *
 * @phpstan-type CardDetailsShape = array{
 *   cardID: string,
 *   expirationMonth: int,
 *   expirationYear: int,
 *   pin: string,
 *   primaryAccountNumber: string,
 *   type: Type|value-of<Type>,
 *   verificationCode: string,
 * }
 */
final class CardDetails implements BaseModel
{
    /** @use SdkModel<CardDetailsShape> */
    use SdkModel;

    /**
     * The identifier for the Card for which sensitive details have been returned.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * The month the card expires in M format (e.g., August is 8).
     */
    #[Required('expiration_month')]
    public int $expirationMonth;

    /**
     * The year the card expires in YYYY format (e.g., 2025).
     */
    #[Required('expiration_year')]
    public int $expirationYear;

    /**
     * The 4-digit PIN for the card, for use with ATMs.
     */
    #[Required]
    public string $pin;

    /**
     * The card number.
     */
    #[Required('primary_account_number')]
    public string $primaryAccountNumber;

    /**
     * A constant representing the object's type. For this resource it will always be `card_details`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The three-digit verification code for the card. It's also known as the Card Verification Code (CVC), the Card Verification Value (CVV), or the Card Identification (CID).
     */
    #[Required('verification_code')]
    public string $verificationCode;

    /**
     * `new CardDetails()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardDetails::with(
     *   cardID: ...,
     *   expirationMonth: ...,
     *   expirationYear: ...,
     *   pin: ...,
     *   primaryAccountNumber: ...,
     *   type: ...,
     *   verificationCode: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardDetails)
     *   ->withCardID(...)
     *   ->withExpirationMonth(...)
     *   ->withExpirationYear(...)
     *   ->withPin(...)
     *   ->withPrimaryAccountNumber(...)
     *   ->withType(...)
     *   ->withVerificationCode(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $cardID,
        int $expirationMonth,
        int $expirationYear,
        string $pin,
        string $primaryAccountNumber,
        Type|string $type,
        string $verificationCode,
    ): self {
        $self = new self;

        $self['cardID'] = $cardID;
        $self['expirationMonth'] = $expirationMonth;
        $self['expirationYear'] = $expirationYear;
        $self['pin'] = $pin;
        $self['primaryAccountNumber'] = $primaryAccountNumber;
        $self['type'] = $type;
        $self['verificationCode'] = $verificationCode;

        return $self;
    }

    /**
     * The identifier for the Card for which sensitive details have been returned.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

        return $self;
    }

    /**
     * The month the card expires in M format (e.g., August is 8).
     */
    public function withExpirationMonth(int $expirationMonth): self
    {
        $self = clone $this;
        $self['expirationMonth'] = $expirationMonth;

        return $self;
    }

    /**
     * The year the card expires in YYYY format (e.g., 2025).
     */
    public function withExpirationYear(int $expirationYear): self
    {
        $self = clone $this;
        $self['expirationYear'] = $expirationYear;

        return $self;
    }

    /**
     * The 4-digit PIN for the card, for use with ATMs.
     */
    public function withPin(string $pin): self
    {
        $self = clone $this;
        $self['pin'] = $pin;

        return $self;
    }

    /**
     * The card number.
     */
    public function withPrimaryAccountNumber(string $primaryAccountNumber): self
    {
        $self = clone $this;
        $self['primaryAccountNumber'] = $primaryAccountNumber;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `card_details`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The three-digit verification code for the card. It's also known as the Card Verification Code (CVC), the Card Verification Value (CVV), or the Card Identification (CID).
     */
    public function withVerificationCode(string $verificationCode): self
    {
        $self = clone $this;
        $self['verificationCode'] = $verificationCode;

        return $self;
    }
}
