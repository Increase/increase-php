<?php

declare(strict_types=1);

namespace Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The parameters for requesting further information from the user. Required if and only if `action` is `request_further_information`.
 *
 * @phpstan-type RequestFurtherInformationShape = array{reason: string}
 */
final class RequestFurtherInformation implements BaseModel
{
    /** @use SdkModel<RequestFurtherInformationShape> */
    use SdkModel;

    /**
     * The reason for requesting further information from the user.
     */
    #[Required]
    public string $reason;

    /**
     * `new RequestFurtherInformation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RequestFurtherInformation::with(reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RequestFurtherInformation)->withReason(...)
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
    public static function with(string $reason): self
    {
        $self = new self;

        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The reason for requesting further information from the user.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
