<?php

declare(strict_types=1);

namespace Increase\Simulations\CheckDeposits\CheckDepositSubmitParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If set, the simulation will use these values for the check's scanned MICR data. If not set, the simulation will use random values.
 *
 * @phpstan-type ScanShape = array{
 *   accountNumber: string,
 *   routingNumber: string,
 *   auxiliaryOnUs?: string|null,
 *   serialNumber?: string|null,
 * }
 */
final class Scan implements BaseModel
{
    /** @use SdkModel<ScanShape> */
    use SdkModel;

    /**
     * The account number to be returned in the check deposit's scan data.
     */
    #[Required('account_number')]
    public string $accountNumber;

    /**
     * The routing number to be returned in the check deposit's scan data.
     */
    #[Required('routing_number')]
    public string $routingNumber;

    /**
     * The auxiliary on-us data to be returned in the check deposit's scan data. Auxiliary on-us is typically the check number for business checks.
     */
    #[Optional('auxiliary_on_us')]
    public ?string $auxiliaryOnUs;

    /**
     * The serial number to be returned in the check deposit's scan data. Serial number is typically the check number for consumer checks.
     */
    #[Optional('serial_number')]
    public ?string $serialNumber;

    /**
     * `new Scan()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Scan::with(accountNumber: ..., routingNumber: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Scan)->withAccountNumber(...)->withRoutingNumber(...)
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
        string $accountNumber,
        string $routingNumber,
        ?string $auxiliaryOnUs = null,
        ?string $serialNumber = null,
    ): self {
        $self = new self;

        $self['accountNumber'] = $accountNumber;
        $self['routingNumber'] = $routingNumber;

        null !== $auxiliaryOnUs && $self['auxiliaryOnUs'] = $auxiliaryOnUs;
        null !== $serialNumber && $self['serialNumber'] = $serialNumber;

        return $self;
    }

    /**
     * The account number to be returned in the check deposit's scan data.
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

        return $self;
    }

    /**
     * The routing number to be returned in the check deposit's scan data.
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }

    /**
     * The auxiliary on-us data to be returned in the check deposit's scan data. Auxiliary on-us is typically the check number for business checks.
     */
    public function withAuxiliaryOnUs(string $auxiliaryOnUs): self
    {
        $self = clone $this;
        $self['auxiliaryOnUs'] = $auxiliaryOnUs;

        return $self;
    }

    /**
     * The serial number to be returned in the check deposit's scan data. Serial number is typically the check number for consumer checks.
     */
    public function withSerialNumber(string $serialNumber): self
    {
        $self = clone $this;
        $self['serialNumber'] = $serialNumber;

        return $self;
    }
}
