<?php

declare(strict_types=1);

namespace Increase\Entities\EntityUpdateParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityUpdateParams\RiskRating\Rating;

/**
 * An assessment of the entity’s potential risk of involvement in financial crimes, such as money laundering.
 *
 * @phpstan-type RiskRatingShape = array{
 *   ratedAt: \DateTimeInterface, rating: Rating|value-of<Rating>
 * }
 */
final class RiskRating implements BaseModel
{
    /** @use SdkModel<RiskRatingShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the risk rating was performed.
     */
    #[Required('rated_at')]
    public \DateTimeInterface $ratedAt;

    /**
     * The rating given to this entity.
     *
     * @var value-of<Rating> $rating
     */
    #[Required(enum: Rating::class)]
    public string $rating;

    /**
     * `new RiskRating()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RiskRating::with(ratedAt: ..., rating: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RiskRating)->withRatedAt(...)->withRating(...)
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
     * @param Rating|value-of<Rating> $rating
     */
    public static function with(
        \DateTimeInterface $ratedAt,
        Rating|string $rating
    ): self {
        $self = new self;

        $self['ratedAt'] = $ratedAt;
        $self['rating'] = $rating;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the risk rating was performed.
     */
    public function withRatedAt(\DateTimeInterface $ratedAt): self
    {
        $self = clone $this;
        $self['ratedAt'] = $ratedAt;

        return $self;
    }

    /**
     * The rating given to this entity.
     *
     * @param Rating|value-of<Rating> $rating
     */
    public function withRating(Rating|string $rating): self
    {
        $self = clone $this;
        $self['rating'] = $rating;

        return $self;
    }
}
