<?php

declare(strict_types=1);

namespace Increase\PhysicalCards\PhysicalCard\Shipment\Tracking;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\PhysicalCards\PhysicalCard\Shipment\Tracking\Update\Category;

/**
 * @phpstan-type UpdateShape = array{
 *   carrierEstimatedDeliveryAt: \DateTimeInterface|null,
 *   category: Category|value-of<Category>,
 *   city: string|null,
 *   createdAt: \DateTimeInterface,
 *   postalCode: string|null,
 *   state: string|null,
 * }
 */
final class Update implements BaseModel
{
    /** @use SdkModel<UpdateShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time when the carrier expects the card to be delivered.
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
     * The city where the event took place.
     */
    #[Required]
    public ?string $city;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the tracking event took place.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The postal code where the event took place.
     */
    #[Required('postal_code')]
    public ?string $postalCode;

    /**
     * The state where the event took place.
     */
    #[Required]
    public ?string $state;

    /**
     * `new Update()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Update::with(
     *   carrierEstimatedDeliveryAt: ...,
     *   category: ...,
     *   city: ...,
     *   createdAt: ...,
     *   postalCode: ...,
     *   state: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Update)
     *   ->withCarrierEstimatedDeliveryAt(...)
     *   ->withCategory(...)
     *   ->withCity(...)
     *   ->withCreatedAt(...)
     *   ->withPostalCode(...)
     *   ->withState(...)
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
        ?string $city,
        \DateTimeInterface $createdAt,
        ?string $postalCode,
        ?string $state,
    ): self {
        $self = new self;

        $self['carrierEstimatedDeliveryAt'] = $carrierEstimatedDeliveryAt;
        $self['category'] = $category;
        $self['city'] = $city;
        $self['createdAt'] = $createdAt;
        $self['postalCode'] = $postalCode;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time when the carrier expects the card to be delivered.
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
     * The city where the event took place.
     */
    public function withCity(?string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

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
    public function withPostalCode(?string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * The state where the event took place.
     */
    public function withState(?string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
