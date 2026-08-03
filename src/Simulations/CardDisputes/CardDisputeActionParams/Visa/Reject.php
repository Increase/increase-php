<?php

declare(strict_types=1);

namespace Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The parameters for rejecting the dispute. Required if and only if `action` is `reject`.
 *
 * @phpstan-type RejectShape = array{explanation: string}
 */
final class Reject implements BaseModel
{
    /** @use SdkModel<RejectShape> */
    use SdkModel;

    /**
     * The explanation for rejecting the dispute.
     */
    #[Required]
    public string $explanation;

    /**
     * `new Reject()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Reject::with(explanation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Reject)->withExplanation(...)
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
    public static function with(string $explanation): self
    {
        $self = new self;

        $self['explanation'] = $explanation;

        return $self;
    }

    /**
     * The explanation for rejecting the dispute.
     */
    public function withExplanation(string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }
}
