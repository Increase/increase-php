<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer\PhysicalCheck;

use Increase\CheckTransfers\CheckTransfer\PhysicalCheck\TrackingUpdate\Category;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type TrackingUpdateShape = array{
 *   carrierEstimatedDeliveryAt: \DateTimeInterface|null,
 *   category: Category|value-of<Category>,
 *   country: string,
 *   createdAt: \DateTimeInterface,
 *   postalCode: string,
 * }
 */
final class TrackingUpdate implements BaseModel
{
    /** @use SdkModel<TrackingUpdateShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time when the carrier expects the check to be delivered.
     */
    #[Required('carrier_estimated_delivery_at')]
    public ?\DateTimeInterface $carrierEstimatedDeliveryAt;

    /**
     * The type of tracking event.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * The ISO 3166-1 alpha-2 country code for the country where the event took place.
     */
    #[Required]
    public string $country;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the tracking event took place.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The postal code where the event took place.
     */
    #[Required('postal_code')]
    public string $postalCode;

    /**
     * `new TrackingUpdate()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TrackingUpdate::with(
     *   carrierEstimatedDeliveryAt: ...,
     *   category: ...,
     *   country: ...,
     *   createdAt: ...,
     *   postalCode: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TrackingUpdate)
     *   ->withCarrierEstimatedDeliveryAt(...)
     *   ->withCategory(...)
     *   ->withCountry(...)
     *   ->withCreatedAt(...)
     *   ->withPostalCode(...)
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
     * @param Category|value-of<Category> $category
     */
    public static function with(
        ?\DateTimeInterface $carrierEstimatedDeliveryAt,
        Category|string $category,
        string $country,
        \DateTimeInterface $createdAt,
        string $postalCode,
    ): self {
        $self = new self;

        $self['carrierEstimatedDeliveryAt'] = $carrierEstimatedDeliveryAt;
        $self['category'] = $category;
        $self['country'] = $country;
        $self['createdAt'] = $createdAt;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time when the carrier expects the check to be delivered.
     */
    public function withCarrierEstimatedDeliveryAt(
        ?\DateTimeInterface $carrierEstimatedDeliveryAt
    ): self {
        $self = clone $this;
        $self['carrierEstimatedDeliveryAt'] = $carrierEstimatedDeliveryAt;

        return $self;
    }

    /**
     * The type of tracking event.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * The ISO 3166-1 alpha-2 country code for the country where the event took place.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the tracking event took place.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The postal code where the event took place.
     */
    public function withPostalCode(string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }
}
