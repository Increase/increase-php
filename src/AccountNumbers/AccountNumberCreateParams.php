<?php

declare(strict_types=1);

namespace Increase\AccountNumbers;

use Increase\AccountNumbers\AccountNumberCreateParams\InboundACHDebits;
use Increase\AccountNumbers\AccountNumberCreateParams\UnregisteredInboundChecks;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create an Account Number.
 *
 * @see Increase\Services\AccountNumbersService::create()
 *
 * @phpstan-type AccountNumberCreateParamsShape = array{
 *   accountID: string,
 *   name: string,
 *   inboundACHDebits?: null|InboundACHDebits|value-of<InboundACHDebits>,
 *   unregisteredInboundChecks?: null|UnregisteredInboundChecks|value-of<UnregisteredInboundChecks>,
 * }
 */
final class AccountNumberCreateParams implements BaseModel
{
    /** @use SdkModel<AccountNumberCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The Account the Account Number should belong to.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The name you choose for the Account Number.
     */
    #[Required]
    public string $name;

    /**
     * Whether inbound ACH debits are allowed against this Account Number. Note that ACH debits will be declined if this is `allowed` but the Account Number is not active. If you do not specify this field, the default is `allowed`.
     *
     * @var value-of<InboundACHDebits>|null $inboundACHDebits
     */
    #[Optional('inbound_ach_debits', enum: InboundACHDebits::class)]
    public ?string $inboundACHDebits;

    /**
     * Whether unregistered inbound checks for this Account Number can be deposited. If you do not specify this field, the default is `blocked`.
     *
     * @var value-of<UnregisteredInboundChecks>|null $unregisteredInboundChecks
     */
    #[Optional(
        'unregistered_inbound_checks',
        enum: UnregisteredInboundChecks::class
    )]
    public ?string $unregisteredInboundChecks;

    /**
     * `new AccountNumberCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountNumberCreateParams::with(accountID: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountNumberCreateParams)->withAccountID(...)->withName(...)
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
     * @param InboundACHDebits|value-of<InboundACHDebits>|null $inboundACHDebits
     * @param UnregisteredInboundChecks|value-of<UnregisteredInboundChecks>|null $unregisteredInboundChecks
     */
    public static function with(
        string $accountID,
        string $name,
        InboundACHDebits|string|null $inboundACHDebits = null,
        UnregisteredInboundChecks|string|null $unregisteredInboundChecks = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['name'] = $name;

        null !== $inboundACHDebits && $self['inboundACHDebits'] = $inboundACHDebits;
        null !== $unregisteredInboundChecks && $self['unregisteredInboundChecks'] = $unregisteredInboundChecks;

        return $self;
    }

    /**
     * The Account the Account Number should belong to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

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
     * Whether inbound ACH debits are allowed against this Account Number. Note that ACH debits will be declined if this is `allowed` but the Account Number is not active. If you do not specify this field, the default is `allowed`.
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
     * Whether unregistered inbound checks for this Account Number can be deposited. If you do not specify this field, the default is `blocked`.
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
