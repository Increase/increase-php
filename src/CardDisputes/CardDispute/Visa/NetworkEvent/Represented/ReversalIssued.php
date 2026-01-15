<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Reversal issued by merchant details. Present if and only if `reason` is `reversal_issued`.
 *
 * @phpstan-type ReversalIssuedShape = array{explanation: string|null}
 */
final class ReversalIssued implements BaseModel
{
    /** @use SdkModel<ReversalIssuedShape> */
    use SdkModel;

    /**
     * Explanation of the reversal issued by the merchant.
     */
    #[Required]
    public ?string $explanation;

    /**
     * `new ReversalIssued()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReversalIssued::with(explanation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReversalIssued)->withExplanation(...)
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
    public static function with(?string $explanation): self
    {
        $self = new self;

        $self['explanation'] = $explanation;

        return $self;
    }

    /**
     * Explanation of the reversal issued by the merchant.
     */
    public function withExplanation(?string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }
}
