<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumberCreateParams;

use Increase\AccountNumbers\AccountNumberCreateParams\InboundChecks\Status;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Options related to how this Account Number should handle inbound check withdrawals.
 *
 * @phpstan-type InboundChecksShape = array{status: Status|value-of<Status>}
 */
final class InboundChecks implements BaseModel
{
    /** @use SdkModel<InboundChecksShape> */
    use SdkModel;

    /**
     * How Increase should process checks with this account number printed on them. If you do not specify this field, the default is `check_transfers_only`.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * `new InboundChecks()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundChecks::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundChecks)->withStatus(...)
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
     * @param Status|value-of<Status> $status
     */
    public static function with(Status|string $status): self
    {
        $self = new self;

        $self['status'] = $status;

        return $self;
    }

    /**
     * How Increase should process checks with this account number printed on them. If you do not specify this field, the default is `check_transfers_only`.
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
