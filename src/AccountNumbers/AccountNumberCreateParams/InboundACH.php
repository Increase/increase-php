<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumberCreateParams;

use Increase\AccountNumbers\AccountNumberCreateParams\InboundACH\DebitStatus;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Options related to how this Account Number should handle inbound ACH transfers.
 *
 * @phpstan-type InboundACHShape = array{
 *   debitStatus: DebitStatus|value-of<DebitStatus>
 * }
 */
final class InboundACH implements BaseModel
{
    /** @use SdkModel<InboundACHShape> */
    use SdkModel;

    /**
     * Whether ACH debits are allowed against this Account Number. Note that ACH debits will be declined if this is `allowed` but the Account Number is not active. If you do not specify this field, the default is `allowed`.
     *
     * @var value-of<DebitStatus> $debitStatus
     */
    #[Required('debit_status', enum: DebitStatus::class)]
    public string $debitStatus;

    /**
     * `new InboundACH()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundACH::with(debitStatus: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundACH)->withDebitStatus(...)
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
     * @param DebitStatus|value-of<DebitStatus> $debitStatus
     */
    public static function with(DebitStatus|string $debitStatus): self
    {
        $self = new self;

        $self['debitStatus'] = $debitStatus;

        return $self;
    }

    /**
     * Whether ACH debits are allowed against this Account Number. Note that ACH debits will be declined if this is `allowed` but the Account Number is not active. If you do not specify this field, the default is `allowed`.
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
