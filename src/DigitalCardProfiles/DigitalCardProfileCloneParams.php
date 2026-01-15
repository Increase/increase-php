<?php

declare(strict_types=1);

namespace Increase\DigitalCardProfiles;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\DigitalCardProfiles\DigitalCardProfileCloneParams\TextColor;

/**
 * Clones a Digital Card Profile.
 *
 * @see Increase\Services\DigitalCardProfilesService::clone()
 *
 * @phpstan-import-type TextColorShape from \Increase\DigitalCardProfiles\DigitalCardProfileCloneParams\TextColor
 *
 * @phpstan-type DigitalCardProfileCloneParamsShape = array{
 *   appIconFileID?: string|null,
 *   backgroundImageFileID?: string|null,
 *   cardDescription?: string|null,
 *   contactEmail?: string|null,
 *   contactPhone?: string|null,
 *   contactWebsite?: string|null,
 *   description?: string|null,
 *   issuerName?: string|null,
 *   textColor?: null|TextColor|TextColorShape,
 * }
 */
final class DigitalCardProfileCloneParams implements BaseModel
{
    /** @use SdkModel<DigitalCardProfileCloneParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the File containing the card's icon image.
     */
    #[Optional('app_icon_file_id')]
    public ?string $appIconFileID;

    /**
     * The identifier of the File containing the card's front image.
     */
    #[Optional('background_image_file_id')]
    public ?string $backgroundImageFileID;

    /**
     * A user-facing description for the card itself.
     */
    #[Optional('card_description')]
    public ?string $cardDescription;

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
     * A description you can use to identify the Card Profile.
     */
    #[Optional]
    public ?string $description;

    /**
     * A user-facing description for whoever is issuing the card.
     */
    #[Optional('issuer_name')]
    public ?string $issuerName;

    /**
     * The Card's text color, specified as an RGB triple. The default is white.
     */
    #[Optional('text_color')]
    public ?TextColor $textColor;

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
        ?string $appIconFileID = null,
        ?string $backgroundImageFileID = null,
        ?string $cardDescription = null,
        ?string $contactEmail = null,
        ?string $contactPhone = null,
        ?string $contactWebsite = null,
        ?string $description = null,
        ?string $issuerName = null,
        TextColor|array|null $textColor = null,
    ): self {
        $self = new self;

        null !== $appIconFileID && $self['appIconFileID'] = $appIconFileID;
        null !== $backgroundImageFileID && $self['backgroundImageFileID'] = $backgroundImageFileID;
        null !== $cardDescription && $self['cardDescription'] = $cardDescription;
        null !== $contactEmail && $self['contactEmail'] = $contactEmail;
        null !== $contactPhone && $self['contactPhone'] = $contactPhone;
        null !== $contactWebsite && $self['contactWebsite'] = $contactWebsite;
        null !== $description && $self['description'] = $description;
        null !== $issuerName && $self['issuerName'] = $issuerName;
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
