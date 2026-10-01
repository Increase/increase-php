<?php

declare(strict_types=1);

namespace Increase\Simulations\FednowTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\FednowTransfers\FednowTransferCompleteParams\Rejection;

/**
 * Simulates submission of a [FedNow Transfer](#fednow-transfers) and handling the response from the destination financial institution. This transfer must first have a `status` of `pending_submitting`.
 *
 * @see Increase\Services\Simulations\FednowTransfersService::complete()
 *
 * @phpstan-import-type RejectionShape from \Increase\Simulations\FednowTransfers\FednowTransferCompleteParams\Rejection
 *
 * @phpstan-type FednowTransferCompleteParamsShape = array{
 *   rejection?: null|Rejection|RejectionShape
 * }
 */
final class FednowTransferCompleteParams implements BaseModel
{
    /** @use SdkModel<FednowTransferCompleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * If set, the simulation will reject the transfer.
     */
    #[Optional]
    public ?Rejection $rejection;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Rejection|RejectionShape|null $rejection
     */
    public static function with(Rejection|array|null $rejection = null): self
    {
        $self = new self;

        null !== $rejection && $self['rejection'] = $rejection;

        return $self;
    }

    /**
     * If set, the simulation will reject the transfer.
     *
     * @param Rejection|RejectionShape $rejection
     */
    public function withRejection(Rejection|array $rejection): self
    {
        $self = clone $this;
        $self['rejection'] = $rejection;

        return $self;
    }
}
