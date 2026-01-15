<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledServices;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Timeshare explanation. Required if and only if `service_type` is `timeshare`.
 *
 * @phpstan-type TimeshareShape = array<string,mixed>
 */
final class Timeshare implements BaseModel
{
    /** @use SdkModel<TimeshareShape> */
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
