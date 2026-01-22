<?php

declare(strict_types=1);

namespace Increase\Simulations\InboundCheckDeposits;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\InboundCheckDeposits\InboundCheckDepositCreateParams\PayeeNameAnalysis;

/**
 * Simulates an Inbound Check Deposit against your account. This imitates someone depositing a check at their bank that was issued from your account. It may or may not be associated with a Check Transfer. Increase will evaluate the Inbound Check Deposit as we would in production and either create a Transaction or a Declined Transaction as a result. You can inspect the resulting Inbound Check Deposit object to see the result.
 *
 * @see Increase\Services\Simulations\InboundCheckDepositsService::create()
 *
 * @phpstan-type InboundCheckDepositCreateParamsShape = array{
 *   accountNumberID: string,
 *   amount: int,
 *   checkNumber: string,
 *   payeeNameAnalysis?: null|PayeeNameAnalysis|value-of<PayeeNameAnalysis>,
 * }
 */
final class InboundCheckDepositCreateParams implements BaseModel
{
    /** @use SdkModel<InboundCheckDepositCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Account Number the Inbound Check Deposit will be against.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * The check amount in cents.
     */
    #[Required]
    public int $amount;

    /**
     * The check number on the check to be deposited.
     */
    #[Required('check_number')]
    public string $checkNumber;

    /**
     * Simulate the outcome of [payee name checking](https://increase.com/documentation/positive-pay#payee-name-mismatches). Defaults to `not_evaluated`.
     *
     * @var value-of<PayeeNameAnalysis>|null $payeeNameAnalysis
     */
    #[Optional('payee_name_analysis', enum: PayeeNameAnalysis::class)]
    public ?string $payeeNameAnalysis;

    /**
     * `new InboundCheckDepositCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundCheckDepositCreateParams::with(
     *   accountNumberID: ..., amount: ..., checkNumber: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundCheckDepositCreateParams)
     *   ->withAccountNumberID(...)
     *   ->withAmount(...)
     *   ->withCheckNumber(...)
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
     *
     * @param PayeeNameAnalysis|value-of<PayeeNameAnalysis>|null $payeeNameAnalysis
     */
    public static function with(
        string $accountNumberID,
        int $amount,
        string $checkNumber,
        PayeeNameAnalysis|string|null $payeeNameAnalysis = null,
    ): self {
        $self = new self;

        $self['accountNumberID'] = $accountNumberID;
        $self['amount'] = $amount;
        $self['checkNumber'] = $checkNumber;

        null !== $payeeNameAnalysis && $self['payeeNameAnalysis'] = $payeeNameAnalysis;

        return $self;
    }

    /**
     * The identifier of the Account Number the Inbound Check Deposit will be against.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * The check amount in cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The check number on the check to be deposited.
     */
    public function withCheckNumber(string $checkNumber): self
    {
        $self = clone $this;
        $self['checkNumber'] = $checkNumber;

        return $self;
    }

    /**
     * Simulate the outcome of [payee name checking](https://increase.com/documentation/positive-pay#payee-name-mismatches). Defaults to `not_evaluated`.
     *
     * @param PayeeNameAnalysis|value-of<PayeeNameAnalysis> $payeeNameAnalysis
     */
    public function withPayeeNameAnalysis(
        PayeeNameAnalysis|string $payeeNameAnalysis
    ): self {
        $self = clone $this;
        $self['payeeNameAnalysis'] = $payeeNameAnalysis;

        return $self;
    }
}
