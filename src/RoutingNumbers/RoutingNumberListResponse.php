<?php

declare(strict_types=1);

namespace Increase\RoutingNumbers;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RoutingNumbers\RoutingNumberListResponse\ACHTransfers;
use Increase\RoutingNumbers\RoutingNumberListResponse\FednowTransfers;
use Increase\RoutingNumbers\RoutingNumberListResponse\RealTimePaymentsTransfers;
use Increase\RoutingNumbers\RoutingNumberListResponse\Type;
use Increase\RoutingNumbers\RoutingNumberListResponse\WireTransfers;

/**
 * Routing numbers are used to identify your bank in a financial transaction.
 *
 * @phpstan-type RoutingNumberListResponseShape = array{
 *   achTransfers: ACHTransfers|value-of<ACHTransfers>,
 *   fednowTransfers: FednowTransfers|value-of<FednowTransfers>,
 *   name: string,
 *   realTimePaymentsTransfers: RealTimePaymentsTransfers|value-of<RealTimePaymentsTransfers>,
 *   routingNumber: string,
 *   type: Type|value-of<Type>,
 *   wireTransfers: WireTransfers|value-of<WireTransfers>,
 * }
 */
final class RoutingNumberListResponse implements BaseModel
{
    /** @use SdkModel<RoutingNumberListResponseShape> */
    use SdkModel;

    /**
     * This routing number's support for ACH Transfers.
     *
     * @var value-of<ACHTransfers> $achTransfers
     */
    #[Required('ach_transfers', enum: ACHTransfers::class)]
    public string $achTransfers;

    /**
     * This routing number's support for FedNow Transfers.
     *
     * @var value-of<FednowTransfers> $fednowTransfers
     */
    #[Required('fednow_transfers', enum: FednowTransfers::class)]
    public string $fednowTransfers;

    /**
     * The name of the financial institution belonging to a routing number.
     */
    #[Required]
    public string $name;

    /**
     * This routing number's support for Real-Time Payments Transfers.
     *
     * @var value-of<RealTimePaymentsTransfers> $realTimePaymentsTransfers
     */
    #[Required(
        'real_time_payments_transfers',
        enum: RealTimePaymentsTransfers::class
    )]
    public string $realTimePaymentsTransfers;

    /**
     * The nine digit routing number identifier.
     */
    #[Required('routing_number')]
    public string $routingNumber;

    /**
     * A constant representing the object's type. For this resource it will always be `routing_number`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * This routing number's support for Wire Transfers.
     *
     * @var value-of<WireTransfers> $wireTransfers
     */
    #[Required('wire_transfers', enum: WireTransfers::class)]
    public string $wireTransfers;

    /**
     * `new RoutingNumberListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingNumberListResponse::with(
     *   achTransfers: ...,
     *   fednowTransfers: ...,
     *   name: ...,
     *   realTimePaymentsTransfers: ...,
     *   routingNumber: ...,
     *   type: ...,
     *   wireTransfers: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingNumberListResponse)
     *   ->withACHTransfers(...)
     *   ->withFednowTransfers(...)
     *   ->withName(...)
     *   ->withRealTimePaymentsTransfers(...)
     *   ->withRoutingNumber(...)
     *   ->withType(...)
     *   ->withWireTransfers(...)
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
     * @param ACHTransfers|value-of<ACHTransfers> $achTransfers
     * @param FednowTransfers|value-of<FednowTransfers> $fednowTransfers
     * @param RealTimePaymentsTransfers|value-of<RealTimePaymentsTransfers> $realTimePaymentsTransfers
     * @param Type|value-of<Type> $type
     * @param WireTransfers|value-of<WireTransfers> $wireTransfers
     */
    public static function with(
        ACHTransfers|string $achTransfers,
        FednowTransfers|string $fednowTransfers,
        string $name,
        RealTimePaymentsTransfers|string $realTimePaymentsTransfers,
        string $routingNumber,
        Type|string $type,
        WireTransfers|string $wireTransfers,
    ): self {
        $self = new self;

        $self['achTransfers'] = $achTransfers;
        $self['fednowTransfers'] = $fednowTransfers;
        $self['name'] = $name;
        $self['realTimePaymentsTransfers'] = $realTimePaymentsTransfers;
        $self['routingNumber'] = $routingNumber;
        $self['type'] = $type;
        $self['wireTransfers'] = $wireTransfers;

        return $self;
    }

    /**
     * This routing number's support for ACH Transfers.
     *
     * @param ACHTransfers|value-of<ACHTransfers> $achTransfers
     */
    public function withACHTransfers(ACHTransfers|string $achTransfers): self
    {
        $self = clone $this;
        $self['achTransfers'] = $achTransfers;

        return $self;
    }

    /**
     * This routing number's support for FedNow Transfers.
     *
     * @param FednowTransfers|value-of<FednowTransfers> $fednowTransfers
     */
    public function withFednowTransfers(
        FednowTransfers|string $fednowTransfers
    ): self {
        $self = clone $this;
        $self['fednowTransfers'] = $fednowTransfers;

        return $self;
    }

    /**
     * The name of the financial institution belonging to a routing number.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * This routing number's support for Real-Time Payments Transfers.
     *
     * @param RealTimePaymentsTransfers|value-of<RealTimePaymentsTransfers> $realTimePaymentsTransfers
     */
    public function withRealTimePaymentsTransfers(
        RealTimePaymentsTransfers|string $realTimePaymentsTransfers
    ): self {
        $self = clone $this;
        $self['realTimePaymentsTransfers'] = $realTimePaymentsTransfers;

        return $self;
    }

    /**
     * The nine digit routing number identifier.
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `routing_number`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * This routing number's support for Wire Transfers.
     *
     * @param WireTransfers|value-of<WireTransfers> $wireTransfers
     */
    public function withWireTransfers(WireTransfers|string $wireTransfers): self
    {
        $self = clone $this;
        $self['wireTransfers'] = $wireTransfers;

        return $self;
    }
}
