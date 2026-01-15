<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline\Actioner;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline\AdditionalAmounts;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline\Currency;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline\Direction;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline\NetworkDetails;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline\NetworkIdentifiers;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline\ProcessingCategory;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline\RealTimeDecisionReason;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline\Reason;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline\Verification;

/**
 * A Card Decline object. This field will be present in the JSON response if and only if `category` is equal to `card_decline`.
 *
 * @phpstan-import-type AdditionalAmountsShape from \Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline\AdditionalAmounts
 * @phpstan-import-type NetworkDetailsShape from \Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline\NetworkDetails
 * @phpstan-import-type NetworkIdentifiersShape from \Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline\NetworkIdentifiers
 * @phpstan-import-type VerificationShape from \Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline\Verification
 *
 * @phpstan-type CardDeclineShape = array{
 *   id: string,
 *   actioner: Actioner|value-of<Actioner>,
 *   additionalAmounts: AdditionalAmounts|AdditionalAmountsShape,
 *   amount: int,
 *   cardPaymentID: string,
 *   currency: Currency|value-of<Currency>,
 *   declinedTransactionID: string,
 *   digitalWalletTokenID: string|null,
 *   direction: Direction|value-of<Direction>,
 *   incrementedCardAuthorizationID: string|null,
 *   merchantAcceptorID: string,
 *   merchantCategoryCode: string,
 *   merchantCity: string|null,
 *   merchantCountry: string,
 *   merchantDescriptor: string,
 *   merchantPostalCode: string|null,
 *   merchantState: string|null,
 *   networkDetails: NetworkDetails|NetworkDetailsShape,
 *   networkIdentifiers: NetworkIdentifiers|NetworkIdentifiersShape,
 *   networkRiskScore: int|null,
 *   physicalCardID: string|null,
 *   presentmentAmount: int,
 *   presentmentCurrency: string,
 *   processingCategory: ProcessingCategory|value-of<ProcessingCategory>,
 *   realTimeDecisionID: string|null,
 *   realTimeDecisionReason: null|RealTimeDecisionReason|value-of<RealTimeDecisionReason>,
 *   reason: Reason|value-of<Reason>,
 *   terminalID: string|null,
 *   verification: Verification|VerificationShape,
 * }
 */
final class CardDecline implements BaseModel
{
    /** @use SdkModel<CardDeclineShape> */
    use SdkModel;

    /**
     * The Card Decline identifier.
     */
    #[Required]
    public string $id;

    /**
     * Whether this authorization was approved by Increase, the card network through stand-in processing, or the user through a real-time decision.
     *
     * @var value-of<Actioner> $actioner
     */
    #[Required(enum: Actioner::class)]
    public string $actioner;

    /**
     * Additional amounts associated with the card authorization, such as ATM surcharges fees. These are usually a subset of the `amount` field and are used to provide more detailed information about the transaction.
     */
    #[Required('additional_amounts')]
    public AdditionalAmounts $additionalAmounts;

    /**
     * The declined amount in the minor unit of the destination account currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * The ID of the Card Payment this transaction belongs to.
     */
    #[Required('card_payment_id')]
    public string $cardPaymentID;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the destination account currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The identifier of the declined transaction created for this Card Decline.
     */
    #[Required('declined_transaction_id')]
    public string $declinedTransactionID;

    /**
     * If the authorization was made via a Digital Wallet Token (such as an Apple Pay purchase), the identifier of the token that was used.
     */
    #[Required('digital_wallet_token_id')]
    public ?string $digitalWalletTokenID;

    /**
     * The direction describes the direction the funds will move, either from the cardholder to the merchant or from the merchant to the cardholder.
     *
     * @var value-of<Direction> $direction
     */
    #[Required(enum: Direction::class)]
    public string $direction;

    /**
     * The identifier of the card authorization this request attempted to incrementally authorize.
     */
    #[Required('incremented_card_authorization_id')]
    public ?string $incrementedCardAuthorizationID;

    /**
     * The merchant identifier (commonly abbreviated as MID) of the merchant the card is transacting with.
     */
    #[Required('merchant_acceptor_id')]
    public string $merchantAcceptorID;

    /**
     * The Merchant Category Code (commonly abbreviated as MCC) of the merchant the card is transacting with.
     */
    #[Required('merchant_category_code')]
    public string $merchantCategoryCode;

    /**
     * The city the merchant resides in.
     */
    #[Required('merchant_city')]
    public ?string $merchantCity;

    /**
     * The country the merchant resides in.
     */
    #[Required('merchant_country')]
    public string $merchantCountry;

    /**
     * The merchant descriptor of the merchant the card is transacting with.
     */
    #[Required('merchant_descriptor')]
    public string $merchantDescriptor;

    /**
     * The merchant's postal code. For US merchants this is either a 5-digit or 9-digit ZIP code, where the first 5 and last 4 are separated by a dash.
     */
    #[Required('merchant_postal_code')]
    public ?string $merchantPostalCode;

    /**
     * The state the merchant resides in.
     */
    #[Required('merchant_state')]
    public ?string $merchantState;

    /**
     * Fields specific to the `network`.
     */
    #[Required('network_details')]
    public NetworkDetails $networkDetails;

    /**
     * Network-specific identifiers for a specific request or transaction.
     */
    #[Required('network_identifiers')]
    public NetworkIdentifiers $networkIdentifiers;

    /**
     * The risk score generated by the card network. For Visa this is the Visa Advanced Authorization risk score, from 0 to 99, where 99 is the riskiest. For Pulse the score is from 0 to 999, where 999 is the riskiest.
     */
    #[Required('network_risk_score')]
    public ?int $networkRiskScore;

    /**
     * If the authorization was made in-person with a physical card, the Physical Card that was used.
     */
    #[Required('physical_card_id')]
    public ?string $physicalCardID;

    /**
     * The declined amount in the minor unit of the transaction's presentment currency.
     */
    #[Required('presentment_amount')]
    public int $presentmentAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transaction's presentment currency.
     */
    #[Required('presentment_currency')]
    public string $presentmentCurrency;

    /**
     * The processing category describes the intent behind the authorization, such as whether it was used for bill payments or an automatic fuel dispenser.
     *
     * @var value-of<ProcessingCategory> $processingCategory
     */
    #[Required('processing_category', enum: ProcessingCategory::class)]
    public string $processingCategory;

    /**
     * The identifier of the Real-Time Decision sent to approve or decline this transaction.
     */
    #[Required('real_time_decision_id')]
    public ?string $realTimeDecisionID;

    /**
     * This is present if a specific decline reason was given in the real-time decision.
     *
     * @var value-of<RealTimeDecisionReason>|null $realTimeDecisionReason
     */
    #[Required('real_time_decision_reason', enum: RealTimeDecisionReason::class)]
    public ?string $realTimeDecisionReason;

    /**
     * Why the transaction was declined.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * The terminal identifier (commonly abbreviated as TID) of the terminal the card is transacting with.
     */
    #[Required('terminal_id')]
    public ?string $terminalID;

    /**
     * Fields related to verification of cardholder-provided values.
     */
    #[Required]
    public Verification $verification;

    /**
     * `new CardDecline()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardDecline::with(
     *   id: ...,
     *   actioner: ...,
     *   additionalAmounts: ...,
     *   amount: ...,
     *   cardPaymentID: ...,
     *   currency: ...,
     *   declinedTransactionID: ...,
     *   digitalWalletTokenID: ...,
     *   direction: ...,
     *   incrementedCardAuthorizationID: ...,
     *   merchantAcceptorID: ...,
     *   merchantCategoryCode: ...,
     *   merchantCity: ...,
     *   merchantCountry: ...,
     *   merchantDescriptor: ...,
     *   merchantPostalCode: ...,
     *   merchantState: ...,
     *   networkDetails: ...,
     *   networkIdentifiers: ...,
     *   networkRiskScore: ...,
     *   physicalCardID: ...,
     *   presentmentAmount: ...,
     *   presentmentCurrency: ...,
     *   processingCategory: ...,
     *   realTimeDecisionID: ...,
     *   realTimeDecisionReason: ...,
     *   reason: ...,
     *   terminalID: ...,
     *   verification: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardDecline)
     *   ->withID(...)
     *   ->withActioner(...)
     *   ->withAdditionalAmounts(...)
     *   ->withAmount(...)
     *   ->withCardPaymentID(...)
     *   ->withCurrency(...)
     *   ->withDeclinedTransactionID(...)
     *   ->withDigitalWalletTokenID(...)
     *   ->withDirection(...)
     *   ->withIncrementedCardAuthorizationID(...)
     *   ->withMerchantAcceptorID(...)
     *   ->withMerchantCategoryCode(...)
     *   ->withMerchantCity(...)
     *   ->withMerchantCountry(...)
     *   ->withMerchantDescriptor(...)
     *   ->withMerchantPostalCode(...)
     *   ->withMerchantState(...)
     *   ->withNetworkDetails(...)
     *   ->withNetworkIdentifiers(...)
     *   ->withNetworkRiskScore(...)
     *   ->withPhysicalCardID(...)
     *   ->withPresentmentAmount(...)
     *   ->withPresentmentCurrency(...)
     *   ->withProcessingCategory(...)
     *   ->withRealTimeDecisionID(...)
     *   ->withRealTimeDecisionReason(...)
     *   ->withReason(...)
     *   ->withTerminalID(...)
     *   ->withVerification(...)
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
     * @param Actioner|value-of<Actioner> $actioner
     * @param AdditionalAmounts|AdditionalAmountsShape $additionalAmounts
     * @param Currency|value-of<Currency> $currency
     * @param Direction|value-of<Direction> $direction
     * @param NetworkDetails|NetworkDetailsShape $networkDetails
     * @param NetworkIdentifiers|NetworkIdentifiersShape $networkIdentifiers
     * @param ProcessingCategory|value-of<ProcessingCategory> $processingCategory
     * @param RealTimeDecisionReason|value-of<RealTimeDecisionReason>|null $realTimeDecisionReason
     * @param Reason|value-of<Reason> $reason
     * @param Verification|VerificationShape $verification
     */
    public static function with(
        string $id,
        Actioner|string $actioner,
        AdditionalAmounts|array $additionalAmounts,
        int $amount,
        string $cardPaymentID,
        Currency|string $currency,
        string $declinedTransactionID,
        ?string $digitalWalletTokenID,
        Direction|string $direction,
        ?string $incrementedCardAuthorizationID,
        string $merchantAcceptorID,
        string $merchantCategoryCode,
        ?string $merchantCity,
        string $merchantCountry,
        string $merchantDescriptor,
        ?string $merchantPostalCode,
        ?string $merchantState,
        NetworkDetails|array $networkDetails,
        NetworkIdentifiers|array $networkIdentifiers,
        ?int $networkRiskScore,
        ?string $physicalCardID,
        int $presentmentAmount,
        string $presentmentCurrency,
        ProcessingCategory|string $processingCategory,
        ?string $realTimeDecisionID,
        RealTimeDecisionReason|string|null $realTimeDecisionReason,
        Reason|string $reason,
        ?string $terminalID,
        Verification|array $verification,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['actioner'] = $actioner;
        $self['additionalAmounts'] = $additionalAmounts;
        $self['amount'] = $amount;
        $self['cardPaymentID'] = $cardPaymentID;
        $self['currency'] = $currency;
        $self['declinedTransactionID'] = $declinedTransactionID;
        $self['digitalWalletTokenID'] = $digitalWalletTokenID;
        $self['direction'] = $direction;
        $self['incrementedCardAuthorizationID'] = $incrementedCardAuthorizationID;
        $self['merchantAcceptorID'] = $merchantAcceptorID;
        $self['merchantCategoryCode'] = $merchantCategoryCode;
        $self['merchantCity'] = $merchantCity;
        $self['merchantCountry'] = $merchantCountry;
        $self['merchantDescriptor'] = $merchantDescriptor;
        $self['merchantPostalCode'] = $merchantPostalCode;
        $self['merchantState'] = $merchantState;
        $self['networkDetails'] = $networkDetails;
        $self['networkIdentifiers'] = $networkIdentifiers;
        $self['networkRiskScore'] = $networkRiskScore;
        $self['physicalCardID'] = $physicalCardID;
        $self['presentmentAmount'] = $presentmentAmount;
        $self['presentmentCurrency'] = $presentmentCurrency;
        $self['processingCategory'] = $processingCategory;
        $self['realTimeDecisionID'] = $realTimeDecisionID;
        $self['realTimeDecisionReason'] = $realTimeDecisionReason;
        $self['reason'] = $reason;
        $self['terminalID'] = $terminalID;
        $self['verification'] = $verification;

        return $self;
    }

    /**
     * The Card Decline identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Whether this authorization was approved by Increase, the card network through stand-in processing, or the user through a real-time decision.
     *
     * @param Actioner|value-of<Actioner> $actioner
     */
    public function withActioner(Actioner|string $actioner): self
    {
        $self = clone $this;
        $self['actioner'] = $actioner;

        return $self;
    }

    /**
     * Additional amounts associated with the card authorization, such as ATM surcharges fees. These are usually a subset of the `amount` field and are used to provide more detailed information about the transaction.
     *
     * @param AdditionalAmounts|AdditionalAmountsShape $additionalAmounts
     */
    public function withAdditionalAmounts(
        AdditionalAmounts|array $additionalAmounts
    ): self {
        $self = clone $this;
        $self['additionalAmounts'] = $additionalAmounts;

        return $self;
    }

    /**
     * The declined amount in the minor unit of the destination account currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The ID of the Card Payment this transaction belongs to.
     */
    public function withCardPaymentID(string $cardPaymentID): self
    {
        $self = clone $this;
        $self['cardPaymentID'] = $cardPaymentID;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the destination account currency.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The identifier of the declined transaction created for this Card Decline.
     */
    public function withDeclinedTransactionID(
        string $declinedTransactionID
    ): self {
        $self = clone $this;
        $self['declinedTransactionID'] = $declinedTransactionID;

        return $self;
    }

    /**
     * If the authorization was made via a Digital Wallet Token (such as an Apple Pay purchase), the identifier of the token that was used.
     */
    public function withDigitalWalletTokenID(
        ?string $digitalWalletTokenID
    ): self {
        $self = clone $this;
        $self['digitalWalletTokenID'] = $digitalWalletTokenID;

        return $self;
    }

    /**
     * The direction describes the direction the funds will move, either from the cardholder to the merchant or from the merchant to the cardholder.
     *
     * @param Direction|value-of<Direction> $direction
     */
    public function withDirection(Direction|string $direction): self
    {
        $self = clone $this;
        $self['direction'] = $direction;

        return $self;
    }

    /**
     * The identifier of the card authorization this request attempted to incrementally authorize.
     */
    public function withIncrementedCardAuthorizationID(
        ?string $incrementedCardAuthorizationID
    ): self {
        $self = clone $this;
        $self['incrementedCardAuthorizationID'] = $incrementedCardAuthorizationID;

        return $self;
    }

    /**
     * The merchant identifier (commonly abbreviated as MID) of the merchant the card is transacting with.
     */
    public function withMerchantAcceptorID(string $merchantAcceptorID): self
    {
        $self = clone $this;
        $self['merchantAcceptorID'] = $merchantAcceptorID;

        return $self;
    }

    /**
     * The Merchant Category Code (commonly abbreviated as MCC) of the merchant the card is transacting with.
     */
    public function withMerchantCategoryCode(string $merchantCategoryCode): self
    {
        $self = clone $this;
        $self['merchantCategoryCode'] = $merchantCategoryCode;

        return $self;
    }

    /**
     * The city the merchant resides in.
     */
    public function withMerchantCity(?string $merchantCity): self
    {
        $self = clone $this;
        $self['merchantCity'] = $merchantCity;

        return $self;
    }

    /**
     * The country the merchant resides in.
     */
    public function withMerchantCountry(string $merchantCountry): self
    {
        $self = clone $this;
        $self['merchantCountry'] = $merchantCountry;

        return $self;
    }

    /**
     * The merchant descriptor of the merchant the card is transacting with.
     */
    public function withMerchantDescriptor(string $merchantDescriptor): self
    {
        $self = clone $this;
        $self['merchantDescriptor'] = $merchantDescriptor;

        return $self;
    }

    /**
     * The merchant's postal code. For US merchants this is either a 5-digit or 9-digit ZIP code, where the first 5 and last 4 are separated by a dash.
     */
    public function withMerchantPostalCode(?string $merchantPostalCode): self
    {
        $self = clone $this;
        $self['merchantPostalCode'] = $merchantPostalCode;

        return $self;
    }

    /**
     * The state the merchant resides in.
     */
    public function withMerchantState(?string $merchantState): self
    {
        $self = clone $this;
        $self['merchantState'] = $merchantState;

        return $self;
    }

    /**
     * Fields specific to the `network`.
     *
     * @param NetworkDetails|NetworkDetailsShape $networkDetails
     */
    public function withNetworkDetails(
        NetworkDetails|array $networkDetails
    ): self {
        $self = clone $this;
        $self['networkDetails'] = $networkDetails;

        return $self;
    }

    /**
     * Network-specific identifiers for a specific request or transaction.
     *
     * @param NetworkIdentifiers|NetworkIdentifiersShape $networkIdentifiers
     */
    public function withNetworkIdentifiers(
        NetworkIdentifiers|array $networkIdentifiers
    ): self {
        $self = clone $this;
        $self['networkIdentifiers'] = $networkIdentifiers;

        return $self;
    }

    /**
     * The risk score generated by the card network. For Visa this is the Visa Advanced Authorization risk score, from 0 to 99, where 99 is the riskiest. For Pulse the score is from 0 to 999, where 999 is the riskiest.
     */
    public function withNetworkRiskScore(?int $networkRiskScore): self
    {
        $self = clone $this;
        $self['networkRiskScore'] = $networkRiskScore;

        return $self;
    }

    /**
     * If the authorization was made in-person with a physical card, the Physical Card that was used.
     */
    public function withPhysicalCardID(?string $physicalCardID): self
    {
        $self = clone $this;
        $self['physicalCardID'] = $physicalCardID;

        return $self;
    }

    /**
     * The declined amount in the minor unit of the transaction's presentment currency.
     */
    public function withPresentmentAmount(int $presentmentAmount): self
    {
        $self = clone $this;
        $self['presentmentAmount'] = $presentmentAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transaction's presentment currency.
     */
    public function withPresentmentCurrency(string $presentmentCurrency): self
    {
        $self = clone $this;
        $self['presentmentCurrency'] = $presentmentCurrency;

        return $self;
    }

    /**
     * The processing category describes the intent behind the authorization, such as whether it was used for bill payments or an automatic fuel dispenser.
     *
     * @param ProcessingCategory|value-of<ProcessingCategory> $processingCategory
     */
    public function withProcessingCategory(
        ProcessingCategory|string $processingCategory
    ): self {
        $self = clone $this;
        $self['processingCategory'] = $processingCategory;

        return $self;
    }

    /**
     * The identifier of the Real-Time Decision sent to approve or decline this transaction.
     */
    public function withRealTimeDecisionID(?string $realTimeDecisionID): self
    {
        $self = clone $this;
        $self['realTimeDecisionID'] = $realTimeDecisionID;

        return $self;
    }

    /**
     * This is present if a specific decline reason was given in the real-time decision.
     *
     * @param RealTimeDecisionReason|value-of<RealTimeDecisionReason>|null $realTimeDecisionReason
     */
    public function withRealTimeDecisionReason(
        RealTimeDecisionReason|string|null $realTimeDecisionReason
    ): self {
        $self = clone $this;
        $self['realTimeDecisionReason'] = $realTimeDecisionReason;

        return $self;
    }

    /**
     * Why the transaction was declined.
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
     * The terminal identifier (commonly abbreviated as TID) of the terminal the card is transacting with.
     */
    public function withTerminalID(?string $terminalID): self
    {
        $self = clone $this;
        $self['terminalID'] = $terminalID;

        return $self;
    }

    /**
     * Fields related to verification of cardholder-provided values.
     *
     * @param Verification|VerificationShape $verification
     */
    public function withVerification(Verification|array $verification): self
    {
        $self = clone $this;
        $self['verification'] = $verification;

        return $self;
    }
}
