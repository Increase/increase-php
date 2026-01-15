<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If the transfer is acknowledged by the recipient bank, this will contain supplemental details.
 *
 * @phpstan-type AcknowledgementShape = array{acknowledgedAt: \DateTimeInterface}
 */
final class Acknowledgement implements BaseModel
{
    /** @use SdkModel<AcknowledgementShape> */
    use SdkModel;

    /**
     * When the transfer was acknowledged.
     */
    #[Required('acknowledged_at')]
    public \DateTimeInterface $acknowledgedAt;

    /**
     * `new Acknowledgement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Acknowledgement::with(acknowledgedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Acknowledgement)->withAcknowledgedAt(...)
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
    public static function with(\DateTimeInterface $acknowledgedAt): self
    {
        $self = new self;

        $self['acknowledgedAt'] = $acknowledgedAt;

        return $self;
    }

    /**
     * When the transfer was acknowledged.
     */
    public function withAcknowledgedAt(\DateTimeInterface $acknowledgedAt): self
    {
        $self = clone $this;
        $self['acknowledgedAt'] = $acknowledgedAt;

        return $self;
    }
}
