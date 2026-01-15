<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerServicesNotReceived;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * No cancellation. Required if and only if `cancellation_outcome` is `no_cancellation`.
 *
 * @phpstan-type NoCancellationShape = array<string,mixed>
 */
final class NoCancellation implements BaseModel
{
    /** @use SdkModel<NoCancellationShape> */
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
