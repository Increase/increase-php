<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Swift Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `swift_transfer_intention`. A Swift Transfer initiated via Increase.
 *
 * @phpstan-type SwiftTransferIntentionShape = array{transferID: string}
 */
final class SwiftTransferIntention implements BaseModel
{
    /** @use SdkModel<SwiftTransferIntentionShape> */
    use SdkModel;

    /**
     * The identifier of the Swift Transfer that led to this Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new SwiftTransferIntention()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SwiftTransferIntention::with(transferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SwiftTransferIntention)->withTransferID(...)
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
     * The identifier of the Swift Transfer that led to this Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}
