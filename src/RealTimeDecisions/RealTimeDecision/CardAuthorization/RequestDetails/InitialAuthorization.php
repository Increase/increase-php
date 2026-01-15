<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\RequestDetails;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Fields specific to the category `initial_authorization`.
 *
 * @phpstan-type InitialAuthorizationShape = array<string,mixed>
 */
final class InitialAuthorization implements BaseModel
{
    /** @use SdkModel<InitialAuthorizationShape> */
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
