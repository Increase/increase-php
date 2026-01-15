<?php

declare(strict_types=1);

namespace Increase\AccountNumbers;

use Increase\AccountNumbers\AccountNumberCreateParams\InboundACH;
use Increase\AccountNumbers\AccountNumberCreateParams\InboundChecks;
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
 * @phpstan-import-type InboundACHShape from \Increase\AccountNumbers\AccountNumberCreateParams\InboundACH
 * @phpstan-import-type InboundChecksShape from \Increase\AccountNumbers\AccountNumberCreateParams\InboundChecks
 *
 * @phpstan-type AccountNumberCreateParamsShape = array{
 *   accountID: string,
 *   name: string,
 *   inboundACH?: null|InboundACH|InboundACHShape,
 *   inboundChecks?: null|InboundChecks|InboundChecksShape,
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
     * Options related to how this Account Number should handle inbound ACH transfers.
     */
    #[Optional('inbound_ach')]
    public ?InboundACH $inboundACH;

    /**
     * Options related to how this Account Number should handle inbound check withdrawals.
     */
    #[Optional('inbound_checks')]
    public ?InboundChecks $inboundChecks;

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
     * @param InboundACH|InboundACHShape|null $inboundACH
     * @param InboundChecks|InboundChecksShape|null $inboundChecks
     */
    public static function with(
        string $accountID,
        string $name,
        InboundACH|array|null $inboundACH = null,
        InboundChecks|array|null $inboundChecks = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['name'] = $name;

        null !== $inboundACH && $self['inboundACH'] = $inboundACH;
        null !== $inboundChecks && $self['inboundChecks'] = $inboundChecks;

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
     * Options related to how this Account Number should handle inbound ACH transfers.
     *
     * @param InboundACH|InboundACHShape $inboundACH
     */
    public function withInboundACH(InboundACH|array $inboundACH): self
    {
        $self = clone $this;
        $self['inboundACH'] = $inboundACH;

        return $self;
    }

    /**
     * Options related to how this Account Number should handle inbound check withdrawals.
     *
     * @param InboundChecks|InboundChecksShape $inboundChecks
     */
    public function withInboundChecks(InboundChecks|array $inboundChecks): self
    {
        $self = clone $this;
        $self['inboundChecks'] = $inboundChecks;

        return $self;
    }
}
