<?php

declare(strict_types=1);

namespace Increase\AccountNumbers;

use Increase\AccountNumbers\AccountNumberUpdateParams\InboundACH;
use Increase\AccountNumbers\AccountNumberUpdateParams\InboundChecks;
use Increase\AccountNumbers\AccountNumberUpdateParams\Status;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Update an Account Number.
 *
 * @see Increase\Services\AccountNumbersService::update()
 *
 * @phpstan-import-type InboundACHShape from \Increase\AccountNumbers\AccountNumberUpdateParams\InboundACH
 * @phpstan-import-type InboundChecksShape from \Increase\AccountNumbers\AccountNumberUpdateParams\InboundChecks
 *
 * @phpstan-type AccountNumberUpdateParamsShape = array{
 *   inboundACH?: null|InboundACH|InboundACHShape,
 *   inboundChecks?: null|InboundChecks|InboundChecksShape,
 *   name?: string|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class AccountNumberUpdateParams implements BaseModel
{
    /** @use SdkModel<AccountNumberUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Options related to how this Account Number handles inbound ACH transfers.
     */
    #[Optional('inbound_ach')]
    public ?InboundACH $inboundACH;

    /**
     * Options related to how this Account Number should handle inbound check withdrawals.
     */
    #[Optional('inbound_checks')]
    public ?InboundChecks $inboundChecks;

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
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        InboundACH|array|null $inboundACH = null,
        InboundChecks|array|null $inboundChecks = null,
        ?string $name = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $inboundACH && $self['inboundACH'] = $inboundACH;
        null !== $inboundChecks && $self['inboundChecks'] = $inboundChecks;
        null !== $name && $self['name'] = $name;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Options related to how this Account Number handles inbound ACH transfers.
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
}
