<?php

declare(strict_types=1);

namespace Increase\DigitalCardProfiles;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\DigitalCardProfiles\DigitalCardProfileCreateParams\TextColor;

/**
 * Create a Digital Card Profile.
 *
 * @see Increase\Services\DigitalCardProfilesService::create()
 *
 * @phpstan-import-type TextColorShape from \Increase\DigitalCardProfiles\DigitalCardProfileCreateParams\TextColor
 *
 * @phpstan-type DigitalCardProfileCreateParamsShape = array{
 *   appIconFileID: string,
 *   backgroundImageFileID: string,
 *   cardDescription: string,
 *   description: string,
 *   issuerName: string,
 *   contactEmail?: string|null,
 *   contactPhone?: string|null,
 *   contactWebsite?: string|null,
 *   textColor?: null|TextColor|TextColorShape,
 * }
 */
final class DigitalCardProfileCreateParams implements BaseModel
{
    /** @use SdkModel<DigitalCardProfileCreateParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * A description you can use to identify the Card Profile.
     */
    #[Required]
    public string $description;

    /**
     * A user-facing description for whoever is issuing the card.
     */
    #[Required('issuer_name')]
    public string $issuerName;

    /**
     * An email address the user can contact to receive support for their card.
     */
    #[Optional('contact_email')]
    public ?string $contactEmail;

    /**
     * A phone number the user can contact to receive support for their card.
     */
    #[Optional('contact_phone')]
    public ?string $contactPhone;

    /**
     * A website the user can visit to view and receive support for their card.
     */
    #[Optional('contact_website')]
    public ?string $contactWebsite;

    /**
     * The Card's text color, specified as an RGB triple. The default is white.
     */
    #[Optional('text_color')]
    public ?TextColor $textColor;

    /**
     * `new DigitalCardProfileCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalCardProfileCreateParams::with(
     *   appIconFileID: ...,
     *   backgroundImageFileID: ...,
     *   cardDescription: ...,
     *   description: ...,
     *   issuerName: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalCardProfileCreateParams)
     *   ->withAppIconFileID(...)
     *   ->withBackgroundImageFileID(...)
     *   ->withCardDescription(...)
     *   ->withDescription(...)
     *   ->withIssuerName(...)
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
     * @param TextColor|TextColorShape|null $textColor
     */
    public static function with(
        string $appIconFileID,
        string $backgroundImageFileID,
        string $cardDescription,
        string $description,
        string $issuerName,
        ?string $contactEmail = null,
        ?string $contactPhone = null,
        ?string $contactWebsite = null,
        TextColor|array|null $textColor = null,
    ): self {
        $self = new self;

        $self['appIconFileID'] = $appIconFileID;
        $self['backgroundImageFileID'] = $backgroundImageFileID;
        $self['cardDescription'] = $cardDescription;
        $self['description'] = $description;
        $self['issuerName'] = $issuerName;

        null !== $contactEmail && $self['contactEmail'] = $contactEmail;
        null !== $contactPhone && $self['contactPhone'] = $contactPhone;
        null !== $contactWebsite && $self['contactWebsite'] = $contactWebsite;
        null !== $textColor && $self['textColor'] = $textColor;

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
     * A description you can use to identify the Card Profile.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

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
     * An email address the user can contact to receive support for their card.
     */
    public function withContactEmail(string $contactEmail): self
    {
        $self = clone $this;
        $self['contactEmail'] = $contactEmail;

        return $self;
    }

    /**
     * A phone number the user can contact to receive support for their card.
     */
    public function withContactPhone(string $contactPhone): self
    {
        $self = clone $this;
        $self['contactPhone'] = $contactPhone;

        return $self;
    }

    /**
     * A website the user can visit to view and receive support for their card.
     */
    public function withContactWebsite(string $contactWebsite): self
    {
        $self = clone $this;
        $self['contactWebsite'] = $contactWebsite;

        return $self;
    }

    /**
     * The Card's text color, specified as an RGB triple. The default is white.
     *
     * @param TextColor|TextColorShape $textColor
     */
    public function withTextColor(TextColor|array $textColor): self
    {
        $self = clone $this;
        $self['textColor'] = $textColor;

        return $self;
    }
}
