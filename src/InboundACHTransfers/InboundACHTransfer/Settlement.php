<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundACHTransfers\InboundACHTransfer\Settlement\SettlementSchedule;

/**
 * A subhash containing information about when and how the transfer settled at the Federal Reserve.
 *
 * @phpstan-type SettlementShape = array{
 *   settledAt: \DateTimeInterface,
 *   settlementSchedule: SettlementSchedule|value-of<SettlementSchedule>,
 * }
 */
final class Settlement implements BaseModel
{
    /** @use SdkModel<SettlementShape> */
    use SdkModel;

    /**
     * When the funds for this transfer settle at the recipient bank at the Federal Reserve.
     */
    #[Required('settled_at')]
    public \DateTimeInterface $settledAt;

    /**
     * The settlement schedule this transfer follows.
     *
     * @var value-of<SettlementSchedule> $settlementSchedule
     */
    #[Required('settlement_schedule', enum: SettlementSchedule::class)]
    public string $settlementSchedule;

    /**
     * `new Settlement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Settlement::with(settledAt: ..., settlementSchedule: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Settlement)->withSettledAt(...)->withSettlementSchedule(...)
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
     * @param SettlementSchedule|value-of<SettlementSchedule> $settlementSchedule
     */
    public static function with(
        \DateTimeInterface $settledAt,
        SettlementSchedule|string $settlementSchedule
    ): self {
        $self = new self;

        $self['settledAt'] = $settledAt;
        $self['settlementSchedule'] = $settlementSchedule;

        return $self;
    }

    /**
     * When the funds for this transfer settle at the recipient bank at the Federal Reserve.
     */
    public function withSettledAt(\DateTimeInterface $settledAt): self
    {
        $self = clone $this;
        $self['settledAt'] = $settledAt;

        return $self;
    }

    /**
     * The settlement schedule this transfer follows.
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
