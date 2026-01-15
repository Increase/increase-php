<?php

declare(strict_types=1);

namespace Increase\Simulations\InterestPayments;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Simulates an interest payment to your account. In production, this happens automatically on the first of each month.
 *
 * @see Increase\Services\Simulations\InterestPaymentsService::create()
 *
 * @phpstan-type InterestPaymentCreateParamsShape = array{
 *   accountID: string,
 *   amount: int,
 *   accruedOnAccountID?: string|null,
 *   periodEnd?: \DateTimeInterface|null,
 *   periodStart?: \DateTimeInterface|null,
 * }
 */
final class InterestPaymentCreateParams implements BaseModel
{
    /** @use SdkModel<InterestPaymentCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Account the Interest Payment should be paid to is for.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The interest amount in cents. Must be positive.
     */
    #[Required]
    public int $amount;

    /**
     * The identifier of the Account the Interest accrued on. Defaults to `account_id`.
     */
    #[Optional('accrued_on_account_id')]
    public ?string $accruedOnAccountID;

    /**
     * The end of the interest period. If not provided, defaults to the current time.
     */
    #[Optional('period_end')]
    public ?\DateTimeInterface $periodEnd;

    /**
     * The start of the interest period. If not provided, defaults to the current time.
     */
    #[Optional('period_start')]
    public ?\DateTimeInterface $periodStart;

    /**
     * `new InterestPaymentCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InterestPaymentCreateParams::with(accountID: ..., amount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InterestPaymentCreateParams)->withAccountID(...)->withAmount(...)
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
    public static function with(
        string $accountID,
        int $amount,
        ?string $accruedOnAccountID = null,
        ?\DateTimeInterface $periodEnd = null,
        ?\DateTimeInterface $periodStart = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['amount'] = $amount;

        null !== $accruedOnAccountID && $self['accruedOnAccountID'] = $accruedOnAccountID;
        null !== $periodEnd && $self['periodEnd'] = $periodEnd;
        null !== $periodStart && $self['periodStart'] = $periodStart;

        return $self;
    }

    /**
     * The identifier of the Account the Interest Payment should be paid to is for.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The interest amount in cents. Must be positive.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier of the Account the Interest accrued on. Defaults to `account_id`.
     */
    public function withAccruedOnAccountID(string $accruedOnAccountID): self
    {
        $self = clone $this;
        $self['accruedOnAccountID'] = $accruedOnAccountID;

        return $self;
    }

    /**
     * The end of the interest period. If not provided, defaults to the current time.
     */
    public function withPeriodEnd(\DateTimeInterface $periodEnd): self
    {
        $self = clone $this;
        $self['periodEnd'] = $periodEnd;

        return $self;
    }

    /**
     * The start of the interest period. If not provided, defaults to the current time.
     */
    public function withPeriodStart(\DateTimeInterface $periodStart): self
    {
        $self = clone $this;
        $self['periodStart'] = $periodStart;

        return $self;
    }
}
