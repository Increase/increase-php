<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer\PhysicalCheck;

use Increase\CheckTransfers\CheckTransfer\PhysicalCheck\TrackingUpdate\Category;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type TrackingUpdateShape = array{
 *   category: Category|value-of<Category>,
 *   createdAt: \DateTimeInterface,
 *   postalCode: string,
 * }
 */
final class TrackingUpdate implements BaseModel
{
    /** @use SdkModel<TrackingUpdateShape> */
    use SdkModel;

    /**
     * The type of tracking event.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

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
     * TrackingUpdate::with(category: ..., createdAt: ..., postalCode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TrackingUpdate)->withCategory(...)->withCreatedAt(...)->withPostalCode(...)
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
        \DateTimeInterface $createdAt,
        string $postalCode
    ): self {
        $self = new self;

        $self['category'] = $category;
        $self['createdAt'] = $createdAt;
        $self['postalCode'] = $postalCode;

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
