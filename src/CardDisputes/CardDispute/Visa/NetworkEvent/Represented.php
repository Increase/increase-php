<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent;

use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\CardholderNoLongerDisputes;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\CreditOrReversalProcessed;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\InvalidDispute;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\NonFiatCurrencyOrNonFungibleTokenAsDescribed;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\NonFiatCurrencyOrNonFungibleTokenReceived;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\ProofOfCashDisbursement;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\Reason;
use Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\ReversalIssued;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Dispute Re-presented Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `represented`. Contains the details specific to a re-presented Visa Card Dispute Network Event, which represents that the merchant has declined the user's chargeback and has re-presented the payment.
 *
 * @phpstan-import-type CardholderNoLongerDisputesShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\CardholderNoLongerDisputes
 * @phpstan-import-type CreditOrReversalProcessedShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\CreditOrReversalProcessed
 * @phpstan-import-type InvalidDisputeShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\InvalidDispute
 * @phpstan-import-type NonFiatCurrencyOrNonFungibleTokenAsDescribedShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\NonFiatCurrencyOrNonFungibleTokenAsDescribed
 * @phpstan-import-type NonFiatCurrencyOrNonFungibleTokenReceivedShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\NonFiatCurrencyOrNonFungibleTokenReceived
 * @phpstan-import-type ProofOfCashDisbursementShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\ProofOfCashDisbursement
 * @phpstan-import-type ReversalIssuedShape from \Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\ReversalIssued
 *
 * @phpstan-type RepresentedShape = array{
 *   cardholderNoLongerDisputes: null|CardholderNoLongerDisputes|CardholderNoLongerDisputesShape,
 *   creditOrReversalProcessed: null|CreditOrReversalProcessed|CreditOrReversalProcessedShape,
 *   invalidDispute: null|InvalidDispute|InvalidDisputeShape,
 *   nonFiatCurrencyOrNonFungibleTokenAsDescribed: null|NonFiatCurrencyOrNonFungibleTokenAsDescribed|NonFiatCurrencyOrNonFungibleTokenAsDescribedShape,
 *   nonFiatCurrencyOrNonFungibleTokenReceived: null|NonFiatCurrencyOrNonFungibleTokenReceived|NonFiatCurrencyOrNonFungibleTokenReceivedShape,
 *   proofOfCashDisbursement: null|ProofOfCashDisbursement|ProofOfCashDisbursementShape,
 *   reason: Reason|value-of<Reason>,
 *   reversalIssued: null|ReversalIssued|ReversalIssuedShape,
 * }
 */
final class Represented implements BaseModel
{
    /** @use SdkModel<RepresentedShape> */
    use SdkModel;

    /**
     * Cardholder no longer disputes details. Present if and only if `reason` is `cardholder_no_longer_disputes`.
     */
    #[Required('cardholder_no_longer_disputes')]
    public ?CardholderNoLongerDisputes $cardholderNoLongerDisputes;

    /**
     * Credit or reversal processed details. Present if and only if `reason` is `credit_or_reversal_processed`.
     */
    #[Required('credit_or_reversal_processed')]
    public ?CreditOrReversalProcessed $creditOrReversalProcessed;

    /**
     * Invalid dispute details. Present if and only if `reason` is `invalid_dispute`.
     */
    #[Required('invalid_dispute')]
    public ?InvalidDispute $invalidDispute;

    /**
     * Non-fiat currency or non-fungible token as described details. Present if and only if `reason` is `non_fiat_currency_or_non_fungible_token_as_described`.
     */
    #[Required('non_fiat_currency_or_non_fungible_token_as_described')]
    public ?NonFiatCurrencyOrNonFungibleTokenAsDescribed $nonFiatCurrencyOrNonFungibleTokenAsDescribed;

    /**
     * Non-fiat currency or non-fungible token received details. Present if and only if `reason` is `non_fiat_currency_or_non_fungible_token_received`.
     */
    #[Required('non_fiat_currency_or_non_fungible_token_received')]
    public ?NonFiatCurrencyOrNonFungibleTokenReceived $nonFiatCurrencyOrNonFungibleTokenReceived;

    /**
     * Proof of cash disbursement details. Present if and only if `reason` is `proof_of_cash_disbursement`.
     */
    #[Required('proof_of_cash_disbursement')]
    public ?ProofOfCashDisbursement $proofOfCashDisbursement;

    /**
     * The reason the merchant re-presented the dispute.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * Reversal issued by merchant details. Present if and only if `reason` is `reversal_issued`.
     */
    #[Required('reversal_issued')]
    public ?ReversalIssued $reversalIssued;

    /**
     * `new Represented()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Represented::with(
     *   cardholderNoLongerDisputes: ...,
     *   creditOrReversalProcessed: ...,
     *   invalidDispute: ...,
     *   nonFiatCurrencyOrNonFungibleTokenAsDescribed: ...,
     *   nonFiatCurrencyOrNonFungibleTokenReceived: ...,
     *   proofOfCashDisbursement: ...,
     *   reason: ...,
     *   reversalIssued: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Represented)
     *   ->withCardholderNoLongerDisputes(...)
     *   ->withCreditOrReversalProcessed(...)
     *   ->withInvalidDispute(...)
     *   ->withNonFiatCurrencyOrNonFungibleTokenAsDescribed(...)
     *   ->withNonFiatCurrencyOrNonFungibleTokenReceived(...)
     *   ->withProofOfCashDisbursement(...)
     *   ->withReason(...)
     *   ->withReversalIssued(...)
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
     * @param CreditOrReversalProcessed|CreditOrReversalProcessedShape|null $creditOrReversalProcessed
     * @param InvalidDispute|InvalidDisputeShape|null $invalidDispute
     * @param NonFiatCurrencyOrNonFungibleTokenAsDescribed|NonFiatCurrencyOrNonFungibleTokenAsDescribedShape|null $nonFiatCurrencyOrNonFungibleTokenAsDescribed
     * @param NonFiatCurrencyOrNonFungibleTokenReceived|NonFiatCurrencyOrNonFungibleTokenReceivedShape|null $nonFiatCurrencyOrNonFungibleTokenReceived
     * @param ProofOfCashDisbursement|ProofOfCashDisbursementShape|null $proofOfCashDisbursement
     * @param Reason|value-of<Reason> $reason
     * @param ReversalIssued|ReversalIssuedShape|null $reversalIssued
     */
    public static function with(
        CardholderNoLongerDisputes|array|null $cardholderNoLongerDisputes,
        CreditOrReversalProcessed|array|null $creditOrReversalProcessed,
        InvalidDispute|array|null $invalidDispute,
        NonFiatCurrencyOrNonFungibleTokenAsDescribed|array|null $nonFiatCurrencyOrNonFungibleTokenAsDescribed,
        NonFiatCurrencyOrNonFungibleTokenReceived|array|null $nonFiatCurrencyOrNonFungibleTokenReceived,
        ProofOfCashDisbursement|array|null $proofOfCashDisbursement,
        Reason|string $reason,
        ReversalIssued|array|null $reversalIssued,
    ): self {
        $self = new self;

        $self['cardholderNoLongerDisputes'] = $cardholderNoLongerDisputes;
        $self['creditOrReversalProcessed'] = $creditOrReversalProcessed;
        $self['invalidDispute'] = $invalidDispute;
        $self['nonFiatCurrencyOrNonFungibleTokenAsDescribed'] = $nonFiatCurrencyOrNonFungibleTokenAsDescribed;
        $self['nonFiatCurrencyOrNonFungibleTokenReceived'] = $nonFiatCurrencyOrNonFungibleTokenReceived;
        $self['proofOfCashDisbursement'] = $proofOfCashDisbursement;
        $self['reason'] = $reason;
        $self['reversalIssued'] = $reversalIssued;

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
     * Non-fiat currency or non-fungible token as described details. Present if and only if `reason` is `non_fiat_currency_or_non_fungible_token_as_described`.
     *
     * @param NonFiatCurrencyOrNonFungibleTokenAsDescribed|NonFiatCurrencyOrNonFungibleTokenAsDescribedShape|null $nonFiatCurrencyOrNonFungibleTokenAsDescribed
     */
    public function withNonFiatCurrencyOrNonFungibleTokenAsDescribed(
        NonFiatCurrencyOrNonFungibleTokenAsDescribed|array|null $nonFiatCurrencyOrNonFungibleTokenAsDescribed,
    ): self {
        $self = clone $this;
        $self['nonFiatCurrencyOrNonFungibleTokenAsDescribed'] = $nonFiatCurrencyOrNonFungibleTokenAsDescribed;

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
     * Proof of cash disbursement details. Present if and only if `reason` is `proof_of_cash_disbursement`.
     *
     * @param ProofOfCashDisbursement|ProofOfCashDisbursementShape|null $proofOfCashDisbursement
     */
    public function withProofOfCashDisbursement(
        ProofOfCashDisbursement|array|null $proofOfCashDisbursement
    ): self {
        $self = clone $this;
        $self['proofOfCashDisbursement'] = $proofOfCashDisbursement;

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

    /**
     * Reversal issued by merchant details. Present if and only if `reason` is `reversal_issued`.
     *
     * @param ReversalIssued|ReversalIssuedShape|null $reversalIssued
     */
    public function withReversalIssued(
        ReversalIssued|array|null $reversalIssued
    ): self {
        $self = clone $this;
        $self['reversalIssued'] = $reversalIssued;

        return $self;
    }
}
