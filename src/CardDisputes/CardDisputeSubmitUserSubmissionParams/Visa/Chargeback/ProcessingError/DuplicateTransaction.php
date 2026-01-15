<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ProcessingError;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Duplicate transaction. Required if and only if `error_reason` is `duplicate_transaction`.
 *
 * @phpstan-type DuplicateTransactionShape = array{otherTransactionID: string}
 */
final class DuplicateTransaction implements BaseModel
{
    /** @use SdkModel<DuplicateTransactionShape> */
    use SdkModel;

    /**
     * Other transaction ID.
     */
    #[Required('other_transaction_id')]
    public string $otherTransactionID;

    /**
     * `new DuplicateTransaction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DuplicateTransaction::with(otherTransactionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DuplicateTransaction)->withOtherTransactionID(...)
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
    public static function with(string $otherTransactionID): self
    {
        $self = new self;

        $self['otherTransactionID'] = $otherTransactionID;

        return $self;
    }

    /**
     * Other transaction ID.
     */
    public function withOtherTransactionID(string $otherTransactionID): self
    {
        $self = clone $this;
        $self['otherTransactionID'] = $otherTransactionID;

        return $self;
    }
}
