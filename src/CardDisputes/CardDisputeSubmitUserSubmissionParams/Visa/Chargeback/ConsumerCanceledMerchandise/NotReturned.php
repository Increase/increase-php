<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledMerchandise;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Not returned. Required if and only if `return_outcome` is `not_returned`.
 *
 * @phpstan-type NotReturnedShape = array<string,mixed>
 */
final class NotReturned implements BaseModel
{
    /** @use SdkModel<NotReturnedShape> */
    use SdkModel;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }
}
