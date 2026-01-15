<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledServices\CardholderCancellation;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledServices\GuaranteedReservation;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledServices\MerchantResolutionAttempted;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledServices\Other;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledServices\ServiceType;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledServices\Timeshare;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Canceled services. Present if and only if `category` is `consumer_canceled_services`.
 *
 * @phpstan-import-type CardholderCancellationShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledServices\CardholderCancellation
 * @phpstan-import-type GuaranteedReservationShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledServices\GuaranteedReservation
 * @phpstan-import-type OtherShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledServices\Other
 * @phpstan-import-type TimeshareShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledServices\Timeshare
 *
 * @phpstan-type ConsumerCanceledServicesShape = array{
 *   cardholderCancellation: CardholderCancellation|CardholderCancellationShape,
 *   contractedAt: string,
 *   guaranteedReservation: null|GuaranteedReservation|GuaranteedReservationShape,
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   other: null|Other|OtherShape,
 *   purchaseExplanation: string,
 *   serviceType: ServiceType|value-of<ServiceType>,
 *   timeshare: null|Timeshare|TimeshareShape,
 * }
 */
final class ConsumerCanceledServices implements BaseModel
{
    /** @use SdkModel<ConsumerCanceledServicesShape> */
    use SdkModel;

    /**
     * Cardholder cancellation.
     */
    #[Required('cardholder_cancellation')]
    public CardholderCancellation $cardholderCancellation;

    /**
     * Contracted at.
     */
    #[Required('contracted_at')]
    public string $contractedAt;

    /**
     * Guaranteed reservation explanation. Present if and only if `service_type` is `guaranteed_reservation`.
     */
    #[Required('guaranteed_reservation')]
    public ?GuaranteedReservation $guaranteedReservation;

    /**
     * Merchant resolution attempted.
     *
     * @var value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     */
    #[Required(
        'merchant_resolution_attempted',
        enum: MerchantResolutionAttempted::class
    )]
    public string $merchantResolutionAttempted;

    /**
     * Other service type explanation. Present if and only if `service_type` is `other`.
     */
    #[Required]
    public ?Other $other;

    /**
     * Purchase explanation.
     */
    #[Required('purchase_explanation')]
    public string $purchaseExplanation;

    /**
     * Service type.
     *
     * @var value-of<ServiceType> $serviceType
     */
    #[Required('service_type', enum: ServiceType::class)]
    public string $serviceType;

    /**
     * Timeshare explanation. Present if and only if `service_type` is `timeshare`.
     */
    #[Required]
    public ?Timeshare $timeshare;

    /**
     * `new ConsumerCanceledServices()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerCanceledServices::with(
     *   cardholderCancellation: ...,
     *   contractedAt: ...,
     *   guaranteedReservation: ...,
     *   merchantResolutionAttempted: ...,
     *   other: ...,
     *   purchaseExplanation: ...,
     *   serviceType: ...,
     *   timeshare: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerCanceledServices)
     *   ->withCardholderCancellation(...)
     *   ->withContractedAt(...)
     *   ->withGuaranteedReservation(...)
     *   ->withMerchantResolutionAttempted(...)
     *   ->withOther(...)
     *   ->withPurchaseExplanation(...)
     *   ->withServiceType(...)
     *   ->withTimeshare(...)
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
     * @param CardholderCancellation|CardholderCancellationShape $cardholderCancellation
     * @param GuaranteedReservation|GuaranteedReservationShape|null $guaranteedReservation
     * @param MerchantResolutionAttempted|value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     * @param Other|OtherShape|null $other
     * @param ServiceType|value-of<ServiceType> $serviceType
     * @param Timeshare|TimeshareShape|null $timeshare
     */
    public static function with(
        CardholderCancellation|array $cardholderCancellation,
        string $contractedAt,
        GuaranteedReservation|array|null $guaranteedReservation,
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        Other|array|null $other,
        string $purchaseExplanation,
        ServiceType|string $serviceType,
        Timeshare|array|null $timeshare,
    ): self {
        $self = new self;

        $self['cardholderCancellation'] = $cardholderCancellation;
        $self['contractedAt'] = $contractedAt;
        $self['guaranteedReservation'] = $guaranteedReservation;
        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;
        $self['other'] = $other;
        $self['purchaseExplanation'] = $purchaseExplanation;
        $self['serviceType'] = $serviceType;
        $self['timeshare'] = $timeshare;

        return $self;
    }

    /**
     * Cardholder cancellation.
     *
     * @param CardholderCancellation|CardholderCancellationShape $cardholderCancellation
     */
    public function withCardholderCancellation(
        CardholderCancellation|array $cardholderCancellation
    ): self {
        $self = clone $this;
        $self['cardholderCancellation'] = $cardholderCancellation;

        return $self;
    }

    /**
     * Contracted at.
     */
    public function withContractedAt(string $contractedAt): self
    {
        $self = clone $this;
        $self['contractedAt'] = $contractedAt;

        return $self;
    }

    /**
     * Guaranteed reservation explanation. Present if and only if `service_type` is `guaranteed_reservation`.
     *
     * @param GuaranteedReservation|GuaranteedReservationShape|null $guaranteedReservation
     */
    public function withGuaranteedReservation(
        GuaranteedReservation|array|null $guaranteedReservation
    ): self {
        $self = clone $this;
        $self['guaranteedReservation'] = $guaranteedReservation;

        return $self;
    }

    /**
     * Merchant resolution attempted.
     *
     * @param MerchantResolutionAttempted|value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     */
    public function withMerchantResolutionAttempted(
        MerchantResolutionAttempted|string $merchantResolutionAttempted
    ): self {
        $self = clone $this;
        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;

        return $self;
    }

    /**
     * Other service type explanation. Present if and only if `service_type` is `other`.
     *
     * @param Other|OtherShape|null $other
     */
    public function withOther(Other|array|null $other): self
    {
        $self = clone $this;
        $self['other'] = $other;

        return $self;
    }

    /**
     * Purchase explanation.
     */
    public function withPurchaseExplanation(string $purchaseExplanation): self
    {
        $self = clone $this;
        $self['purchaseExplanation'] = $purchaseExplanation;

        return $self;
    }

    /**
     * Service type.
     *
     * @param ServiceType|value-of<ServiceType> $serviceType
     */
    public function withServiceType(ServiceType|string $serviceType): self
    {
        $self = clone $this;
        $self['serviceType'] = $serviceType;

        return $self;
    }

    /**
     * Timeshare explanation. Present if and only if `service_type` is `timeshare`.
     *
     * @param Timeshare|TimeshareShape|null $timeshare
     */
    public function withTimeshare(Timeshare|array|null $timeshare): self
    {
        $self = clone $this;
        $self['timeshare'] = $timeshare;

        return $self;
    }
}
