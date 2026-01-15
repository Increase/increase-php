<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardFinancial\NetworkDetails;

use Increase\CardPayments\CardPayment\Element\CardFinancial\NetworkDetails\Visa\ElectronicCommerceIndicator;
use Increase\CardPayments\CardPayment\Element\CardFinancial\NetworkDetails\Visa\PointOfServiceEntryMode;
use Increase\CardPayments\CardPayment\Element\CardFinancial\NetworkDetails\Visa\StandInProcessingReason;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Fields specific to the `visa` network.
 *
 * @phpstan-type VisaShape = array{
 *   electronicCommerceIndicator: null|ElectronicCommerceIndicator|value-of<ElectronicCommerceIndicator>,
 *   pointOfServiceEntryMode: null|PointOfServiceEntryMode|value-of<PointOfServiceEntryMode>,
 *   standInProcessingReason: null|StandInProcessingReason|value-of<StandInProcessingReason>,
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
    #[Required(
        'electronic_commerce_indicator',
        enum: ElectronicCommerceIndicator::class
    )]
    public ?string $electronicCommerceIndicator;

    /**
     * The method used to enter the cardholder's primary account number and card expiration date.
     *
     * @var value-of<PointOfServiceEntryMode>|null $pointOfServiceEntryMode
     */
    #[Required(
        'point_of_service_entry_mode',
        enum: PointOfServiceEntryMode::class
    )]
    public ?string $pointOfServiceEntryMode;

    /**
     * Only present when `actioner: network`. Describes why a card authorization was approved or declined by Visa through stand-in processing.
     *
     * @var value-of<StandInProcessingReason>|null $standInProcessingReason
     */
    #[Required(
        'stand_in_processing_reason',
        enum: StandInProcessingReason::class
    )]
    public ?string $standInProcessingReason;

    /**
     * `new Visa()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Visa::with(
     *   electronicCommerceIndicator: ...,
     *   pointOfServiceEntryMode: ...,
     *   standInProcessingReason: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Visa)
     *   ->withElectronicCommerceIndicator(...)
     *   ->withPointOfServiceEntryMode(...)
     *   ->withStandInProcessingReason(...)
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
     * @param ElectronicCommerceIndicator|value-of<ElectronicCommerceIndicator>|null $electronicCommerceIndicator
     * @param PointOfServiceEntryMode|value-of<PointOfServiceEntryMode>|null $pointOfServiceEntryMode
     * @param StandInProcessingReason|value-of<StandInProcessingReason>|null $standInProcessingReason
     */
    public static function with(
        ElectronicCommerceIndicator|string|null $electronicCommerceIndicator,
        PointOfServiceEntryMode|string|null $pointOfServiceEntryMode,
        StandInProcessingReason|string|null $standInProcessingReason,
    ): self {
        $self = new self;

        $self['electronicCommerceIndicator'] = $electronicCommerceIndicator;
        $self['pointOfServiceEntryMode'] = $pointOfServiceEntryMode;
        $self['standInProcessingReason'] = $standInProcessingReason;

        return $self;
    }

    /**
     * For electronic commerce transactions, this identifies the level of security used in obtaining the customer's payment credential. For mail or telephone order transactions, identifies the type of mail or telephone order.
     *
     * @param ElectronicCommerceIndicator|value-of<ElectronicCommerceIndicator>|null $electronicCommerceIndicator
     */
    public function withElectronicCommerceIndicator(
        ElectronicCommerceIndicator|string|null $electronicCommerceIndicator
    ): self {
        $self = clone $this;
        $self['electronicCommerceIndicator'] = $electronicCommerceIndicator;

        return $self;
    }

    /**
     * The method used to enter the cardholder's primary account number and card expiration date.
     *
     * @param PointOfServiceEntryMode|value-of<PointOfServiceEntryMode>|null $pointOfServiceEntryMode
     */
    public function withPointOfServiceEntryMode(
        PointOfServiceEntryMode|string|null $pointOfServiceEntryMode
    ): self {
        $self = clone $this;
        $self['pointOfServiceEntryMode'] = $pointOfServiceEntryMode;

        return $self;
    }

    /**
     * Only present when `actioner: network`. Describes why a card authorization was approved or declined by Visa through stand-in processing.
     *
     * @param StandInProcessingReason|value-of<StandInProcessingReason>|null $standInProcessingReason
     */
    public function withStandInProcessingReason(
        StandInProcessingReason|string|null $standInProcessingReason
    ): self {
        $self = clone $this;
        $self['standInProcessingReason'] = $standInProcessingReason;

        return $self;
    }
}
