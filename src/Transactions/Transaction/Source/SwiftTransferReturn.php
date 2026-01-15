<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Swift Transfer Return object. This field will be present in the JSON response if and only if `category` is equal to `swift_transfer_return`. A Swift Transfer Return is created when a Swift Transfer is returned by the receiving bank.
 *
 * @phpstan-type SwiftTransferReturnShape = array{transferID: string}
 */
final class SwiftTransferReturn implements BaseModel
{
    /** @use SdkModel<SwiftTransferReturnShape> */
    use SdkModel;

    /**
     * The identifier of the Swift Transfer that led to this Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new SwiftTransferReturn()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SwiftTransferReturn::with(transferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SwiftTransferReturn)->withTransferID(...)
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
