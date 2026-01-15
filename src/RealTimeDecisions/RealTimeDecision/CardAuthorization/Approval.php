<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Present if and only if `decision` is `approve`. Contains information related to the approval of the authorization.
 *
 * @phpstan-type ApprovalShape = array{partialAmount: int|null}
 */
final class Approval implements BaseModel
{
    /** @use SdkModel<ApprovalShape> */
    use SdkModel;

    /**
     * If the authorization was partially approved, this field contains the approved amount in the minor unit of the settlement currency.
     */
    #[Required('partial_amount')]
    public ?int $partialAmount;

    /**
     * `new Approval()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Approval::with(partialAmount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Approval)->withPartialAmount(...)
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
    public static function with(?int $partialAmount): self
    {
        $self = new self;

        $self['partialAmount'] = $partialAmount;

        return $self;
    }

    /**
     * If the authorization was partially approved, this field contains the approved amount in the minor unit of the settlement currency.
     */
    public function withPartialAmount(?int $partialAmount): self
    {
        $self = clone $this;
        $self['partialAmount'] = $partialAmount;

        return $self;
    }
}
