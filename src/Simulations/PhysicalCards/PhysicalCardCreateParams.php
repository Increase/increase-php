<?php

declare(strict_types=1);

namespace Increase\Simulations\PhysicalCards;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\PhysicalCards\PhysicalCardCreateParams\Category;

/**
 * This endpoint allows you to simulate receiving a tracking update for a Physical Card, to simulate the progress of a shipment.
 *
 * @see Increase\Services\Simulations\PhysicalCardsService::create()
 *
 * @phpstan-type PhysicalCardCreateParamsShape = array{
 *   category: Category|value-of<Category>,
 *   carrierEstimatedDeliveryAt?: \DateTimeInterface|null,
 *   city?: string|null,
 *   postalCode?: string|null,
 *   state?: string|null,
 * }
 */
final class PhysicalCardCreateParams implements BaseModel
{
    /** @use SdkModel<PhysicalCardCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The type of tracking event.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time when the carrier expects the card to be delivered.
     */
    #[Optional('carrier_estimated_delivery_at')]
    public ?\DateTimeInterface $carrierEstimatedDeliveryAt;

    /**
     * The city where the event took place.
     */
    #[Optional]
    public ?string $city;

    /**
     * The postal code where the event took place.
     */
    #[Optional('postal_code')]
    public ?string $postalCode;

    /**
     * The state where the event took place.
     */
    #[Optional]
    public ?string $state;

    /**
     * `new PhysicalCardCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PhysicalCardCreateParams::with(category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PhysicalCardCreateParams)->withCategory(...)
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
        Category|string $category,
        ?\DateTimeInterface $carrierEstimatedDeliveryAt = null,
        ?string $city = null,
        ?string $postalCode = null,
        ?string $state = null,
    ): self {
        $self = new self;

        $self['category'] = $category;

        null !== $carrierEstimatedDeliveryAt && $self['carrierEstimatedDeliveryAt'] = $carrierEstimatedDeliveryAt;
        null !== $city && $self['city'] = $city;
        null !== $postalCode && $self['postalCode'] = $postalCode;
        null !== $state && $self['state'] = $state;

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
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time when the carrier expects the card to be delivered.
     */
    public function withCarrierEstimatedDeliveryAt(
        \DateTimeInterface $carrierEstimatedDeliveryAt
    ): self {
        $self = clone $this;
        $self['carrierEstimatedDeliveryAt'] = $carrierEstimatedDeliveryAt;

        return $self;
    }

    /**
     * The city where the event took place.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

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

    /**
     * The state where the event took place.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
