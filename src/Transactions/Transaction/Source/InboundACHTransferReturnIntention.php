<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * An Inbound ACH Transfer Return Intention object. This field will be present in the JSON response if and only if `category` is equal to `inbound_ach_transfer_return_intention`. An Inbound ACH Transfer Return Intention is created when an ACH transfer is initiated at another bank and returned by Increase.
 *
 * @phpstan-type InboundACHTransferReturnIntentionShape = array{
 *   inboundACHTransferID: string
 * }
 */
final class InboundACHTransferReturnIntention implements BaseModel
{
    /** @use SdkModel<InboundACHTransferReturnIntentionShape> */
    use SdkModel;

    /**
     * The ID of the Inbound ACH Transfer that is being returned.
     */
    #[Required('inbound_ach_transfer_id')]
    public string $inboundACHTransferID;

    /**
     * `new InboundACHTransferReturnIntention()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundACHTransferReturnIntention::with(inboundACHTransferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundACHTransferReturnIntention)->withInboundACHTransferID(...)
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
    public static function with(string $inboundACHTransferID): self
    {
        $self = new self;

        $self['inboundACHTransferID'] = $inboundACHTransferID;

        return $self;
    }

    /**
     * The ID of the Inbound ACH Transfer that is being returned.
     */
    public function withInboundACHTransferID(string $inboundACHTransferID): self
    {
        $self = clone $this;
        $self['inboundACHTransferID'] = $inboundACHTransferID;

        return $self;
    }
}
