<?php

declare(strict_types=1);

namespace Increase\Simulations\CheckDeposits;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\CheckDeposits\CheckDepositSubmitParams\Scan;

/**
 * Simulates the submission of a [Check Deposit](#check-deposits) to the Federal Reserve. This Check Deposit must first have a `status` of `pending`.
 *
 * @see Increase\Services\Simulations\CheckDepositsService::submit()
 *
 * @phpstan-import-type ScanShape from \Increase\Simulations\CheckDeposits\CheckDepositSubmitParams\Scan
 *
 * @phpstan-type CheckDepositSubmitParamsShape = array{scan?: null|Scan|ScanShape}
 */
final class CheckDepositSubmitParams implements BaseModel
{
    /** @use SdkModel<CheckDepositSubmitParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * If set, the simulation will use these values for the check's scanned MICR data.
     */
    #[Optional]
    public ?Scan $scan;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Scan|ScanShape|null $scan
     */
    public static function with(Scan|array|null $scan = null): self
    {
        $self = new self;

        null !== $scan && $self['scan'] = $scan;

        return $self;
    }

    /**
     * If set, the simulation will use these values for the check's scanned MICR data.
     *
     * @param Scan|ScanShape $scan
     */
    public function withScan(Scan|array $scan): self
    {
        $self = clone $this;
        $self['scan'] = $scan;

        return $self;
    }
}
