<?php

declare(strict_types=1);

namespace Increase\CardPurchaseSupplements\CardPurchaseSupplement;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Shipping information for the purchase.
 *
 * @phpstan-type ShippingShape = array{
 *   customerReferenceNumber: string|null,
 *   destinationAddress: string|null,
 *   destinationCountryCode: string|null,
 *   destinationPostalCode: string|null,
 *   destinationReceiverName: string|null,
 *   discountAmount: int|null,
 *   netAmount: int|null,
 *   numberOfPackages: int|null,
 *   originAddress: string|null,
 *   originCountryCode: string|null,
 *   originPostalCode: string|null,
 *   originSenderName: string|null,
 *   pickUpDate: string|null,
 *   serviceDescription: string|null,
 *   serviceLevelCode: string|null,
 *   shippingCourierName: string|null,
 *   taxAmount: int|null,
 *   trackingNumber: string|null,
 *   unitOfMeasure: string|null,
 *   weight: string|null,
 * }
 */
final class Shipping implements BaseModel
{
    /** @use SdkModel<ShippingShape> */
    use SdkModel;

    /**
     * The customer reference number.
     */
    #[Required('customer_reference_number')]
    public ?string $customerReferenceNumber;

    /**
     * Address of the destination.
     */
    #[Required('destination_address')]
    public ?string $destinationAddress;

    /**
     * Country code of the destination.
     */
    #[Required('destination_country_code')]
    public ?string $destinationCountryCode;

    /**
     * Postal code of the destination.
     */
    #[Required('destination_postal_code')]
    public ?string $destinationPostalCode;

    /**
     * Name of the receiver at the destination.
     */
    #[Required('destination_receiver_name')]
    public ?string $destinationReceiverName;

    /**
     * Discount amount for the shipment.
     */
    #[Required('discount_amount')]
    public ?int $discountAmount;

    /**
     * Net shipping amount.
     */
    #[Required('net_amount')]
    public ?int $netAmount;

    /**
     * Number of packages shipped.
     */
    #[Required('number_of_packages')]
    public ?int $numberOfPackages;

    /**
     * Address of the origin.
     */
    #[Required('origin_address')]
    public ?string $originAddress;

    /**
     * Country code of the origin.
     */
    #[Required('origin_country_code')]
    public ?string $originCountryCode;

    /**
     * Postal code of the origin.
     */
    #[Required('origin_postal_code')]
    public ?string $originPostalCode;

    /**
     * Name of the sender at the origin.
     */
    #[Required('origin_sender_name')]
    public ?string $originSenderName;

    /**
     * Date the shipment should be picked up.
     */
    #[Required('pick_up_date')]
    public ?string $pickUpDate;

    /**
     * Description of the shipping service.
     */
    #[Required('service_description')]
    public ?string $serviceDescription;

    /**
     * Service level code for the shipment.
     */
    #[Required('service_level_code')]
    public ?string $serviceLevelCode;

    /**
     * Name of the shipping courier.
     */
    #[Required('shipping_courier_name')]
    public ?string $shippingCourierName;

    /**
     * Tax amount for the shipment.
     */
    #[Required('tax_amount')]
    public ?int $taxAmount;

    /**
     * Tracking number for the shipment.
     */
    #[Required('tracking_number')]
    public ?string $trackingNumber;

    /**
     * Unit of measure for the shipment weight.
     */
    #[Required('unit_of_measure')]
    public ?string $unitOfMeasure;

    /**
     * Weight of the shipment.
     */
    #[Required]
    public ?string $weight;

    /**
     * `new Shipping()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Shipping::with(
     *   customerReferenceNumber: ...,
     *   destinationAddress: ...,
     *   destinationCountryCode: ...,
     *   destinationPostalCode: ...,
     *   destinationReceiverName: ...,
     *   discountAmount: ...,
     *   netAmount: ...,
     *   numberOfPackages: ...,
     *   originAddress: ...,
     *   originCountryCode: ...,
     *   originPostalCode: ...,
     *   originSenderName: ...,
     *   pickUpDate: ...,
     *   serviceDescription: ...,
     *   serviceLevelCode: ...,
     *   shippingCourierName: ...,
     *   taxAmount: ...,
     *   trackingNumber: ...,
     *   unitOfMeasure: ...,
     *   weight: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Shipping)
     *   ->withCustomerReferenceNumber(...)
     *   ->withDestinationAddress(...)
     *   ->withDestinationCountryCode(...)
     *   ->withDestinationPostalCode(...)
     *   ->withDestinationReceiverName(...)
     *   ->withDiscountAmount(...)
     *   ->withNetAmount(...)
     *   ->withNumberOfPackages(...)
     *   ->withOriginAddress(...)
     *   ->withOriginCountryCode(...)
     *   ->withOriginPostalCode(...)
     *   ->withOriginSenderName(...)
     *   ->withPickUpDate(...)
     *   ->withServiceDescription(...)
     *   ->withServiceLevelCode(...)
     *   ->withShippingCourierName(...)
     *   ->withTaxAmount(...)
     *   ->withTrackingNumber(...)
     *   ->withUnitOfMeasure(...)
     *   ->withWeight(...)
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
     */
    public static function with(
        ?string $customerReferenceNumber,
        ?string $destinationAddress,
        ?string $destinationCountryCode,
        ?string $destinationPostalCode,
        ?string $destinationReceiverName,
        ?int $discountAmount,
        ?int $netAmount,
        ?int $numberOfPackages,
        ?string $originAddress,
        ?string $originCountryCode,
        ?string $originPostalCode,
        ?string $originSenderName,
        ?string $pickUpDate,
        ?string $serviceDescription,
        ?string $serviceLevelCode,
        ?string $shippingCourierName,
        ?int $taxAmount,
        ?string $trackingNumber,
        ?string $unitOfMeasure,
        ?string $weight,
    ): self {
        $self = new self;

        $self['customerReferenceNumber'] = $customerReferenceNumber;
        $self['destinationAddress'] = $destinationAddress;
        $self['destinationCountryCode'] = $destinationCountryCode;
        $self['destinationPostalCode'] = $destinationPostalCode;
        $self['destinationReceiverName'] = $destinationReceiverName;
        $self['discountAmount'] = $discountAmount;
        $self['netAmount'] = $netAmount;
        $self['numberOfPackages'] = $numberOfPackages;
        $self['originAddress'] = $originAddress;
        $self['originCountryCode'] = $originCountryCode;
        $self['originPostalCode'] = $originPostalCode;
        $self['originSenderName'] = $originSenderName;
        $self['pickUpDate'] = $pickUpDate;
        $self['serviceDescription'] = $serviceDescription;
        $self['serviceLevelCode'] = $serviceLevelCode;
        $self['shippingCourierName'] = $shippingCourierName;
        $self['taxAmount'] = $taxAmount;
        $self['trackingNumber'] = $trackingNumber;
        $self['unitOfMeasure'] = $unitOfMeasure;
        $self['weight'] = $weight;

        return $self;
    }

    /**
     * The customer reference number.
     */
    public function withCustomerReferenceNumber(
        ?string $customerReferenceNumber
    ): self {
        $self = clone $this;
        $self['customerReferenceNumber'] = $customerReferenceNumber;

        return $self;
    }

    /**
     * Address of the destination.
     */
    public function withDestinationAddress(?string $destinationAddress): self
    {
        $self = clone $this;
        $self['destinationAddress'] = $destinationAddress;

        return $self;
    }

    /**
     * Country code of the destination.
     */
    public function withDestinationCountryCode(
        ?string $destinationCountryCode
    ): self {
        $self = clone $this;
        $self['destinationCountryCode'] = $destinationCountryCode;

        return $self;
    }

    /**
     * Postal code of the destination.
     */
    public function withDestinationPostalCode(
        ?string $destinationPostalCode
    ): self {
        $self = clone $this;
        $self['destinationPostalCode'] = $destinationPostalCode;

        return $self;
    }

    /**
     * Name of the receiver at the destination.
     */
    public function withDestinationReceiverName(
        ?string $destinationReceiverName
    ): self {
        $self = clone $this;
        $self['destinationReceiverName'] = $destinationReceiverName;

        return $self;
    }

    /**
     * Discount amount for the shipment.
     */
    public function withDiscountAmount(?int $discountAmount): self
    {
        $self = clone $this;
        $self['discountAmount'] = $discountAmount;

        return $self;
    }

    /**
     * Net shipping amount.
     */
    public function withNetAmount(?int $netAmount): self
    {
        $self = clone $this;
        $self['netAmount'] = $netAmount;

        return $self;
    }

    /**
     * Number of packages shipped.
     */
    public function withNumberOfPackages(?int $numberOfPackages): self
    {
        $self = clone $this;
        $self['numberOfPackages'] = $numberOfPackages;

        return $self;
    }

    /**
     * Address of the origin.
     */
    public function withOriginAddress(?string $originAddress): self
    {
        $self = clone $this;
        $self['originAddress'] = $originAddress;

        return $self;
    }

    /**
     * Country code of the origin.
     */
    public function withOriginCountryCode(?string $originCountryCode): self
    {
        $self = clone $this;
        $self['originCountryCode'] = $originCountryCode;

        return $self;
    }

    /**
     * Postal code of the origin.
     */
    public function withOriginPostalCode(?string $originPostalCode): self
    {
        $self = clone $this;
        $self['originPostalCode'] = $originPostalCode;

        return $self;
    }

    /**
     * Name of the sender at the origin.
     */
    public function withOriginSenderName(?string $originSenderName): self
    {
        $self = clone $this;
        $self['originSenderName'] = $originSenderName;

        return $self;
    }

    /**
     * Date the shipment should be picked up.
     */
    public function withPickUpDate(?string $pickUpDate): self
    {
        $self = clone $this;
        $self['pickUpDate'] = $pickUpDate;

        return $self;
    }

    /**
     * Description of the shipping service.
     */
    public function withServiceDescription(?string $serviceDescription): self
    {
        $self = clone $this;
        $self['serviceDescription'] = $serviceDescription;

        return $self;
    }

    /**
     * Service level code for the shipment.
     */
    public function withServiceLevelCode(?string $serviceLevelCode): self
    {
        $self = clone $this;
        $self['serviceLevelCode'] = $serviceLevelCode;

        return $self;
    }

    /**
     * Name of the shipping courier.
     */
    public function withShippingCourierName(?string $shippingCourierName): self
    {
        $self = clone $this;
        $self['shippingCourierName'] = $shippingCourierName;

        return $self;
    }

    /**
     * Tax amount for the shipment.
     */
    public function withTaxAmount(?int $taxAmount): self
    {
        $self = clone $this;
        $self['taxAmount'] = $taxAmount;

        return $self;
    }

    /**
     * Tracking number for the shipment.
     */
    public function withTrackingNumber(?string $trackingNumber): self
    {
        $self = clone $this;
        $self['trackingNumber'] = $trackingNumber;

        return $self;
    }

    /**
     * Unit of measure for the shipment weight.
     */
    public function withUnitOfMeasure(?string $unitOfMeasure): self
    {
        $self = clone $this;
        $self['unitOfMeasure'] = $unitOfMeasure;

        return $self;
    }

    /**
     * Weight of the shipment.
     */
    public function withWeight(?string $weight): self
    {
        $self = clone $this;
        $self['weight'] = $weight;

        return $self;
    }
}
