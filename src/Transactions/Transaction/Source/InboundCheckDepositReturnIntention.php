<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * An Inbound Check Deposit Return Intention object. This field will be present in the JSON response if and only if `category` is equal to `inbound_check_deposit_return_intention`. An Inbound Check Deposit Return Intention is created when Increase receives an Inbound Check and the User requests that it be returned.
 *
 * @phpstan-type InboundCheckDepositReturnIntentionShape = array{
 *   inboundCheckDepositID: string, transferID: string|null
 * }
 */
final class InboundCheckDepositReturnIntention implements BaseModel
{
    /** @use SdkModel<InboundCheckDepositReturnIntentionShape> */
    use SdkModel;

    /**
     * The ID of the Inbound Check Deposit that is being returned.
     */
    #[Required('inbound_check_deposit_id')]
    public string $inboundCheckDepositID;

    /**
     * The identifier of the Check Transfer object that was deposited.
     */
    #[Required('transfer_id')]
    public ?string $transferID;

    /**
     * `new InboundCheckDepositReturnIntention()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundCheckDepositReturnIntention::with(
     *   inboundCheckDepositID: ..., transferID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundCheckDepositReturnIntention)
     *   ->withInboundCheckDepositID(...)
     *   ->withTransferID(...)
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
    public static function with(
        string $inboundCheckDepositID,
        ?string $transferID
    ): self {
        $self = new self;

        $self['inboundCheckDepositID'] = $inboundCheckDepositID;
        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * The ID of the Inbound Check Deposit that is being returned.
     */
    public function withInboundCheckDepositID(
        string $inboundCheckDepositID
    ): self {
        $self = clone $this;
        $self['inboundCheckDepositID'] = $inboundCheckDepositID;

        return $self;
    }

    /**
     * The identifier of the Check Transfer object that was deposited.
     */
    public function withTransferID(?string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}
