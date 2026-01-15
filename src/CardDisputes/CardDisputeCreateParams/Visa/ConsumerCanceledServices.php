<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa;

use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices\CardholderCancellation;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices\GuaranteedReservation;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices\MerchantResolutionAttempted;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices\Other;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices\ServiceType;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices\Timeshare;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Canceled services. Required if and only if `category` is `consumer_canceled_services`.
 *
 * @phpstan-import-type CardholderCancellationShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices\CardholderCancellation
 * @phpstan-import-type GuaranteedReservationShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices\GuaranteedReservation
 * @phpstan-import-type OtherShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices\Other
 * @phpstan-import-type TimeshareShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices\Timeshare
 *
 * @phpstan-type ConsumerCanceledServicesShape = array{
 *   cardholderCancellation: CardholderCancellation|CardholderCancellationShape,
 *   contractedAt: string,
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   purchaseExplanation: string,
 *   serviceType: ServiceType|value-of<ServiceType>,
 *   guaranteedReservation?: null|GuaranteedReservation|GuaranteedReservationShape,
 *   other?: null|Other|OtherShape,
 *   timeshare?: null|Timeshare|TimeshareShape,
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
     * Guaranteed reservation explanation. Required if and only if `service_type` is `guaranteed_reservation`.
     */
    #[Optional('guaranteed_reservation')]
    public ?GuaranteedReservation $guaranteedReservation;

    /**
     * Other service type explanation. Required if and only if `service_type` is `other`.
     */
    #[Optional]
    public ?Other $other;

    /**
     * Timeshare explanation. Required if and only if `service_type` is `timeshare`.
     */
    #[Optional]
    public ?Timeshare $timeshare;

    /**
     * `new ConsumerCanceledServices()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerCanceledServices::with(
     *   cardholderCancellation: ...,
     *   contractedAt: ...,
     *   merchantResolutionAttempted: ...,
     *   purchaseExplanation: ...,
     *   serviceType: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerCanceledServices)
     *   ->withCardholderCancellation(...)
     *   ->withContractedAt(...)
     *   ->withMerchantResolutionAttempted(...)
     *   ->withPurchaseExplanation(...)
     *   ->withServiceType(...)
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
     * @param MerchantResolutionAttempted|value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     * @param ServiceType|value-of<ServiceType> $serviceType
     * @param GuaranteedReservation|GuaranteedReservationShape|null $guaranteedReservation
     * @param Other|OtherShape|null $other
     * @param Timeshare|TimeshareShape|null $timeshare
     */
    public static function with(
        CardholderCancellation|array $cardholderCancellation,
        string $contractedAt,
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        string $purchaseExplanation,
        ServiceType|string $serviceType,
        GuaranteedReservation|array|null $guaranteedReservation = null,
        Other|array|null $other = null,
        Timeshare|array|null $timeshare = null,
    ): self {
        $self = new self;

        $self['cardholderCancellation'] = $cardholderCancellation;
        $self['contractedAt'] = $contractedAt;
        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;
        $self['purchaseExplanation'] = $purchaseExplanation;
        $self['serviceType'] = $serviceType;

        null !== $guaranteedReservation && $self['guaranteedReservation'] = $guaranteedReservation;
        null !== $other && $self['other'] = $other;
        null !== $timeshare && $self['timeshare'] = $timeshare;

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
     * Guaranteed reservation explanation. Required if and only if `service_type` is `guaranteed_reservation`.
     *
     * @param GuaranteedReservation|GuaranteedReservationShape $guaranteedReservation
     */
    public function withGuaranteedReservation(
        GuaranteedReservation|array $guaranteedReservation
    ): self {
        $self = clone $this;
        $self['guaranteedReservation'] = $guaranteedReservation;

        return $self;
    }

    /**
     * Other service type explanation. Required if and only if `service_type` is `other`.
     *
     * @param Other|OtherShape $other
     */
    public function withOther(Other|array $other): self
    {
        $self = clone $this;
        $self['other'] = $other;

        return $self;
    }

    /**
     * Timeshare explanation. Required if and only if `service_type` is `timeshare`.
     *
     * @param Timeshare|TimeshareShape $timeshare
     */
    public function withTimeshare(Timeshare|array $timeshare): self
    {
        $self = clone $this;
        $self['timeshare'] = $timeshare;

        return $self;
    }
}
