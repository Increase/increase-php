<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * An ACH Transfer Rejection object. This field will be present in the JSON response if and only if `category` is equal to `ach_transfer_rejection`. An ACH Transfer Rejection is created when an ACH Transfer is rejected by Increase. It offsets the ACH Transfer Intention. These rejections are rare.
 *
 * @phpstan-type ACHTransferRejectionShape = array{transferID: string}
 */
final class ACHTransferRejection implements BaseModel
{
    /** @use SdkModel<ACHTransferRejectionShape> */
    use SdkModel;

    /**
     * The identifier of the ACH Transfer that led to this Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new ACHTransferRejection()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ACHTransferRejection::with(transferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ACHTransferRejection)->withTransferID(...)
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
    public static function with(string $transferID): self
    {
        $self = new self;

        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * The identifier of the ACH Transfer that led to this Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}
