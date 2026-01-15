<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\AdditionalAmounts;
use Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\Approval;
use Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\Decision;
use Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\NetworkDetails;
use Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\NetworkIdentifiers;
use Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\Verification;

/**
 * Fields related to a card balance inquiry.
 *
 * @phpstan-import-type AdditionalAmountsShape from \Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\AdditionalAmounts
 * @phpstan-import-type ApprovalShape from \Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\Approval
 * @phpstan-import-type NetworkDetailsShape from \Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\NetworkDetails
 * @phpstan-import-type NetworkIdentifiersShape from \Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\NetworkIdentifiers
 * @phpstan-import-type VerificationShape from \Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry\Verification
 *
 * @phpstan-type CardBalanceInquiryShape = array{
 *   accountID: string,
 *   additionalAmounts: AdditionalAmounts|AdditionalAmountsShape,
 *   approval: null|Approval|ApprovalShape,
 *   cardID: string,
 *   decision: null|Decision|value-of<Decision>,
 *   digitalWalletTokenID: string|null,
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
 *   terminalID: string|null,
 *   upcomingCardPaymentID: string,
 *   verification: Verification|VerificationShape,
 * }
 */
final class CardBalanceInquiry implements BaseModel
{
    /** @use SdkModel<CardBalanceInquiryShape> */
    use SdkModel;

    /**
     * The identifier of the Account the authorization will debit.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * Additional amounts associated with the card authorization, such as ATM surcharges fees. These are usually a subset of the `amount` field and are used to provide more detailed information about the transaction.
     */
    #[Required('additional_amounts')]
    public AdditionalAmounts $additionalAmounts;

    /**
     * Present if and only if `decision` is `approve`. Contains information related to the approval of the balance inquiry.
     */
    #[Required]
    public ?Approval $approval;

    /**
     * The identifier of the Card that is being authorized.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * Whether or not the authorization was approved.
     *
     * @var value-of<Decision>|null $decision
     */
    #[Required(enum: Decision::class)]
    public ?string $decision;

    /**
     * If the authorization was made via a Digital Wallet Token (such as an Apple Pay purchase), the identifier of the token that was used.
     */
    #[Required('digital_wallet_token_id')]
    public ?string $digitalWalletTokenID;

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
     * The terminal identifier (commonly abbreviated as TID) of the terminal the card is transacting with.
     */
    #[Required('terminal_id')]
    public ?string $terminalID;

    /**
     * The identifier of the Card Payment this authorization will belong to. Available in the API once the card authorization has completed.
     */
    #[Required('upcoming_card_payment_id')]
    public string $upcomingCardPaymentID;

    /**
     * Fields related to verification of cardholder-provided values.
     */
    #[Required]
    public Verification $verification;

    /**
     * `new CardBalanceInquiry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardBalanceInquiry::with(
     *   accountID: ...,
     *   additionalAmounts: ...,
     *   approval: ...,
     *   cardID: ...,
     *   decision: ...,
     *   digitalWalletTokenID: ...,
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
     *   terminalID: ...,
     *   upcomingCardPaymentID: ...,
     *   verification: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardBalanceInquiry)
     *   ->withAccountID(...)
     *   ->withAdditionalAmounts(...)
     *   ->withApproval(...)
     *   ->withCardID(...)
     *   ->withDecision(...)
     *   ->withDigitalWalletTokenID(...)
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
     *   ->withTerminalID(...)
     *   ->withUpcomingCardPaymentID(...)
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
     * @param AdditionalAmounts|AdditionalAmountsShape $additionalAmounts
     * @param Approval|ApprovalShape|null $approval
     * @param Decision|value-of<Decision>|null $decision
     * @param NetworkDetails|NetworkDetailsShape $networkDetails
     * @param NetworkIdentifiers|NetworkIdentifiersShape $networkIdentifiers
     * @param Verification|VerificationShape $verification
     */
    public static function with(
        string $accountID,
        AdditionalAmounts|array $additionalAmounts,
        Approval|array|null $approval,
        string $cardID,
        Decision|string|null $decision,
        ?string $digitalWalletTokenID,
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
        ?string $terminalID,
        string $upcomingCardPaymentID,
        Verification|array $verification,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['additionalAmounts'] = $additionalAmounts;
        $self['approval'] = $approval;
        $self['cardID'] = $cardID;
        $self['decision'] = $decision;
        $self['digitalWalletTokenID'] = $digitalWalletTokenID;
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
        $self['terminalID'] = $terminalID;
        $self['upcomingCardPaymentID'] = $upcomingCardPaymentID;
        $self['verification'] = $verification;

        return $self;
    }

    /**
     * The identifier of the Account the authorization will debit.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

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
     * Present if and only if `decision` is `approve`. Contains information related to the approval of the balance inquiry.
     *
     * @param Approval|ApprovalShape|null $approval
     */
    public function withApproval(Approval|array|null $approval): self
    {
        $self = clone $this;
        $self['approval'] = $approval;

        return $self;
    }

    /**
     * The identifier of the Card that is being authorized.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

        return $self;
    }

    /**
     * Whether or not the authorization was approved.
     *
     * @param Decision|value-of<Decision>|null $decision
     */
    public function withDecision(Decision|string|null $decision): self
    {
        $self = clone $this;
        $self['decision'] = $decision;

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
     * The terminal identifier (commonly abbreviated as TID) of the terminal the card is transacting with.
     */
    public function withTerminalID(?string $terminalID): self
    {
        $self = clone $this;
        $self['terminalID'] = $terminalID;

        return $self;
    }

    /**
     * The identifier of the Card Payment this authorization will belong to. Available in the API once the card authorization has completed.
     */
    public function withUpcomingCardPaymentID(
        string $upcomingCardPaymentID
    ): self {
        $self = clone $this;
        $self['upcomingCardPaymentID'] = $upcomingCardPaymentID;

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
