<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransferCreateParams;

use Increase\ACHTransfers\ACHTransferCreateParams\PreferredEffectiveDate\SettlementSchedule;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Configuration for how the effective date of the transfer will be set. This determines same-day vs future-dated settlement timing. If not set, defaults to a `settlement_schedule` of `same_day`. If set, exactly one of the child attributes must be set.
 *
 * @phpstan-type PreferredEffectiveDateShape = array{
 *   date?: string|null,
 *   settlementSchedule?: null|SettlementSchedule|value-of<SettlementSchedule>,
 * }
 */
final class PreferredEffectiveDate implements BaseModel
{
    /** @use SdkModel<PreferredEffectiveDateShape> */
    use SdkModel;

    /**
     * A specific date in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format to use as the effective date when submitting this transfer.
     */
    #[Optional]
    public ?string $date;

    /**
     * A schedule by which Increase will choose an effective date for the transfer.
     *
     * @var value-of<SettlementSchedule>|null $settlementSchedule
     */
    #[Optional('settlement_schedule', enum: SettlementSchedule::class)]
    public ?string $settlementSchedule;

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
        ?string $date = null,
        SettlementSchedule|string|null $settlementSchedule = null
    ): self {
        $self = new self;

        null !== $date && $self['date'] = $date;
        null !== $settlementSchedule && $self['settlementSchedule'] = $settlementSchedule;

        return $self;
    }

    /**
     * A specific date in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format to use as the effective date when submitting this transfer.
     */
    public function withDate(string $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }

    /**
     * A schedule by which Increase will choose an effective date for the transfer.
     *
     * @param SettlementSchedule|value-of<SettlementSchedule> $settlementSchedule
     */
    public function withSettlementSchedule(
        SettlementSchedule|string $settlementSchedule
    ): self {
        $self = clone $this;
        $self['settlementSchedule'] = $settlementSchedule;

        return $self;
    }
}
