<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Dispute Re-presentment Timed Out Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `representment_timed_out`. Contains the details specific to a re-presentment time-out Visa Card Dispute Network Event, which represents that the user did not respond to the re-presentment by the merchant within the time limit.
 *
 * @phpstan-type RepresentmentTimedOutShape = array<string,mixed>
 */
final class RepresentmentTimedOut implements BaseModel
{
    /** @use SdkModel<RepresentmentTimedOutShape> */
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
