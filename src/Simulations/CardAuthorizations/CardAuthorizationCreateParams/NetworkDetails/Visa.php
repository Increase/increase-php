<?php

declare(strict_types=1);

namespace Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\NetworkDetails;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\NetworkDetails\Visa\ElectronicCommerceIndicator;
use Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\NetworkDetails\Visa\PointOfServiceEntryMode;
use Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\NetworkDetails\Visa\StandInProcessingReason;
use Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\NetworkDetails\Visa\TerminalEntryCapability;

/**
 * Fields specific to the Visa network.
 *
 * @phpstan-type VisaShape = array{
 *   electronicCommerceIndicator?: null|ElectronicCommerceIndicator|value-of<ElectronicCommerceIndicator>,
 *   pointOfServiceEntryMode?: null|PointOfServiceEntryMode|value-of<PointOfServiceEntryMode>,
 *   standInProcessingReason?: null|StandInProcessingReason|value-of<StandInProcessingReason>,
 *   terminalEntryCapability?: null|TerminalEntryCapability|value-of<TerminalEntryCapability>,
 * }
 */
final class Visa implements BaseModel
{
    /** @use SdkModel<VisaShape> */
    use SdkModel;

    /**
     * For electronic commerce transactions, this identifies the level of security used in obtaining the customer's payment credential. For mail or telephone order transactions, identifies the type of mail or telephone order.
     *
     * @var value-of<ElectronicCommerceIndicator>|null $electronicCommerceIndicator
     */
    #[Optional(
        'electronic_commerce_indicator',
        enum: ElectronicCommerceIndicator::class
    )]
    public ?string $electronicCommerceIndicator;

    /**
     * The method used to enter the cardholder's primary account number and card expiration date.
     *
     * @var value-of<PointOfServiceEntryMode>|null $pointOfServiceEntryMode
     */
    #[Optional(
        'point_of_service_entry_mode',
        enum: PointOfServiceEntryMode::class
    )]
    public ?string $pointOfServiceEntryMode;

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

    /**
     * The capability of the terminal being used to read the card. Shows whether a terminal can e.g., accept chip cards or if it only supports magnetic stripe reads. This reflects the highest capability of the terminal — for example, a terminal that supports both chip and magnetic stripe will be identified as chip-capable.
     *
     * @var value-of<TerminalEntryCapability>|null $terminalEntryCapability
     */
    #[Optional('terminal_entry_capability', enum: TerminalEntryCapability::class)]
    public ?string $terminalEntryCapability;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ElectronicCommerceIndicator|value-of<ElectronicCommerceIndicator>|null $electronicCommerceIndicator
     * @param PointOfServiceEntryMode|value-of<PointOfServiceEntryMode>|null $pointOfServiceEntryMode
     * @param StandInProcessingReason|value-of<StandInProcessingReason>|null $standInProcessingReason
     * @param TerminalEntryCapability|value-of<TerminalEntryCapability>|null $terminalEntryCapability
     */
    public static function with(
        ElectronicCommerceIndicator|string|null $electronicCommerceIndicator = null,
        PointOfServiceEntryMode|string|null $pointOfServiceEntryMode = null,
        StandInProcessingReason|string|null $standInProcessingReason = null,
        TerminalEntryCapability|string|null $terminalEntryCapability = null,
    ): self {
        $self = new self;

        null !== $electronicCommerceIndicator && $self['electronicCommerceIndicator'] = $electronicCommerceIndicator;
        null !== $pointOfServiceEntryMode && $self['pointOfServiceEntryMode'] = $pointOfServiceEntryMode;
        null !== $standInProcessingReason && $self['standInProcessingReason'] = $standInProcessingReason;
        null !== $terminalEntryCapability && $self['terminalEntryCapability'] = $terminalEntryCapability;

        return $self;
    }

    /**
     * For electronic commerce transactions, this identifies the level of security used in obtaining the customer's payment credential. For mail or telephone order transactions, identifies the type of mail or telephone order.
     *
     * @param ElectronicCommerceIndicator|value-of<ElectronicCommerceIndicator> $electronicCommerceIndicator
     */
    public function withElectronicCommerceIndicator(
        ElectronicCommerceIndicator|string $electronicCommerceIndicator
    ): self {
        $self = clone $this;
        $self['electronicCommerceIndicator'] = $electronicCommerceIndicator;

        return $self;
    }

    /**
     * The method used to enter the cardholder's primary account number and card expiration date.
     *
     * @param PointOfServiceEntryMode|value-of<PointOfServiceEntryMode> $pointOfServiceEntryMode
     */
    public function withPointOfServiceEntryMode(
        PointOfServiceEntryMode|string $pointOfServiceEntryMode
    ): self {
        $self = clone $this;
        $self['pointOfServiceEntryMode'] = $pointOfServiceEntryMode;

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

    /**
     * The capability of the terminal being used to read the card. Shows whether a terminal can e.g., accept chip cards or if it only supports magnetic stripe reads. This reflects the highest capability of the terminal — for example, a terminal that supports both chip and magnetic stripe will be identified as chip-capable.
     *
     * @param TerminalEntryCapability|value-of<TerminalEntryCapability> $terminalEntryCapability
     */
    public function withTerminalEntryCapability(
        TerminalEntryCapability|string $terminalEntryCapability
    ): self {
        $self = clone $this;
        $self['terminalEntryCapability'] = $terminalEntryCapability;

        return $self;
    }
}
