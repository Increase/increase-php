<?php

declare(strict_types=1);

namespace Increase\Simulations\ACHTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\ACHTransfers\ACHTransferReturnParams\Reason;

/**
 * Simulates the return of an [ACH Transfer](#ach-transfers) by the Federal Reserve due to an error condition. This will also create a Transaction to account for the returned funds. This transfer must first have a `status` of `submitted`.
 *
 * @see Increase\Services\Simulations\ACHTransfersService::return()
 *
 * @phpstan-type ACHTransferReturnParamsShape = array{
 *   reason?: null|Reason|value-of<Reason>
 * }
 */
final class ACHTransferReturnParams implements BaseModel
{
    /** @use SdkModel<ACHTransferReturnParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The reason why the Federal Reserve or destination bank returned this transfer. Defaults to `no_account`.
     *
     * @var value-of<Reason>|null $reason
     */
    #[Optional(enum: Reason::class)]
    public ?string $reason;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Reason|value-of<Reason>|null $reason
     */
    public static function with(Reason|string|null $reason = null): self
    {
        $self = new self;

        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    /**
     * The reason why the Federal Reserve or destination bank returned this transfer. Defaults to `no_account`.
     *
     * @param Reason|value-of<Reason> $reason
     */
    public function withReason(Reason|string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
