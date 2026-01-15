<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Prior undisputed non-fraud transactions details. Present if and only if `reason` is `prior_undisputed_non_fraud_transactions`.
 *
 * @phpstan-type PriorUndisputedNonFraudTransactionsShape = array{
 *   explanation: string|null
 * }
 */
final class PriorUndisputedNonFraudTransactions implements BaseModel
{
    /** @use SdkModel<PriorUndisputedNonFraudTransactionsShape> */
    use SdkModel;

    /**
     * Explanation of the prior undisputed non-fraud transactions provided by the merchant.
     */
    #[Required]
    public ?string $explanation;

    /**
     * `new PriorUndisputedNonFraudTransactions()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PriorUndisputedNonFraudTransactions::with(explanation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PriorUndisputedNonFraudTransactions)->withExplanation(...)
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
     * Explanation of the prior undisputed non-fraud transactions provided by the merchant.
     */
    public function withExplanation(?string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }
}
