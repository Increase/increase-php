<?php

declare(strict_types=1);

namespace Increase\PhysicalCardProfiles;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\PhysicalCardProfiles\PhysicalCardProfileCreateParams\FrontText;

/**
 * Create a Physical Card Profile.
 *
 * @see Increase\Services\PhysicalCardProfilesService::create()
 *
 * @phpstan-import-type FrontTextShape from \Increase\PhysicalCardProfiles\PhysicalCardProfileCreateParams\FrontText
 *
 * @phpstan-type PhysicalCardProfileCreateParamsShape = array{
 *   carrierImageFileID: string,
 *   contactPhone: string,
 *   description: string,
 *   frontImageFileID: string,
 *   programID: string,
 *   frontText?: null|FrontText|FrontTextShape,
 * }
 */
final class PhysicalCardProfileCreateParams implements BaseModel
{
    /** @use SdkModel<PhysicalCardProfileCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the File containing the physical card's carrier image.
     */
    #[Required('carrier_image_file_id')]
    public string $carrierImageFileID;

    /**
     * A phone number the user can contact to receive support for their card.
     */
    #[Required('contact_phone')]
    public string $contactPhone;

    /**
     * A description you can use to identify the Card Profile.
     */
    #[Required]
    public string $description;

    /**
     * The identifier of the File containing the physical card's front image.
     */
    #[Required('front_image_file_id')]
    public string $frontImageFileID;

    /**
     * The identifier for the Program that this Physical Card Profile falls under.
     */
    #[Required('program_id')]
    public string $programID;

    /**
     * Text printed on the front of the card. Reach out to [support@increase.com](mailto:support@increase.com) for more information.
     */
    #[Optional('front_text')]
    public ?FrontText $frontText;

    /**
     * `new PhysicalCardProfileCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PhysicalCardProfileCreateParams::with(
     *   carrierImageFileID: ...,
     *   contactPhone: ...,
     *   description: ...,
     *   frontImageFileID: ...,
     *   programID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PhysicalCardProfileCreateParams)
     *   ->withCarrierImageFileID(...)
     *   ->withContactPhone(...)
     *   ->withDescription(...)
     *   ->withFrontImageFileID(...)
     *   ->withProgramID(...)
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
     * @param FrontText|FrontTextShape|null $frontText
     */
    public static function with(
        string $carrierImageFileID,
        string $contactPhone,
        string $description,
        string $frontImageFileID,
        string $programID,
        FrontText|array|null $frontText = null,
    ): self {
        $self = new self;

        $self['carrierImageFileID'] = $carrierImageFileID;
        $self['contactPhone'] = $contactPhone;
        $self['description'] = $description;
        $self['frontImageFileID'] = $frontImageFileID;
        $self['programID'] = $programID;

        null !== $frontText && $self['frontText'] = $frontText;

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
     * The identifier for the Program that this Physical Card Profile falls under.
     */
    public function withProgramID(string $programID): self
    {
        $self = clone $this;
        $self['programID'] = $programID;

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
}
