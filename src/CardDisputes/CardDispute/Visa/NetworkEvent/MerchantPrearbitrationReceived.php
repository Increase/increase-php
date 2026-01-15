<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent;

use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\CardholderNoLongerDisputes;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\CompellingEvidence;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\CreditOrReversalProcessed;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\DelayedChargeTransaction;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\EvidenceOfImprint;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\InvalidDispute;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\NonFiatCurrencyOrNonFungibleTokenReceived;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\PriorUndisputedNonFraudTransactions;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\Reason;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Dispute Merchant Pre-Arbitration Received Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `merchant_prearbitration_received`. Contains the details specific to a merchant prearbitration received Visa Card Dispute Network Event, which represents that the merchant has issued a prearbitration request in the user's favor.
 *
 * @phpstan-import-type CardholderNoLongerDisputesShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\CardholderNoLongerDisputes
 * @phpstan-import-type CompellingEvidenceShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\CompellingEvidence
 * @phpstan-import-type CreditOrReversalProcessedShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\CreditOrReversalProcessed
 * @phpstan-import-type DelayedChargeTransactionShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\DelayedChargeTransaction
 * @phpstan-import-type EvidenceOfImprintShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\EvidenceOfImprint
 * @phpstan-import-type InvalidDisputeShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\InvalidDispute
 * @phpstan-import-type NonFiatCurrencyOrNonFungibleTokenReceivedShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\NonFiatCurrencyOrNonFungibleTokenReceived
 * @phpstan-import-type PriorUndisputedNonFraudTransactionsShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\PriorUndisputedNonFraudTransactions
 *
 * @phpstan-type MerchantPrearbitrationReceivedShape = array{
 *   cardholderNoLongerDisputes: null|CardholderNoLongerDisputes|CardholderNoLongerDisputesShape,
 *   compellingEvidence: null|CompellingEvidence|CompellingEvidenceShape,
 *   creditOrReversalProcessed: null|CreditOrReversalProcessed|CreditOrReversalProcessedShape,
 *   delayedChargeTransaction: null|DelayedChargeTransaction|DelayedChargeTransactionShape,
 *   evidenceOfImprint: null|EvidenceOfImprint|EvidenceOfImprintShape,
 *   invalidDispute: null|InvalidDispute|InvalidDisputeShape,
 *   nonFiatCurrencyOrNonFungibleTokenReceived: null|NonFiatCurrencyOrNonFungibleTokenReceived|NonFiatCurrencyOrNonFungibleTokenReceivedShape,
 *   priorUndisputedNonFraudTransactions: null|PriorUndisputedNonFraudTransactions|PriorUndisputedNonFraudTransactionsShape,
 *   reason: Reason|value-of<Reason>,
 * }
 */
final class MerchantPrearbitrationReceived implements BaseModel
{
    /** @use SdkModel<MerchantPrearbitrationReceivedShape> */
    use SdkModel;

    /**
     * Cardholder no longer disputes details. Present if and only if `reason` is `cardholder_no_longer_disputes`.
     */
    #[Required('cardholder_no_longer_disputes')]
    public ?CardholderNoLongerDisputes $cardholderNoLongerDisputes;

    /**
     * Compelling evidence details. Present if and only if `reason` is `compelling_evidence`.
     */
    #[Required('compelling_evidence')]
    public ?CompellingEvidence $compellingEvidence;

    /**
     * Credit or reversal processed details. Present if and only if `reason` is `credit_or_reversal_processed`.
     */
    #[Required('credit_or_reversal_processed')]
    public ?CreditOrReversalProcessed $creditOrReversalProcessed;

    /**
     * Delayed charge transaction details. Present if and only if `reason` is `delayed_charge_transaction`.
     */
    #[Required('delayed_charge_transaction')]
    public ?DelayedChargeTransaction $delayedChargeTransaction;

    /**
     * Evidence of imprint details. Present if and only if `reason` is `evidence_of_imprint`.
     */
    #[Required('evidence_of_imprint')]
    public ?EvidenceOfImprint $evidenceOfImprint;

    /**
     * Invalid dispute details. Present if and only if `reason` is `invalid_dispute`.
     */
    #[Required('invalid_dispute')]
    public ?InvalidDispute $invalidDispute;

    /**
     * Non-fiat currency or non-fungible token received details. Present if and only if `reason` is `non_fiat_currency_or_non_fungible_token_received`.
     */
    #[Required('non_fiat_currency_or_non_fungible_token_received')]
    public ?NonFiatCurrencyOrNonFungibleTokenReceived $nonFiatCurrencyOrNonFungibleTokenReceived;

    /**
     * Prior undisputed non-fraud transactions details. Present if and only if `reason` is `prior_undisputed_non_fraud_transactions`.
     */
    #[Required('prior_undisputed_non_fraud_transactions')]
    public ?PriorUndisputedNonFraudTransactions $priorUndisputedNonFraudTransactions;

    /**
     * The reason the merchant re-presented the dispute.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new MerchantPrearbitrationReceived()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MerchantPrearbitrationReceived::with(
     *   cardholderNoLongerDisputes: ...,
     *   compellingEvidence: ...,
     *   creditOrReversalProcessed: ...,
     *   delayedChargeTransaction: ...,
     *   evidenceOfImprint: ...,
     *   invalidDispute: ...,
     *   nonFiatCurrencyOrNonFungibleTokenReceived: ...,
     *   priorUndisputedNonFraudTransactions: ...,
     *   reason: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MerchantPrearbitrationReceived)
     *   ->withCardholderNoLongerDisputes(...)
     *   ->withCompellingEvidence(...)
     *   ->withCreditOrReversalProcessed(...)
     *   ->withDelayedChargeTransaction(...)
     *   ->withEvidenceOfImprint(...)
     *   ->withInvalidDispute(...)
     *   ->withNonFiatCurrencyOrNonFungibleTokenReceived(...)
     *   ->withPriorUndisputedNonFraudTransactions(...)
     *   ->withReason(...)
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
     * @param CardholderNoLongerDisputes|CardholderNoLongerDisputesShape|null $cardholderNoLongerDisputes
     * @param CompellingEvidence|CompellingEvidenceShape|null $compellingEvidence
     * @param CreditOrReversalProcessed|CreditOrReversalProcessedShape|null $creditOrReversalProcessed
     * @param DelayedChargeTransaction|DelayedChargeTransactionShape|null $delayedChargeTransaction
     * @param EvidenceOfImprint|EvidenceOfImprintShape|null $evidenceOfImprint
     * @param InvalidDispute|InvalidDisputeShape|null $invalidDispute
     * @param NonFiatCurrencyOrNonFungibleTokenReceived|NonFiatCurrencyOrNonFungibleTokenReceivedShape|null $nonFiatCurrencyOrNonFungibleTokenReceived
     * @param PriorUndisputedNonFraudTransactions|PriorUndisputedNonFraudTransactionsShape|null $priorUndisputedNonFraudTransactions
     * @param Reason|value-of<Reason> $reason
     */
    public static function with(
        CardholderNoLongerDisputes|array|null $cardholderNoLongerDisputes,
        CompellingEvidence|array|null $compellingEvidence,
        CreditOrReversalProcessed|array|null $creditOrReversalProcessed,
        DelayedChargeTransaction|array|null $delayedChargeTransaction,
        EvidenceOfImprint|array|null $evidenceOfImprint,
        InvalidDispute|array|null $invalidDispute,
        NonFiatCurrencyOrNonFungibleTokenReceived|array|null $nonFiatCurrencyOrNonFungibleTokenReceived,
        PriorUndisputedNonFraudTransactions|array|null $priorUndisputedNonFraudTransactions,
        Reason|string $reason,
    ): self {
        $self = new self;

        $self['cardholderNoLongerDisputes'] = $cardholderNoLongerDisputes;
        $self['compellingEvidence'] = $compellingEvidence;
        $self['creditOrReversalProcessed'] = $creditOrReversalProcessed;
        $self['delayedChargeTransaction'] = $delayedChargeTransaction;
        $self['evidenceOfImprint'] = $evidenceOfImprint;
        $self['invalidDispute'] = $invalidDispute;
        $self['nonFiatCurrencyOrNonFungibleTokenReceived'] = $nonFiatCurrencyOrNonFungibleTokenReceived;
        $self['priorUndisputedNonFraudTransactions'] = $priorUndisputedNonFraudTransactions;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Cardholder no longer disputes details. Present if and only if `reason` is `cardholder_no_longer_disputes`.
     *
     * @param CardholderNoLongerDisputes|CardholderNoLongerDisputesShape|null $cardholderNoLongerDisputes
     */
    public function withCardholderNoLongerDisputes(
        CardholderNoLongerDisputes|array|null $cardholderNoLongerDisputes
    ): self {
        $self = clone $this;
        $self['cardholderNoLongerDisputes'] = $cardholderNoLongerDisputes;

        return $self;
    }

    /**
     * Compelling evidence details. Present if and only if `reason` is `compelling_evidence`.
     *
     * @param CompellingEvidence|CompellingEvidenceShape|null $compellingEvidence
     */
    public function withCompellingEvidence(
        CompellingEvidence|array|null $compellingEvidence
    ): self {
        $self = clone $this;
        $self['compellingEvidence'] = $compellingEvidence;

        return $self;
    }

    /**
     * Credit or reversal processed details. Present if and only if `reason` is `credit_or_reversal_processed`.
     *
     * @param CreditOrReversalProcessed|CreditOrReversalProcessedShape|null $creditOrReversalProcessed
     */
    public function withCreditOrReversalProcessed(
        CreditOrReversalProcessed|array|null $creditOrReversalProcessed
    ): self {
        $self = clone $this;
        $self['creditOrReversalProcessed'] = $creditOrReversalProcessed;

        return $self;
    }

    /**
     * Delayed charge transaction details. Present if and only if `reason` is `delayed_charge_transaction`.
     *
     * @param DelayedChargeTransaction|DelayedChargeTransactionShape|null $delayedChargeTransaction
     */
    public function withDelayedChargeTransaction(
        DelayedChargeTransaction|array|null $delayedChargeTransaction
    ): self {
        $self = clone $this;
        $self['delayedChargeTransaction'] = $delayedChargeTransaction;

        return $self;
    }

    /**
     * Evidence of imprint details. Present if and only if `reason` is `evidence_of_imprint`.
     *
     * @param EvidenceOfImprint|EvidenceOfImprintShape|null $evidenceOfImprint
     */
    public function withEvidenceOfImprint(
        EvidenceOfImprint|array|null $evidenceOfImprint
    ): self {
        $self = clone $this;
        $self['evidenceOfImprint'] = $evidenceOfImprint;

        return $self;
    }

    /**
     * Invalid dispute details. Present if and only if `reason` is `invalid_dispute`.
     *
     * @param InvalidDispute|InvalidDisputeShape|null $invalidDispute
     */
    public function withInvalidDispute(
        InvalidDispute|array|null $invalidDispute
    ): self {
        $self = clone $this;
        $self['invalidDispute'] = $invalidDispute;

        return $self;
    }

    /**
     * Non-fiat currency or non-fungible token received details. Present if and only if `reason` is `non_fiat_currency_or_non_fungible_token_received`.
     *
     * @param NonFiatCurrencyOrNonFungibleTokenReceived|NonFiatCurrencyOrNonFungibleTokenReceivedShape|null $nonFiatCurrencyOrNonFungibleTokenReceived
     */
    public function withNonFiatCurrencyOrNonFungibleTokenReceived(
        NonFiatCurrencyOrNonFungibleTokenReceived|array|null $nonFiatCurrencyOrNonFungibleTokenReceived,
    ): self {
        $self = clone $this;
        $self['nonFiatCurrencyOrNonFungibleTokenReceived'] = $nonFiatCurrencyOrNonFungibleTokenReceived;

        return $self;
    }

    /**
     * Prior undisputed non-fraud transactions details. Present if and only if `reason` is `prior_undisputed_non_fraud_transactions`.
     *
     * @param PriorUndisputedNonFraudTransactions|PriorUndisputedNonFraudTransactionsShape|null $priorUndisputedNonFraudTransactions
     */
    public function withPriorUndisputedNonFraudTransactions(
        PriorUndisputedNonFraudTransactions|array|null $priorUndisputedNonFraudTransactions,
    ): self {
        $self = clone $this;
        $self['priorUndisputedNonFraudTransactions'] = $priorUndisputedNonFraudTransactions;

        return $self;
    }

    /**
     * The reason the merchant re-presented the dispute.
     *
     * @param Reason|value-of<Reason> $reason
     */
    public function withReason(Reason|string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
