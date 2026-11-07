<?php

declare(strict_types=1);

namespace Increase\AccountNumbers;

use Increase\AccountNumbers\AccountNumberUpdateParams\InboundACHDebits;
use Increase\AccountNumbers\AccountNumberUpdateParams\Status;
use Increase\AccountNumbers\AccountNumberUpdateParams\UnregisteredInboundChecks;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Update an Account Number.
 *
 * @see Increase\Services\AccountNumbersService::update()
 *
 * @phpstan-type AccountNumberUpdateParamsShape = array{
 *   inboundACHDebits?: null|InboundACHDebits|value-of<InboundACHDebits>,
 *   name?: string|null,
 *   status?: null|Status|value-of<Status>,
 *   unregisteredInboundChecks?: null|UnregisteredInboundChecks|value-of<UnregisteredInboundChecks>,
 * }
 */
final class AccountNumberUpdateParams implements BaseModel
{
    /** @use SdkModel<AccountNumberUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Whether inbound ACH debits are allowed against this Account Number. Note that ACH debits will be declined if this is `allowed` but the Account Number is not active.
     *
     * @var value-of<InboundACHDebits>|null $inboundACHDebits
     */
    #[Optional('inbound_ach_debits', enum: InboundACHDebits::class)]
    public ?string $inboundACHDebits;

    /**
     * The name you choose for the Account Number.
     */
    #[Optional]
    public ?string $name;

    /**
     * This indicates if transfers can be made to the Account Number.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Whether unregistered inbound checks for this Account Number can be deposited.
     *
     * @var value-of<UnregisteredInboundChecks>|null $unregisteredInboundChecks
     */
    #[Optional(
        'unregistered_inbound_checks',
        enum: UnregisteredInboundChecks::class
    )]
    public ?string $unregisteredInboundChecks;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param InboundACHDebits|value-of<InboundACHDebits>|null $inboundACHDebits
     * @param Status|value-of<Status>|null $status
     * @param UnregisteredInboundChecks|value-of<UnregisteredInboundChecks>|null $unregisteredInboundChecks
     */
    public static function with(
        InboundACHDebits|string|null $inboundACHDebits = null,
        ?string $name = null,
        Status|string|null $status = null,
        UnregisteredInboundChecks|string|null $unregisteredInboundChecks = null,
    ): self {
        $self = new self;

        null !== $inboundACHDebits && $self['inboundACHDebits'] = $inboundACHDebits;
        null !== $name && $self['name'] = $name;
        null !== $status && $self['status'] = $status;
        null !== $unregisteredInboundChecks && $self['unregisteredInboundChecks'] = $unregisteredInboundChecks;

        return $self;
    }

    /**
     * Whether inbound ACH debits are allowed against this Account Number. Note that ACH debits will be declined if this is `allowed` but the Account Number is not active.
     *
     * @param InboundACHDebits|value-of<InboundACHDebits> $inboundACHDebits
     */
    public function withInboundACHDebits(
        InboundACHDebits|string $inboundACHDebits
    ): self {
        $self = clone $this;
        $self['inboundACHDebits'] = $inboundACHDebits;

        return $self;
    }

    /**
     * The name you choose for the Account Number.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * This indicates if transfers can be made to the Account Number.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Whether unregistered inbound checks for this Account Number can be deposited.
     *
     * @param UnregisteredInboundChecks|value-of<UnregisteredInboundChecks> $unregisteredInboundChecks
     */
    public function withUnregisteredInboundChecks(
        UnregisteredInboundChecks|string $unregisteredInboundChecks
    ): self {
        $self = clone $this;
        $self['unregisteredInboundChecks'] = $unregisteredInboundChecks;

        return $self;
    }
}
