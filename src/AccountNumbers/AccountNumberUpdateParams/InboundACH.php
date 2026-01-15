<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumberUpdateParams;

use Increase\AccountNumbers\AccountNumberUpdateParams\InboundACH\DebitStatus;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Options related to how this Account Number handles inbound ACH transfers.
 *
 * @phpstan-type InboundACHShape = array{
 *   debitStatus?: null|DebitStatus|value-of<DebitStatus>
 * }
 */
final class InboundACH implements BaseModel
{
    /** @use SdkModel<InboundACHShape> */
    use SdkModel;

    /**
     * Whether ACH debits are allowed against this Account Number. Note that ACH debits will be declined if this is `allowed` but the Account Number is not active.
     *
     * @var value-of<DebitStatus>|null $debitStatus
     */
    #[Optional('debit_status', enum: DebitStatus::class)]
    public ?string $debitStatus;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param DebitStatus|value-of<DebitStatus>|null $debitStatus
     */
    public static function with(DebitStatus|string|null $debitStatus = null): self
    {
        $self = new self;

        null !== $debitStatus && $self['debitStatus'] = $debitStatus;

        return $self;
    }

    /**
     * Whether ACH debits are allowed against this Account Number. Note that ACH debits will be declined if this is `allowed` but the Account Number is not active.
     *
     * @param DebitStatus|value-of<DebitStatus> $debitStatus
     */
    public function withDebitStatus(DebitStatus|string $debitStatus): self
    {
        $self = clone $this;
        $self['debitStatus'] = $debitStatus;

        return $self;
    }
}
