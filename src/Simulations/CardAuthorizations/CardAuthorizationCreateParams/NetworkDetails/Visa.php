<?php

declare(strict_types=1);

namespace Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\NetworkDetails;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\NetworkDetails\Visa\StandInProcessingReason;

/**
 * Fields specific to the Visa network.
 *
 * @phpstan-type VisaShape = array{
 *   standInProcessingReason?: null|StandInProcessingReason|value-of<StandInProcessingReason>,
 * }
 */
final class Visa implements BaseModel
{
    /** @use SdkModel<VisaShape> */
    use SdkModel;

    /**
     * The reason code for the stand-in processing.
     *
     * @var value-of<StandInProcessingReason>|null $standInProcessingReason
     */
    #[Optional(
        'stand_in_processing_reason',
        enum: StandInProcessingReason::class
    )]
    public ?string $standInProcessingReason;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param StandInProcessingReason|value-of<StandInProcessingReason>|null $standInProcessingReason
     */
    public static function with(
        StandInProcessingReason|string|null $standInProcessingReason = null
    ): self {
        $self = new self;

        null !== $standInProcessingReason && $self['standInProcessingReason'] = $standInProcessingReason;

        return $self;
    }

    /**
     * The reason code for the stand-in processing.
     *
     * @param StandInProcessingReason|value-of<StandInProcessingReason> $standInProcessingReason
     */
    public function withStandInProcessingReason(
        StandInProcessingReason|string $standInProcessingReason
    ): self {
        $self = clone $this;
        $self['standInProcessingReason'] = $standInProcessingReason;

        return $self;
    }
}
