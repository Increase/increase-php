<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\AdditionalAmounts;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\Approval;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\Decision;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\Decline;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\Direction;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\NetworkDetails;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\NetworkIdentifiers;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\PartialApprovalCapability;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\ProcessingCategory;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\RequestDetails;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\Verification;

/**
 * Fields related to a card authorization.
 *
 * @phpstan-import-type AdditionalAmountsShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\AdditionalAmounts
 * @phpstan-import-type ApprovalShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\Approval
 * @phpstan-import-type DeclineShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\Decline
 * @phpstan-import-type NetworkDetailsShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\NetworkDetails
 * @phpstan-import-type NetworkIdentifiersShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\NetworkIdentifiers
 * @phpstan-import-type RequestDetailsShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\RequestDetails
 * @phpstan-import-type VerificationShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\Verification
 *
 * @phpstan-type CardAuthorizationShape = array{
 *   accountID: string,
 *   additionalAmounts: AdditionalAmounts|AdditionalAmountsShape,
 *   approval: null|Approval|ApprovalShape,
 *   cardID: string,
 *   decision: null|Decision|value-of<Decision>,
 *   decline: null|Decline|DeclineShape,
 *   digitalWalletTokenID: string|null,
 *   direction: Direction|value-of<Direction>,
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
 *   partialApprovalCapability: PartialApprovalCapability|value-of<PartialApprovalCapability>,
 *   physicalCardID: string|null,
 *   presentmentAmount: int,
 *   presentmentCurrency: string,
 *   processingCategory: ProcessingCategory|value-of<ProcessingCategory>,
 *   requestDetails: RequestDetails|RequestDetailsShape,
 *   settlementAmount: int,
 *   settlementCurrency: string,
 *   terminalID: string|null,
 *   upcomingCardPaymentID: string,
 *   verification: Verification|VerificationShape,
 * }
 */
final class CardAuthorization implements BaseModel
{
    /** @use SdkModel<CardAuthorizationShape> */
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
     * Present if and only if `decision` is `approve`. Contains information related to the approval of the authorization.
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
     * Present if and only if `decision` is `decline`. Contains information related to the reason the authorization was declined.
     */
    #[Required]
    public ?Decline $decline;

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
     * Whether or not the authorization supports partial approvals.
     *
     * @var value-of<PartialApprovalCapability> $partialApprovalCapability
     */
    #[Required(
        'partial_approval_capability',
        enum: PartialApprovalCapability::class
    )]
    public string $partialApprovalCapability;

    /**
     * If the authorization was made in-person with a physical card, the Physical Card that was used.
     */
    #[Required('physical_card_id')]
    public ?string $physicalCardID;

    /**
     * The amount of the attempted authorization in the currency the card user sees at the time of purchase, in the minor unit of that currency. For dollars, for example, this is cents.
     */
    #[Required('presentment_amount')]
    public int $presentmentAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the currency the user sees at the time of purchase.
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
     * Fields specific to the type of request, such as an incremental authorization.
     */
    #[Required('request_details')]
    public RequestDetails $requestDetails;

    /**
     * The amount of the attempted authorization in the currency it will be settled in. This currency is the same as that of the Account the card belongs to.
     */
    #[Required('settlement_amount')]
    public int $settlementAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the currency the transaction will be settled in.
     */
    #[Required('settlement_currency')]
    public string $settlementCurrency;

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
     * `new CardAuthorization()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardAuthorization::with(
     *   accountID: ...,
     *   additionalAmounts: ...,
     *   approval: ...,
     *   cardID: ...,
     *   decision: ...,
     *   decline: ...,
     *   digitalWalletTokenID: ...,
     *   direction: ...,
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
     *   partialApprovalCapability: ...,
     *   physicalCardID: ...,
     *   presentmentAmount: ...,
     *   presentmentCurrency: ...,
     *   processingCategory: ...,
     *   requestDetails: ...,
     *   settlementAmount: ...,
     *   settlementCurrency: ...,
     *   terminalID: ...,
     *   upcomingCardPaymentID: ...,
     *   verification: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardAuthorization)
     *   ->withAccountID(...)
     *   ->withAdditionalAmounts(...)
     *   ->withApproval(...)
     *   ->withCardID(...)
     *   ->withDecision(...)
     *   ->withDecline(...)
     *   ->withDigitalWalletTokenID(...)
     *   ->withDirection(...)
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
     *   ->withPartialApprovalCapability(...)
     *   ->withPhysicalCardID(...)
     *   ->withPresentmentAmount(...)
     *   ->withPresentmentCurrency(...)
     *   ->withProcessingCategory(...)
     *   ->withRequestDetails(...)
     *   ->withSettlementAmount(...)
     *   ->withSettlementCurrency(...)
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
     * @param Decline|DeclineShape|null $decline
     * @param Direction|value-of<Direction> $direction
     * @param NetworkDetails|NetworkDetailsShape $networkDetails
     * @param NetworkIdentifiers|NetworkIdentifiersShape $networkIdentifiers
     * @param PartialApprovalCapability|value-of<PartialApprovalCapability> $partialApprovalCapability
     * @param ProcessingCategory|value-of<ProcessingCategory> $processingCategory
     * @param RequestDetails|RequestDetailsShape $requestDetails
     * @param Verification|VerificationShape $verification
     */
    public static function with(
        string $accountID,
        AdditionalAmounts|array $additionalAmounts,
        Approval|array|null $approval,
        string $cardID,
        Decision|string|null $decision,
        Decline|array|null $decline,
        ?string $digitalWalletTokenID,
        Direction|string $direction,
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
        PartialApprovalCapability|string $partialApprovalCapability,
        ?string $physicalCardID,
        int $presentmentAmount,
        string $presentmentCurrency,
        ProcessingCategory|string $processingCategory,
        RequestDetails|array $requestDetails,
        int $settlementAmount,
        string $settlementCurrency,
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
        $self['decline'] = $decline;
        $self['digitalWalletTokenID'] = $digitalWalletTokenID;
        $self['direction'] = $direction;
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
        $self['partialApprovalCapability'] = $partialApprovalCapability;
        $self['physicalCardID'] = $physicalCardID;
        $self['presentmentAmount'] = $presentmentAmount;
        $self['presentmentCurrency'] = $presentmentCurrency;
        $self['processingCategory'] = $processingCategory;
        $self['requestDetails'] = $requestDetails;
        $self['settlementAmount'] = $settlementAmount;
        $self['settlementCurrency'] = $settlementCurrency;
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
     * Present if and only if `decision` is `approve`. Contains information related to the approval of the authorization.
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
     * Present if and only if `decision` is `decline`. Contains information related to the reason the authorization was declined.
     *
     * @param Decline|DeclineShape|null $decline
     */
    public function withDecline(Decline|array|null $decline): self
    {
        $self = clone $this;
        $self['decline'] = $decline;

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
     * Whether or not the authorization supports partial approvals.
     *
     * @param PartialApprovalCapability|value-of<PartialApprovalCapability> $partialApprovalCapability
     */
    public function withPartialApprovalCapability(
        PartialApprovalCapability|string $partialApprovalCapability
    ): self {
        $self = clone $this;
        $self['partialApprovalCapability'] = $partialApprovalCapability;

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
     * The amount of the attempted authorization in the currency the card user sees at the time of purchase, in the minor unit of that currency. For dollars, for example, this is cents.
     */
    public function withPresentmentAmount(int $presentmentAmount): self
    {
        $self = clone $this;
        $self['presentmentAmount'] = $presentmentAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the currency the user sees at the time of purchase.
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
     * Fields specific to the type of request, such as an incremental authorization.
     *
     * @param RequestDetails|RequestDetailsShape $requestDetails
     */
    public function withRequestDetails(
        RequestDetails|array $requestDetails
    ): self {
        $self = clone $this;
        $self['requestDetails'] = $requestDetails;

        return $self;
    }

    /**
     * The amount of the attempted authorization in the currency it will be settled in. This currency is the same as that of the Account the card belongs to.
     */
    public function withSettlementAmount(int $settlementAmount): self
    {
        $self = clone $this;
        $self['settlementAmount'] = $settlementAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the currency the transaction will be settled in.
     */
    public function withSettlementCurrency(string $settlementCurrency): self
    {
        $self = clone $this;
        $self['settlementCurrency'] = $settlementCurrency;

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
