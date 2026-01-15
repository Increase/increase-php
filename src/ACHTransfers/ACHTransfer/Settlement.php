<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A subhash containing information about when and how the transfer settled at the Federal Reserve.
 *
 * @phpstan-type SettlementShape = array{settledAt: \DateTimeInterface}
 */
final class Settlement implements BaseModel
{
    /** @use SdkModel<SettlementShape> */
    use SdkModel;

    /**
     * When the funds for this transfer have settled at the destination bank at the Federal Reserve.
     */
    #[Required('settled_at')]
    public \DateTimeInterface $settledAt;

    /**
     * `new Settlement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Settlement::with(settledAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Settlement)->withSettledAt(...)
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
    public static function with(\DateTimeInterface $settledAt): self
    {
        $self = new self;

        $self['settledAt'] = $settledAt;

        return $self;
    }

    /**
     * When the funds for this transfer have settled at the destination bank at the Federal Reserve.
     */
    public function withSettledAt(\DateTimeInterface $settledAt): self
    {
        $self = clone $this;
        $self['settledAt'] = $settledAt;

        return $self;
    }
}
