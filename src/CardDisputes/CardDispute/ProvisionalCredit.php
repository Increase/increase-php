<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute;

use Increase\CardDisputes\CardDispute\ProvisionalCredit\Reversal;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If a provisional credit has been provided for the Card Dispute, this will contain details of the provisional credit.
 *
 * @phpstan-import-type ReversalShape from \Increase\CardDisputes\CardDispute\ProvisionalCredit\Reversal
 *
 * @phpstan-type ProvisionalCreditShape = array{
 *   amount: int,
 *   cardholderAccountTransactionID: string,
 *   providedAt: \DateTimeInterface,
 *   provisionalCreditFundingAccountTransactionID: string,
 *   reversal: null|Reversal|ReversalShape,
 * }
 */
final class ProvisionalCredit implements BaseModel
{
    /** @use SdkModel<ProvisionalCreditShape> */
    use SdkModel;

    /**
     * The amount of the provisional credit in the minor unit of its currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * The identifier of the Transaction that credited the cardholder's Account.
     */
    #[Required('cardholder_account_transaction_id')]
    public string $cardholderAccountTransactionID;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the provisional credit was provided.
     */
    #[Required('provided_at')]
    public \DateTimeInterface $providedAt;

    /**
     * The identifier of the Transaction that debited the provisional credit funding Account.
     */
    #[Required('provisional_credit_funding_account_transaction_id')]
    public string $provisionalCreditFundingAccountTransactionID;

    /**
     * If the provisional credit has been reversed, this will contain details of the reversal.
     */
    #[Required]
    public ?Reversal $reversal;

    /**
     * `new ProvisionalCredit()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProvisionalCredit::with(
     *   amount: ...,
     *   cardholderAccountTransactionID: ...,
     *   providedAt: ...,
     *   provisionalCreditFundingAccountTransactionID: ...,
     *   reversal: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProvisionalCredit)
     *   ->withAmount(...)
     *   ->withCardholderAccountTransactionID(...)
     *   ->withProvidedAt(...)
     *   ->withProvisionalCreditFundingAccountTransactionID(...)
     *   ->withReversal(...)
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
     * @param Reversal|ReversalShape|null $reversal
     */
    public static function with(
        int $amount,
        string $cardholderAccountTransactionID,
        \DateTimeInterface $providedAt,
        string $provisionalCreditFundingAccountTransactionID,
        Reversal|array|null $reversal,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['cardholderAccountTransactionID'] = $cardholderAccountTransactionID;
        $self['providedAt'] = $providedAt;
        $self['provisionalCreditFundingAccountTransactionID'] = $provisionalCreditFundingAccountTransactionID;
        $self['reversal'] = $reversal;

        return $self;
    }

    /**
     * The amount of the provisional credit in the minor unit of its currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier of the Transaction that credited the cardholder's Account.
     */
    public function withCardholderAccountTransactionID(
        string $cardholderAccountTransactionID
    ): self {
        $self = clone $this;
        $self['cardholderAccountTransactionID'] = $cardholderAccountTransactionID;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the provisional credit was provided.
     */
    public function withProvidedAt(\DateTimeInterface $providedAt): self
    {
        $self = clone $this;
        $self['providedAt'] = $providedAt;

        return $self;
    }

    /**
     * The identifier of the Transaction that debited the provisional credit funding Account.
     */
    public function withProvisionalCreditFundingAccountTransactionID(
        string $provisionalCreditFundingAccountTransactionID
    ): self {
        $self = clone $this;
        $self['provisionalCreditFundingAccountTransactionID'] = $provisionalCreditFundingAccountTransactionID;

        return $self;
    }

    /**
     * If the provisional credit has been reversed, this will contain details of the reversal.
     *
     * @param Reversal|ReversalShape|null $reversal
     */
    public function withReversal(Reversal|array|null $reversal): self
    {
        $self = clone $this;
        $self['reversal'] = $reversal;

        return $self;
    }
}
