<?php

declare(strict_types=1);

namespace Increase\PhysicalCardProfiles;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\PhysicalCardProfiles\PhysicalCardProfileCloneParams\FrontText;

/**
 * Clone a Physical Card Profile.
 *
 * @see Increase\Services\PhysicalCardProfilesService::clone()
 *
 * @phpstan-import-type FrontTextShape from \Increase\PhysicalCardProfiles\PhysicalCardProfileCloneParams\FrontText
 *
 * @phpstan-type PhysicalCardProfileCloneParamsShape = array{
 *   carrierImageFileID?: string|null,
 *   contactPhone?: string|null,
 *   description?: string|null,
 *   frontImageFileID?: string|null,
 *   frontText?: null|FrontText|FrontTextShape,
 *   programID?: string|null,
 * }
 */
final class PhysicalCardProfileCloneParams implements BaseModel
{
    /** @use SdkModel<PhysicalCardProfileCloneParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the File containing the physical card's carrier image.
     */
    #[Optional('carrier_image_file_id')]
    public ?string $carrierImageFileID;

    /**
     * A phone number the user can contact to receive support for their card.
     */
    #[Optional('contact_phone')]
    public ?string $contactPhone;

    /**
     * A description you can use to identify the Card Profile.
     */
    #[Optional]
    public ?string $description;

    /**
     * The identifier of the File containing the physical card's front image.
     */
    #[Optional('front_image_file_id')]
    public ?string $frontImageFileID;

    /**
     * Text printed on the front of the card. Reach out to [support@increase.com](mailto:support@increase.com) for more information.
     */
    #[Optional('front_text')]
    public ?FrontText $frontText;

    /**
     * The identifier of the Program to use for the cloned Physical Card Profile.
     */
    #[Optional('program_id')]
    public ?string $programID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param FrontText|FrontTextShape|null $frontText
     */
    public static function with(
        ?string $carrierImageFileID = null,
        ?string $contactPhone = null,
        ?string $description = null,
        ?string $frontImageFileID = null,
        FrontText|array|null $frontText = null,
        ?string $programID = null,
    ): self {
        $self = new self;

        null !== $carrierImageFileID && $self['carrierImageFileID'] = $carrierImageFileID;
        null !== $contactPhone && $self['contactPhone'] = $contactPhone;
        null !== $description && $self['description'] = $description;
        null !== $frontImageFileID && $self['frontImageFileID'] = $frontImageFileID;
        null !== $frontText && $self['frontText'] = $frontText;
        null !== $programID && $self['programID'] = $programID;

        return $self;
    }

    /**
     * The identifier of the File containing the physical card's carrier image.
     */
    public function withCarrierImageFileID(string $carrierImageFileID): self
    {
        $self = clone $this;
        $self['carrierImageFileID'] = $carrierImageFileID;

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
     * A description you can use to identify the Card Profile.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The identifier of the File containing the physical card's front image.
     */
    public function withFrontImageFileID(string $frontImageFileID): self
    {
        $self = clone $this;
        $self['frontImageFileID'] = $frontImageFileID;

        return $self;
    }

    /**
     * Text printed on the front of the card. Reach out to [support@increase.com](mailto:support@increase.com) for more information.
     *
     * @param FrontText|FrontTextShape $frontText
     */
    public function withFrontText(FrontText|array $frontText): self
    {
        $self = clone $this;
        $self['frontText'] = $frontText;

        return $self;
    }

    /**
     * The identifier of the Program to use for the cloned Physical Card Profile.
     */
    public function withProgramID(string $programID): self
    {
        $self = clone $this;
        $self['programID'] = $programID;

        return $self;
    }
}
