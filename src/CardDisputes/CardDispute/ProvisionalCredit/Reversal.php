<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\ProvisionalCredit;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If the provisional credit has been reversed, this will contain details of the reversal.
 *
 * @phpstan-type ReversalShape = array{
 *   amount: int,
 *   cardholderAccountTransactionID: string,
 *   provisionalCreditFundingAccountTransactionID: string,
 *   reversedAt: \DateTimeInterface,
 * }
 */
final class Reversal implements BaseModel
{
    /** @use SdkModel<ReversalShape> */
    use SdkModel;

    /**
     * The amount of the reversal in the minor unit of its currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * The identifier of the Transaction that debited the cardholder's Account.
     */
    #[Required('cardholder_account_transaction_id')]
    public string $cardholderAccountTransactionID;

    /**
     * The identifier of the Transaction that credited the provisional credit funding Account.
     */
    #[Required('provisional_credit_funding_account_transaction_id')]
    public string $provisionalCreditFundingAccountTransactionID;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the provisional credit was reversed.
     */
    #[Required('reversed_at')]
    public \DateTimeInterface $reversedAt;

    /**
     * `new Reversal()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Reversal::with(
     *   amount: ...,
     *   cardholderAccountTransactionID: ...,
     *   provisionalCreditFundingAccountTransactionID: ...,
     *   reversedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Reversal)
     *   ->withAmount(...)
     *   ->withCardholderAccountTransactionID(...)
     *   ->withProvisionalCreditFundingAccountTransactionID(...)
     *   ->withReversedAt(...)
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
        int $amount,
        string $cardholderAccountTransactionID,
        string $provisionalCreditFundingAccountTransactionID,
        \DateTimeInterface $reversedAt,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['cardholderAccountTransactionID'] = $cardholderAccountTransactionID;
        $self['provisionalCreditFundingAccountTransactionID'] = $provisionalCreditFundingAccountTransactionID;
        $self['reversedAt'] = $reversedAt;

        return $self;
    }

    /**
     * The amount of the reversal in the minor unit of its currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier of the Transaction that debited the cardholder's Account.
     */
    public function withCardholderAccountTransactionID(
        string $cardholderAccountTransactionID
    ): self {
        $self = clone $this;
        $self['cardholderAccountTransactionID'] = $cardholderAccountTransactionID;

        return $self;
    }

    /**
     * The identifier of the Transaction that credited the provisional credit funding Account.
     */
    public function withProvisionalCreditFundingAccountTransactionID(
        string $provisionalCreditFundingAccountTransactionID
    ): self {
        $self = clone $this;
        $self['provisionalCreditFundingAccountTransactionID'] = $provisionalCreditFundingAccountTransactionID;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the provisional credit was reversed.
     */
    public function withReversedAt(\DateTimeInterface $reversedAt): self
    {
        $self = clone $this;
        $self['reversedAt'] = $reversedAt;

        return $self;
    }
}
