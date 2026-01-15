<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * After the transfer is acknowledged by FedACH, this will contain supplemental details. The Federal Reserve sends an acknowledgement message for each file that Increase submits.
 *
 * @phpstan-type AcknowledgementShape = array{acknowledgedAt: string}
 */
final class Acknowledgement implements BaseModel
{
    /** @use SdkModel<AcknowledgementShape> */
    use SdkModel;

    /**
     * When the Federal Reserve acknowledged the submitted file containing this transfer.
     */
    #[Required('acknowledged_at')]
    public string $acknowledgedAt;

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
    public static function with(string $acknowledgedAt): self
    {
        $self = new self;

        $self['acknowledgedAt'] = $acknowledgedAt;

        return $self;
    }

    /**
     * When the Federal Reserve acknowledged the submitted file containing this transfer.
     */
    public function withAcknowledgedAt(string $acknowledgedAt): self
    {
        $self = clone $this;
        $self['acknowledgedAt'] = $acknowledgedAt;

        return $self;
    }
}
