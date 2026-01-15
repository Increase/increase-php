<?php

declare(strict_types=1);

namespace Increase\ACHPrenotifications\ACHPrenotification;

use Increase\ACHPrenotifications\ACHPrenotification\PrenotificationReturn\ReturnReasonCode;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If your prenotification is returned, this will contain details of the return.
 *
 * @phpstan-type PrenotificationReturnShape = array{
 *   createdAt: \DateTimeInterface,
 *   returnReasonCode: ReturnReasonCode|value-of<ReturnReasonCode>,
 * }
 */
final class PrenotificationReturn implements BaseModel
{
    /** @use SdkModel<PrenotificationReturnShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Prenotification was returned.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Why the Prenotification was returned.
     *
     * @var value-of<ReturnReasonCode> $returnReasonCode
     */
    #[Required('return_reason_code', enum: ReturnReasonCode::class)]
    public string $returnReasonCode;

    /**
     * `new PrenotificationReturn()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PrenotificationReturn::with(createdAt: ..., returnReasonCode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PrenotificationReturn)->withCreatedAt(...)->withReturnReasonCode(...)
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
     * @param ReturnReasonCode|value-of<ReturnReasonCode> $returnReasonCode
     */
    public static function with(
        \DateTimeInterface $createdAt,
        ReturnReasonCode|string $returnReasonCode
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['returnReasonCode'] = $returnReasonCode;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Prenotification was returned.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Why the Prenotification was returned.
     *
     * @param ReturnReasonCode|value-of<ReturnReasonCode> $returnReasonCode
     */
    public function withReturnReasonCode(
        ReturnReasonCode|string $returnReasonCode
    ): self {
        $self = clone $this;
        $self['returnReasonCode'] = $returnReasonCode;

        return $self;
    }
}
