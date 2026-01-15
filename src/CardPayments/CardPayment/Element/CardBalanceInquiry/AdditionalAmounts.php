<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardBalanceInquiry;

use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Clinic;
use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Dental;
use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Original;
use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Prescription;
use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Surcharge;
use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\TotalCumulative;
use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\TotalHealthcare;
use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Transit;
use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Unknown;
use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Vision;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Additional amounts associated with the card authorization, such as ATM surcharges fees. These are usually a subset of the `amount` field and are used to provide more detailed information about the transaction.
 *
 * @phpstan-import-type ClinicShape from \Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Clinic
 * @phpstan-import-type DentalShape from \Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Dental
 * @phpstan-import-type OriginalShape from \Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Original
 * @phpstan-import-type PrescriptionShape from \Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Prescription
 * @phpstan-import-type SurchargeShape from \Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Surcharge
 * @phpstan-import-type TotalCumulativeShape from \Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\TotalCumulative
 * @phpstan-import-type TotalHealthcareShape from \Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\TotalHealthcare
 * @phpstan-import-type TransitShape from \Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Transit
 * @phpstan-import-type UnknownShape from \Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Unknown
 * @phpstan-import-type VisionShape from \Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\AdditionalAmounts\Vision
 *
 * @phpstan-type AdditionalAmountsShape = array{
 *   clinic: null|Clinic|ClinicShape,
 *   dental: null|Dental|DentalShape,
 *   original: null|Original|OriginalShape,
 *   prescription: null|Prescription|PrescriptionShape,
 *   surcharge: null|Surcharge|SurchargeShape,
 *   totalCumulative: null|TotalCumulative|TotalCumulativeShape,
 *   totalHealthcare: null|TotalHealthcare|TotalHealthcareShape,
 *   transit: null|Transit|TransitShape,
 *   unknown: null|Unknown|UnknownShape,
 *   vision: null|Vision|VisionShape,
 * }
 */
final class AdditionalAmounts implements BaseModel
{
    /** @use SdkModel<AdditionalAmountsShape> */
    use SdkModel;

    /**
     * The part of this transaction amount that was for clinic-related services.
     */
    #[Required]
    public ?Clinic $clinic;

    /**
     * The part of this transaction amount that was for dental-related services.
     */
    #[Required]
    public ?Dental $dental;

    /**
     * The original pre-authorized amount.
     */
    #[Required]
    public ?Original $original;

    /**
     * The part of this transaction amount that was for healthcare prescriptions.
     */
    #[Required]
    public ?Prescription $prescription;

    /**
     * The surcharge amount charged for this transaction by the merchant.
     */
    #[Required]
    public ?Surcharge $surcharge;

    /**
     * The total amount of a series of incremental authorizations, optionally provided.
     */
    #[Required('total_cumulative')]
    public ?TotalCumulative $totalCumulative;

    /**
     * The total amount of healthcare-related additional amounts.
     */
    #[Required('total_healthcare')]
    public ?TotalHealthcare $totalHealthcare;

    /**
     * The part of this transaction amount that was for transit-related services.
     */
    #[Required]
    public ?Transit $transit;

    /**
     * An unknown additional amount.
     */
    #[Required]
    public ?Unknown $unknown;

    /**
     * The part of this transaction amount that was for vision-related services.
     */
    #[Required]
    public ?Vision $vision;

    /**
     * `new AdditionalAmounts()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AdditionalAmounts::with(
     *   clinic: ...,
     *   dental: ...,
     *   original: ...,
     *   prescription: ...,
     *   surcharge: ...,
     *   totalCumulative: ...,
     *   totalHealthcare: ...,
     *   transit: ...,
     *   unknown: ...,
     *   vision: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AdditionalAmounts)
     *   ->withClinic(...)
     *   ->withDental(...)
     *   ->withOriginal(...)
     *   ->withPrescription(...)
     *   ->withSurcharge(...)
     *   ->withTotalCumulative(...)
     *   ->withTotalHealthcare(...)
     *   ->withTransit(...)
     *   ->withUnknown(...)
     *   ->withVision(...)
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
     * @param Clinic|ClinicShape|null $clinic
     * @param Dental|DentalShape|null $dental
     * @param Original|OriginalShape|null $original
     * @param Prescription|PrescriptionShape|null $prescription
     * @param Surcharge|SurchargeShape|null $surcharge
     * @param TotalCumulative|TotalCumulativeShape|null $totalCumulative
     * @param TotalHealthcare|TotalHealthcareShape|null $totalHealthcare
     * @param Transit|TransitShape|null $transit
     * @param Unknown|UnknownShape|null $unknown
     * @param Vision|VisionShape|null $vision
     */
    public static function with(
        Clinic|array|null $clinic,
        Dental|array|null $dental,
        Original|array|null $original,
        Prescription|array|null $prescription,
        Surcharge|array|null $surcharge,
        TotalCumulative|array|null $totalCumulative,
        TotalHealthcare|array|null $totalHealthcare,
        Transit|array|null $transit,
        Unknown|array|null $unknown,
        Vision|array|null $vision,
    ): self {
        $self = new self;

        $self['clinic'] = $clinic;
        $self['dental'] = $dental;
        $self['original'] = $original;
        $self['prescription'] = $prescription;
        $self['surcharge'] = $surcharge;
        $self['totalCumulative'] = $totalCumulative;
        $self['totalHealthcare'] = $totalHealthcare;
        $self['transit'] = $transit;
        $self['unknown'] = $unknown;
        $self['vision'] = $vision;

        return $self;
    }

    /**
     * The part of this transaction amount that was for clinic-related services.
     *
     * @param Clinic|ClinicShape|null $clinic
     */
    public function withClinic(Clinic|array|null $clinic): self
    {
        $self = clone $this;
        $self['clinic'] = $clinic;

        return $self;
    }

    /**
     * The part of this transaction amount that was for dental-related services.
     *
     * @param Dental|DentalShape|null $dental
     */
    public function withDental(Dental|array|null $dental): self
    {
        $self = clone $this;
        $self['dental'] = $dental;

        return $self;
    }

    /**
     * The original pre-authorized amount.
     *
     * @param Original|OriginalShape|null $original
     */
    public function withOriginal(Original|array|null $original): self
    {
        $self = clone $this;
        $self['original'] = $original;

        return $self;
    }

    /**
     * The part of this transaction amount that was for healthcare prescriptions.
     *
     * @param Prescription|PrescriptionShape|null $prescription
     */
    public function withPrescription(
        Prescription|array|null $prescription
    ): self {
        $self = clone $this;
        $self['prescription'] = $prescription;

        return $self;
    }

    /**
     * The surcharge amount charged for this transaction by the merchant.
     *
     * @param Surcharge|SurchargeShape|null $surcharge
     */
    public function withSurcharge(Surcharge|array|null $surcharge): self
    {
        $self = clone $this;
        $self['surcharge'] = $surcharge;

        return $self;
    }

    /**
     * The total amount of a series of incremental authorizations, optionally provided.
     *
     * @param TotalCumulative|TotalCumulativeShape|null $totalCumulative
     */
    public function withTotalCumulative(
        TotalCumulative|array|null $totalCumulative
    ): self {
        $self = clone $this;
        $self['totalCumulative'] = $totalCumulative;

        return $self;
    }

    /**
     * The total amount of healthcare-related additional amounts.
     *
     * @param TotalHealthcare|TotalHealthcareShape|null $totalHealthcare
     */
    public function withTotalHealthcare(
        TotalHealthcare|array|null $totalHealthcare
    ): self {
        $self = clone $this;
        $self['totalHealthcare'] = $totalHealthcare;

        return $self;
    }

    /**
     * The part of this transaction amount that was for transit-related services.
     *
     * @param Transit|TransitShape|null $transit
     */
    public function withTransit(Transit|array|null $transit): self
    {
        $self = clone $this;
        $self['transit'] = $transit;

        return $self;
    }

    /**
     * An unknown additional amount.
     *
     * @param Unknown|UnknownShape|null $unknown
     */
    public function withUnknown(Unknown|array|null $unknown): self
    {
        $self = clone $this;
        $self['unknown'] = $unknown;

        return $self;
    }

    /**
     * The part of this transaction amount that was for vision-related services.
     *
     * @param Vision|VisionShape|null $vision
     */
    public function withVision(Vision|array|null $vision): self
    {
        $self = clone $this;
        $self['vision'] = $vision;

        return $self;
    }
}
