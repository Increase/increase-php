<?php

declare(strict_types=1);

namespace Increase\DigitalCardProfiles;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DigitalCardProfiles\DigitalCardProfile\Status;
use Increase\DigitalCardProfiles\DigitalCardProfile\TextColor;
use Increase\DigitalCardProfiles\DigitalCardProfile\Type;

/**
 * This contains artwork and metadata relating to a Card's appearance in digital wallet apps like Apple Pay and Google Pay. For more information, see our guide on [digital card artwork](https://increase.com/documentation/card-art).
 *
 * @phpstan-import-type TextColorShape from \Increase\DigitalCardProfiles\DigitalCardProfile\TextColor
 *
 * @phpstan-type DigitalCardProfileShape = array{
 *   id: string,
 *   appIconFileID: string,
 *   backgroundImageFileID: string,
 *   cardDescription: string,
 *   contactEmail: string|null,
 *   contactPhone: string|null,
 *   contactWebsite: string|null,
 *   createdAt: \DateTimeInterface,
 *   description: string,
 *   idempotencyKey: string|null,
 *   issuerName: string,
 *   status: Status|value-of<Status>,
 *   textColor: TextColor|TextColorShape,
 *   type: Type|value-of<Type>,
 * }
 */
final class DigitalCardProfile implements BaseModel
{
    /** @use SdkModel<DigitalCardProfileShape> */
    use SdkModel;

    /**
     * The Card Profile identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier of the File containing the card's icon image.
     */
    #[Required('app_icon_file_id')]
    public string $appIconFileID;

    /**
     * The identifier of the File containing the card's front image.
     */
    #[Required('background_image_file_id')]
    public string $backgroundImageFileID;

    /**
     * A user-facing description for the card itself.
     */
    #[Required('card_description')]
    public string $cardDescription;

    /**
     * An email address the user can contact to receive support for their card.
     */
    #[Required('contact_email')]
    public ?string $contactEmail;

    /**
     * A phone number the user can contact to receive support for their card.
     */
    #[Required('contact_phone')]
    public ?string $contactPhone;

    /**
     * A website the user can visit to view and receive support for their card.
     */
    #[Required('contact_website')]
    public ?string $contactWebsite;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Digital Card Profile was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * A description you can use to identify the Card Profile.
     */
    #[Required]
    public string $description;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * A user-facing description for whoever is issuing the card.
     */
    #[Required('issuer_name')]
    public string $issuerName;

    /**
     * The status of the Card Profile.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * The Card's text color, specified as an RGB triple.
     */
    #[Required('text_color')]
    public TextColor $textColor;

    /**
     * A constant representing the object's type. For this resource it will always be `digital_card_profile`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new DigitalCardProfile()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalCardProfile::with(
     *   id: ...,
     *   appIconFileID: ...,
     *   backgroundImageFileID: ...,
     *   cardDescription: ...,
     *   contactEmail: ...,
     *   contactPhone: ...,
     *   contactWebsite: ...,
     *   createdAt: ...,
     *   description: ...,
     *   idempotencyKey: ...,
     *   issuerName: ...,
     *   status: ...,
     *   textColor: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalCardProfile)
     *   ->withID(...)
     *   ->withAppIconFileID(...)
     *   ->withBackgroundImageFileID(...)
     *   ->withCardDescription(...)
     *   ->withContactEmail(...)
     *   ->withContactPhone(...)
     *   ->withContactWebsite(...)
     *   ->withCreatedAt(...)
     *   ->withDescription(...)
     *   ->withIdempotencyKey(...)
     *   ->withIssuerName(...)
     *   ->withStatus(...)
     *   ->withTextColor(...)
     *   ->withType(...)
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
     * @param TextColor|TextColorShape $textColor
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $appIconFileID,
        string $backgroundImageFileID,
        string $cardDescription,
        ?string $contactEmail,
        ?string $contactPhone,
        ?string $contactWebsite,
        \DateTimeInterface $createdAt,
        string $description,
        ?string $idempotencyKey,
        string $issuerName,
        Status|string $status,
        TextColor|array $textColor,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['appIconFileID'] = $appIconFileID;
        $self['backgroundImageFileID'] = $backgroundImageFileID;
        $self['cardDescription'] = $cardDescription;
        $self['contactEmail'] = $contactEmail;
        $self['contactPhone'] = $contactPhone;
        $self['contactWebsite'] = $contactWebsite;
        $self['createdAt'] = $createdAt;
        $self['description'] = $description;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['issuerName'] = $issuerName;
        $self['status'] = $status;
        $self['textColor'] = $textColor;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Card Profile identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier of the File containing the card's icon image.
     */
    public function withAppIconFileID(string $appIconFileID): self
    {
        $self = clone $this;
        $self['appIconFileID'] = $appIconFileID;

        return $self;
    }

    /**
     * The identifier of the File containing the card's front image.
     */
    public function withBackgroundImageFileID(
        string $backgroundImageFileID
    ): self {
        $self = clone $this;
        $self['backgroundImageFileID'] = $backgroundImageFileID;

        return $self;
    }

    /**
     * A user-facing description for the card itself.
     */
    public function withCardDescription(string $cardDescription): self
    {
        $self = clone $this;
        $self['cardDescription'] = $cardDescription;

        return $self;
    }

    /**
     * An email address the user can contact to receive support for their card.
     */
    public function withContactEmail(?string $contactEmail): self
    {
        $self = clone $this;
        $self['contactEmail'] = $contactEmail;

        return $self;
    }

    /**
     * A phone number the user can contact to receive support for their card.
     */
    public function withContactPhone(?string $contactPhone): self
    {
        $self = clone $this;
        $self['contactPhone'] = $contactPhone;

        return $self;
    }

    /**
     * A website the user can visit to view and receive support for their card.
     */
    public function withContactWebsite(?string $contactWebsite): self
    {
        $self = clone $this;
        $self['contactWebsite'] = $contactWebsite;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Digital Card Profile was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * A description you can use to identify the Card Profile.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * A user-facing description for whoever is issuing the card.
     */
    public function withIssuerName(string $issuerName): self
    {
        $self = clone $this;
        $self['issuerName'] = $issuerName;

        return $self;
    }

    /**
     * The status of the Card Profile.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The Card's text color, specified as an RGB triple.
     *
     * @param TextColor|TextColorShape $textColor
     */
    public function withTextColor(TextColor|array $textColor): self
    {
        $self = clone $this;
        $self['textColor'] = $textColor;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `digital_card_profile`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
