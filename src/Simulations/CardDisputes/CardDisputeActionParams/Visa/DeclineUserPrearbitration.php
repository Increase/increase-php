<?php

declare(strict_types=1);

namespace Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The parameters for declining the prearbitration. Required if and only if `action` is `decline_user_prearbitration`.
 *
 * @phpstan-type DeclineUserPrearbitrationShape = array<string,mixed>
 */
final class DeclineUserPrearbitration implements BaseModel
{
    /** @use SdkModel<DeclineUserPrearbitrationShape> */
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
