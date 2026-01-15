<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Present if and only if `decision` is `approve`. Contains information related to the approval of the balance inquiry.
 *
 * @phpstan-type ApprovalShape = array{balance: int}
 */
final class Approval implements BaseModel
{
    /** @use SdkModel<ApprovalShape> */
    use SdkModel;

    /**
     * If the balance inquiry was approved, this field contains the balance in the minor unit of the settlement currency.
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
     * If the balance inquiry was approved, this field contains the balance in the minor unit of the settlement currency.
     */
    public function withBalance(int $balance): self
    {
        $self = clone $this;
        $self['balance'] = $balance;

        return $self;
    }
}
