<?php

declare(strict_types=1);

namespace Increase\Cards\Card;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type RenewalShape = array{
 *   previousExpirationMonth: int,
 *   previousExpirationYear: int,
 *   renewedAt: \DateTimeInterface,
 * }
 */
final class Renewal implements BaseModel
{
    /** @use SdkModel<RenewalShape> */
    use SdkModel;

    /**
     * The month the Card expired in before this renewal, in M format (e.g., August is 8).
     */
    #[Required('previous_expiration_month')]
    public int $previousExpirationMonth;

    /**
     * The year the Card expired in before this renewal, in YYYY format (e.g., 2025).
     */
    #[Required('previous_expiration_year')]
    public int $previousExpirationYear;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card was renewed.
     */
    #[Required('renewed_at')]
    public \DateTimeInterface $renewedAt;

    /**
     * `new Renewal()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Renewal::with(
     *   previousExpirationMonth: ..., previousExpirationYear: ..., renewedAt: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Renewal)
     *   ->withPreviousExpirationMonth(...)
     *   ->withPreviousExpirationYear(...)
     *   ->withRenewedAt(...)
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
        int $previousExpirationMonth,
        int $previousExpirationYear,
        \DateTimeInterface $renewedAt,
    ): self {
        $self = new self;

        $self['previousExpirationMonth'] = $previousExpirationMonth;
        $self['previousExpirationYear'] = $previousExpirationYear;
        $self['renewedAt'] = $renewedAt;

        return $self;
    }

    /**
     * The month the Card expired in before this renewal, in M format (e.g., August is 8).
     */
    public function withPreviousExpirationMonth(
        int $previousExpirationMonth
    ): self {
        $self = clone $this;
        $self['previousExpirationMonth'] = $previousExpirationMonth;

        return $self;
    }

    /**
     * The year the Card expired in before this renewal, in YYYY format (e.g., 2025).
     */
    public function withPreviousExpirationYear(
        int $previousExpirationYear
    ): self {
        $self = clone $this;
        $self['previousExpirationYear'] = $previousExpirationYear;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card was renewed.
     */
    public function withRenewedAt(\DateTimeInterface $renewedAt): self
    {
        $self = clone $this;
        $self['renewedAt'] = $renewedAt;

        return $self;
    }
}
