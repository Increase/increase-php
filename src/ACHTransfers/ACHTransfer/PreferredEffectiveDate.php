<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer;

use Increase\ACHTransfers\ACHTransfer\PreferredEffectiveDate\SettlementSchedule;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Configuration for how the effective date of the transfer will be set. This determines same-day vs future-dated settlement timing. If not set, defaults to a `settlement_schedule` of `same_day`. If set, exactly one of the child attributes must be set.
 *
 * @phpstan-type PreferredEffectiveDateShape = array{
 *   date: string|null,
 *   settlementSchedule: null|SettlementSchedule|value-of<SettlementSchedule>,
 * }
 */
final class PreferredEffectiveDate implements BaseModel
{
    /** @use SdkModel<PreferredEffectiveDateShape> */
    use SdkModel;

    /**
     * A specific date in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format to use as the effective date when submitting this transfer.
     */
    #[Required]
    public ?string $date;

    /**
     * A schedule by which Increase will choose an effective date for the transfer.
     *
     * @var value-of<SettlementSchedule>|null $settlementSchedule
     */
    #[Required('settlement_schedule', enum: SettlementSchedule::class)]
    public ?string $settlementSchedule;

    /**
     * `new PreferredEffectiveDate()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferredEffectiveDate::with(date: ..., settlementSchedule: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferredEffectiveDate)->withDate(...)->withSettlementSchedule(...)
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
     * @param SettlementSchedule|value-of<SettlementSchedule>|null $settlementSchedule
     */
    public static function with(
        ?string $date,
        SettlementSchedule|string|null $settlementSchedule
    ): self {
        $self = new self;

        $self['date'] = $date;
        $self['settlementSchedule'] = $settlementSchedule;

        return $self;
    }

    /**
     * A specific date in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format to use as the effective date when submitting this transfer.
     */
    public function withDate(?string $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }

    /**
     * A schedule by which Increase will choose an effective date for the transfer.
     *
     * @param SettlementSchedule|value-of<SettlementSchedule>|null $settlementSchedule
     */
    public function withSettlementSchedule(
        SettlementSchedule|string|null $settlementSchedule
    ): self {
        $self = clone $this;
        $self['settlementSchedule'] = $settlementSchedule;

        return $self;
    }
}
