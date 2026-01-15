<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardBalanceInquiry;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If your application approves the balance inquiry, this contains metadata about your decision to approve.
 *
 * @phpstan-type ApprovalShape = array{balance: int}
 */
final class Approval implements BaseModel
{
    /** @use SdkModel<ApprovalShape> */
    use SdkModel;

    /**
     * The balance on the card in the settlement currency of the transaction.
     */
    #[Required]
    public int $balance;

    /**
     * `new Approval()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Approval::with(balance: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Approval)->withBalance(...)
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
    public static function with(int $balance): self
    {
        $self = new self;

        $self['balance'] = $balance;

        return $self;
    }

    /**
     * The balance on the card in the settlement currency of the transaction.
     */
    public function withBalance(int $balance): self
    {
        $self = clone $this;
        $self['balance'] = $balance;

        return $self;
    }
}
