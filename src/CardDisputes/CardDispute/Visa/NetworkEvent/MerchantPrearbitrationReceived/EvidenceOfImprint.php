<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Evidence of imprint details. Present if and only if `reason` is `evidence_of_imprint`.
 *
 * @phpstan-type EvidenceOfImprintShape = array{explanation: string|null}
 */
final class EvidenceOfImprint implements BaseModel
{
    /** @use SdkModel<EvidenceOfImprintShape> */
    use SdkModel;

    /**
     * Explanation of the evidence of imprint.
     */
    #[Required]
    public ?string $explanation;

    /**
     * `new EvidenceOfImprint()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EvidenceOfImprint::with(explanation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EvidenceOfImprint)->withExplanation(...)
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
     * Explanation of the evidence of imprint.
     */
    public function withExplanation(?string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }
}
