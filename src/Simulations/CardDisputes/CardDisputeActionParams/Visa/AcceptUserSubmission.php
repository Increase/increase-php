<?php

declare(strict_types=1);

namespace Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The parameters for accepting the user submission. Required if and only if `action` is `accept_user_submission`.
 *
 * @phpstan-type AcceptUserSubmissionShape = array<string,mixed>
 */
final class AcceptUserSubmission implements BaseModel
{
    /** @use SdkModel<AcceptUserSubmissionShape> */
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
