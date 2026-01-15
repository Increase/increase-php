<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Proof of cash disbursement details. Present if and only if `reason` is `proof_of_cash_disbursement`.
 *
 * @phpstan-type ProofOfCashDisbursementShape = array{explanation: string|null}
 */
final class ProofOfCashDisbursement implements BaseModel
{
    /** @use SdkModel<ProofOfCashDisbursementShape> */
    use SdkModel;

    /**
     * Explanation for why the merchant believes the evidence provides proof of cash disbursement.
     */
    #[Required]
    public ?string $explanation;

    /**
     * `new ProofOfCashDisbursement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProofOfCashDisbursement::with(explanation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProofOfCashDisbursement)->withExplanation(...)
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
     * Explanation for why the merchant believes the evidence provides proof of cash disbursement.
     */
    public function withExplanation(?string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }
}
