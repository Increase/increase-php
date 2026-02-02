<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\AccountRevenuePayment;
use Increase\Transactions\Transaction\Source\AccountTransferIntention;
use Increase\Transactions\Transaction\Source\ACHTransferIntention;
use Increase\Transactions\Transaction\Source\ACHTransferRejection;
use Increase\Transactions\Transaction\Source\ACHTransferReturn;
use Increase\Transactions\Transaction\Source\BlockchainOfframpTransferSettlement;
use Increase\Transactions\Transaction\Source\BlockchainOnrampTransferIntention;
use Increase\Transactions\Transaction\Source\CardDisputeAcceptance;
use Increase\Transactions\Transaction\Source\CardDisputeFinancial;
use Increase\Transactions\Transaction\Source\CardDisputeLoss;
use Increase\Transactions\Transaction\Source\CardFinancial;
use Increase\Transactions\Transaction\Source\CardPushTransferAcceptance;
use Increase\Transactions\Transaction\Source\CardRefund;
use Increase\Transactions\Transaction\Source\CardRevenuePayment;
use Increase\Transactions\Transaction\Source\CardSettlement;
use Increase\Transactions\Transaction\Source\CashbackPayment;
use Increase\Transactions\Transaction\Source\Category;
use Increase\Transactions\Transaction\Source\CheckDepositAcceptance;
use Increase\Transactions\Transaction\Source\CheckDepositReturn;
use Increase\Transactions\Transaction\Source\CheckTransferDeposit;
use Increase\Transactions\Transaction\Source\FednowTransferAcknowledgement;
use Increase\Transactions\Transaction\Source\FeePayment;
use Increase\Transactions\Transaction\Source\InboundACHTransfer;
use Increase\Transactions\Transaction\Source\InboundACHTransferReturnIntention;
use Increase\Transactions\Transaction\Source\InboundCheckAdjustment;
use Increase\Transactions\Transaction\Source\InboundCheckDepositReturnIntention;
use Increase\Transactions\Transaction\Source\InboundFednowTransferConfirmation;
use Increase\Transactions\Transaction\Source\InboundRealTimePaymentsTransferConfirmation;
use Increase\Transactions\Transaction\Source\InboundWireReversal;
use Increase\Transactions\Transaction\Source\InboundWireTransfer;
use Increase\Transactions\Transaction\Source\InboundWireTransferReversal;
use Increase\Transactions\Transaction\Source\InterestPayment;
use Increase\Transactions\Transaction\Source\InternalSource;
use Increase\Transactions\Transaction\Source\Other;
use Increase\Transactions\Transaction\Source\RealTimePaymentsTransferAcknowledgement;
use Increase\Transactions\Transaction\Source\SampleFunds;
use Increase\Transactions\Transaction\Source\SwiftTransferIntention;
use Increase\Transactions\Transaction\Source\SwiftTransferReturn;
use Increase\Transactions\Transaction\Source\WireTransferIntention;

/**
 * This is an object giving more details on the network-level event that caused the Transaction. Note that for backwards compatibility reasons, additional undocumented keys may appear in this object. These should be treated as deprecated and will be removed in the future.
 *
 * @phpstan-import-type AccountRevenuePaymentShape from \Increase\Transactions\Transaction\Source\AccountRevenuePayment
 * @phpstan-import-type AccountTransferIntentionShape from \Increase\Transactions\Transaction\Source\AccountTransferIntention
 * @phpstan-import-type ACHTransferIntentionShape from \Increase\Transactions\Transaction\Source\ACHTransferIntention
 * @phpstan-import-type ACHTransferRejectionShape from \Increase\Transactions\Transaction\Source\ACHTransferRejection
 * @phpstan-import-type ACHTransferReturnShape from \Increase\Transactions\Transaction\Source\ACHTransferReturn
 * @phpstan-import-type BlockchainOfframpTransferSettlementShape from \Increase\Transactions\Transaction\Source\BlockchainOfframpTransferSettlement
 * @phpstan-import-type BlockchainOnrampTransferIntentionShape from \Increase\Transactions\Transaction\Source\BlockchainOnrampTransferIntention
 * @phpstan-import-type CardDisputeAcceptanceShape from \Increase\Transactions\Transaction\Source\CardDisputeAcceptance
 * @phpstan-import-type CardDisputeFinancialShape from \Increase\Transactions\Transaction\Source\CardDisputeFinancial
 * @phpstan-import-type CardDisputeLossShape from \Increase\Transactions\Transaction\Source\CardDisputeLoss
 * @phpstan-import-type CardFinancialShape from \Increase\Transactions\Transaction\Source\CardFinancial
 * @phpstan-import-type CardPushTransferAcceptanceShape from \Increase\Transactions\Transaction\Source\CardPushTransferAcceptance
 * @phpstan-import-type CardRefundShape from \Increase\Transactions\Transaction\Source\CardRefund
 * @phpstan-import-type CardRevenuePaymentShape from \Increase\Transactions\Transaction\Source\CardRevenuePayment
 * @phpstan-import-type CardSettlementShape from \Increase\Transactions\Transaction\Source\CardSettlement
 * @phpstan-import-type CashbackPaymentShape from \Increase\Transactions\Transaction\Source\CashbackPayment
 * @phpstan-import-type CheckDepositAcceptanceShape from \Increase\Transactions\Transaction\Source\CheckDepositAcceptance
 * @phpstan-import-type CheckDepositReturnShape from \Increase\Transactions\Transaction\Source\CheckDepositReturn
 * @phpstan-import-type CheckTransferDepositShape from \Increase\Transactions\Transaction\Source\CheckTransferDeposit
 * @phpstan-import-type FednowTransferAcknowledgementShape from \Increase\Transactions\Transaction\Source\FednowTransferAcknowledgement
 * @phpstan-import-type FeePaymentShape from \Increase\Transactions\Transaction\Source\FeePayment
 * @phpstan-import-type InboundACHTransferShape from \Increase\Transactions\Transaction\Source\InboundACHTransfer
 * @phpstan-import-type InboundACHTransferReturnIntentionShape from \Increase\Transactions\Transaction\Source\InboundACHTransferReturnIntention
 * @phpstan-import-type InboundCheckAdjustmentShape from \Increase\Transactions\Transaction\Source\InboundCheckAdjustment
 * @phpstan-import-type InboundCheckDepositReturnIntentionShape from \Increase\Transactions\Transaction\Source\InboundCheckDepositReturnIntention
 * @phpstan-import-type InboundFednowTransferConfirmationShape from \Increase\Transactions\Transaction\Source\InboundFednowTransferConfirmation
 * @phpstan-import-type InboundRealTimePaymentsTransferConfirmationShape from \Increase\Transactions\Transaction\Source\InboundRealTimePaymentsTransferConfirmation
 * @phpstan-import-type InboundWireReversalShape from \Increase\Transactions\Transaction\Source\InboundWireReversal
 * @phpstan-import-type InboundWireTransferShape from \Increase\Transactions\Transaction\Source\InboundWireTransfer
 * @phpstan-import-type InboundWireTransferReversalShape from \Increase\Transactions\Transaction\Source\InboundWireTransferReversal
 * @phpstan-import-type InterestPaymentShape from \Increase\Transactions\Transaction\Source\InterestPayment
 * @phpstan-import-type InternalSourceShape from \Increase\Transactions\Transaction\Source\InternalSource
 * @phpstan-import-type OtherShape from \Increase\Transactions\Transaction\Source\Other
 * @phpstan-import-type RealTimePaymentsTransferAcknowledgementShape from \Increase\Transactions\Transaction\Source\RealTimePaymentsTransferAcknowledgement
 * @phpstan-import-type SampleFundsShape from \Increase\Transactions\Transaction\Source\SampleFunds
 * @phpstan-import-type SwiftTransferIntentionShape from \Increase\Transactions\Transaction\Source\SwiftTransferIntention
 * @phpstan-import-type SwiftTransferReturnShape from \Increase\Transactions\Transaction\Source\SwiftTransferReturn
 * @phpstan-import-type WireTransferIntentionShape from \Increase\Transactions\Transaction\Source\WireTransferIntention
 *
 * @phpstan-type SourceShape = array{
 *   accountRevenuePayment: null|AccountRevenuePayment|AccountRevenuePaymentShape,
 *   accountTransferIntention: null|AccountTransferIntention|AccountTransferIntentionShape,
 *   achTransferIntention: null|ACHTransferIntention|ACHTransferIntentionShape,
 *   achTransferRejection: null|ACHTransferRejection|ACHTransferRejectionShape,
 *   achTransferReturn: null|ACHTransferReturn|ACHTransferReturnShape,
 *   blockchainOfframpTransferSettlement: null|BlockchainOfframpTransferSettlement|BlockchainOfframpTransferSettlementShape,
 *   blockchainOnrampTransferIntention: null|BlockchainOnrampTransferIntention|BlockchainOnrampTransferIntentionShape,
 *   cardDisputeAcceptance: null|CardDisputeAcceptance|CardDisputeAcceptanceShape,
 *   cardDisputeFinancial: null|CardDisputeFinancial|CardDisputeFinancialShape,
 *   cardDisputeLoss: null|CardDisputeLoss|CardDisputeLossShape,
 *   cardFinancial: null|CardFinancial|CardFinancialShape,
 *   cardPushTransferAcceptance: null|CardPushTransferAcceptance|CardPushTransferAcceptanceShape,
 *   cardRefund: null|CardRefund|CardRefundShape,
 *   cardRevenuePayment: null|CardRevenuePayment|CardRevenuePaymentShape,
 *   cardSettlement: null|CardSettlement|CardSettlementShape,
 *   cashbackPayment: null|CashbackPayment|CashbackPaymentShape,
 *   category: Category|value-of<Category>,
 *   checkDepositAcceptance: null|CheckDepositAcceptance|CheckDepositAcceptanceShape,
 *   checkDepositReturn: null|CheckDepositReturn|CheckDepositReturnShape,
 *   checkTransferDeposit: null|CheckTransferDeposit|CheckTransferDepositShape,
 *   fednowTransferAcknowledgement: null|FednowTransferAcknowledgement|FednowTransferAcknowledgementShape,
 *   feePayment: null|FeePayment|FeePaymentShape,
 *   inboundACHTransfer: null|InboundACHTransfer|InboundACHTransferShape,
 *   inboundACHTransferReturnIntention: null|InboundACHTransferReturnIntention|InboundACHTransferReturnIntentionShape,
 *   inboundCheckAdjustment: null|InboundCheckAdjustment|InboundCheckAdjustmentShape,
 *   inboundCheckDepositReturnIntention: null|InboundCheckDepositReturnIntention|InboundCheckDepositReturnIntentionShape,
 *   inboundFednowTransferConfirmation: null|InboundFednowTransferConfirmation|InboundFednowTransferConfirmationShape,
 *   inboundRealTimePaymentsTransferConfirmation: null|InboundRealTimePaymentsTransferConfirmation|InboundRealTimePaymentsTransferConfirmationShape,
 *   inboundWireReversal: null|InboundWireReversal|InboundWireReversalShape,
 *   inboundWireTransfer: null|InboundWireTransfer|InboundWireTransferShape,
 *   inboundWireTransferReversal: null|InboundWireTransferReversal|InboundWireTransferReversalShape,
 *   interestPayment: null|InterestPayment|InterestPaymentShape,
 *   internalSource: null|InternalSource|InternalSourceShape,
 *   other: null|Other|OtherShape,
 *   realTimePaymentsTransferAcknowledgement: null|RealTimePaymentsTransferAcknowledgement|RealTimePaymentsTransferAcknowledgementShape,
 *   sampleFunds: null|SampleFunds|SampleFundsShape,
 *   swiftTransferIntention: null|SwiftTransferIntention|SwiftTransferIntentionShape,
 *   swiftTransferReturn: null|SwiftTransferReturn|SwiftTransferReturnShape,
 *   wireTransferIntention: null|WireTransferIntention|WireTransferIntentionShape,
 * }
 */
final class Source implements BaseModel
{
    /** @use SdkModel<SourceShape> */
    use SdkModel;

    /**
     * An Account Revenue Payment object. This field will be present in the JSON response if and only if `category` is equal to `account_revenue_payment`. An Account Revenue Payment represents a payment made to an account from the bank. Account revenue is a type of non-interest income.
     */
    #[Required('account_revenue_payment')]
    public ?AccountRevenuePayment $accountRevenuePayment;

    /**
     * An Account Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `account_transfer_intention`. Two Account Transfer Intentions are created from each Account Transfer. One decrements the source account, and the other increments the destination account.
     */
    #[Required('account_transfer_intention')]
    public ?AccountTransferIntention $accountTransferIntention;

    /**
     * An ACH Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `ach_transfer_intention`. An ACH Transfer Intention is created from an ACH Transfer. It reflects the intention to move money into or out of an Increase account via the ACH network.
     */
    #[Required('ach_transfer_intention')]
    public ?ACHTransferIntention $achTransferIntention;

    /**
     * An ACH Transfer Rejection object. This field will be present in the JSON response if and only if `category` is equal to `ach_transfer_rejection`. An ACH Transfer Rejection is created when an ACH Transfer is rejected by Increase. It offsets the ACH Transfer Intention. These rejections are rare.
     */
    #[Required('ach_transfer_rejection')]
    public ?ACHTransferRejection $achTransferRejection;

    /**
     * An ACH Transfer Return object. This field will be present in the JSON response if and only if `category` is equal to `ach_transfer_return`. An ACH Transfer Return is created when an ACH Transfer is returned by the receiving bank. It offsets the ACH Transfer Intention. ACH Transfer Returns usually occur within the first two business days after the transfer is initiated, but can occur much later.
     */
    #[Required('ach_transfer_return')]
    public ?ACHTransferReturn $achTransferReturn;

    /**
     * A Blockchain Off-Ramp Transfer Settlement object. This field will be present in the JSON response if and only if `category` is equal to `blockchain_offramp_transfer_settlement`.
     */
    #[Required('blockchain_offramp_transfer_settlement')]
    public ?BlockchainOfframpTransferSettlement $blockchainOfframpTransferSettlement;

    /**
     * A Blockchain On-Ramp Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `blockchain_onramp_transfer_intention`.
     */
    #[Required('blockchain_onramp_transfer_intention')]
    public ?BlockchainOnrampTransferIntention $blockchainOnrampTransferIntention;

    /**
     * A Legacy Card Dispute Acceptance object. This field will be present in the JSON response if and only if `category` is equal to `card_dispute_acceptance`. Contains the details of a successful Card Dispute.
     */
    #[Required('card_dispute_acceptance')]
    public ?CardDisputeAcceptance $cardDisputeAcceptance;

    /**
     * A Card Dispute Financial object. This field will be present in the JSON response if and only if `category` is equal to `card_dispute_financial`. Financial event related to a Card Dispute.
     */
    #[Required('card_dispute_financial')]
    public ?CardDisputeFinancial $cardDisputeFinancial;

    /**
     * A Legacy Card Dispute Loss object. This field will be present in the JSON response if and only if `category` is equal to `card_dispute_loss`. Contains the details of a lost Card Dispute.
     */
    #[Required('card_dispute_loss')]
    public ?CardDisputeLoss $cardDisputeLoss;

    /**
     * A Card Financial object. This field will be present in the JSON response if and only if `category` is equal to `card_financial`. Card Financials are temporary holds placed on a customers funds with the intent to later clear a transaction.
     */
    #[Required('card_financial')]
    public ?CardFinancial $cardFinancial;

    /**
     * A Card Push Transfer Acceptance object. This field will be present in the JSON response if and only if `category` is equal to `card_push_transfer_acceptance`. A Card Push Transfer Acceptance is created when an Outbound Card Push Transfer sent from Increase is accepted by the receiving bank.
     */
    #[Required('card_push_transfer_acceptance')]
    public ?CardPushTransferAcceptance $cardPushTransferAcceptance;

    /**
     * A Card Refund object. This field will be present in the JSON response if and only if `category` is equal to `card_refund`. Card Refunds move money back to the cardholder. While they are usually connected to a Card Settlement an acquirer can also refund money directly to a card without relation to a transaction.
     */
    #[Required('card_refund')]
    public ?CardRefund $cardRefund;

    /**
     * A Card Revenue Payment object. This field will be present in the JSON response if and only if `category` is equal to `card_revenue_payment`. Card Revenue Payments reflect earnings from fees on card transactions.
     */
    #[Required('card_revenue_payment')]
    public ?CardRevenuePayment $cardRevenuePayment;

    /**
     * A Card Settlement object. This field will be present in the JSON response if and only if `category` is equal to `card_settlement`. Card Settlements are card transactions that have cleared and settled. While a settlement is usually preceded by an authorization, an acquirer can also directly clear a transaction without first authorizing it.
     */
    #[Required('card_settlement')]
    public ?CardSettlement $cardSettlement;

    /**
     * A Cashback Payment object. This field will be present in the JSON response if and only if `category` is equal to `cashback_payment`. A Cashback Payment represents the cashback paid to a cardholder for a given period. Cashback is usually paid monthly for the prior month's transactions.
     */
    #[Required('cashback_payment')]
    public ?CashbackPayment $cashbackPayment;

    /**
     * The type of the resource. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * A Check Deposit Acceptance object. This field will be present in the JSON response if and only if `category` is equal to `check_deposit_acceptance`. A Check Deposit Acceptance is created when a Check Deposit is processed and its details confirmed. Check Deposits may be returned by the receiving bank, which will appear as a Check Deposit Return.
     */
    #[Required('check_deposit_acceptance')]
    public ?CheckDepositAcceptance $checkDepositAcceptance;

    /**
     * A Check Deposit Return object. This field will be present in the JSON response if and only if `category` is equal to `check_deposit_return`. A Check Deposit Return is created when a Check Deposit is returned by the bank holding the account it was drawn against. Check Deposits may be returned for a variety of reasons, including insufficient funds or a mismatched account number. Usually, checks are returned within the first 7 days after the deposit is made.
     */
    #[Required('check_deposit_return')]
    public ?CheckDepositReturn $checkDepositReturn;

    /**
     * A Check Transfer Deposit object. This field will be present in the JSON response if and only if `category` is equal to `check_transfer_deposit`. An Inbound Check is a check drawn on an Increase account that has been deposited by an external bank account. These types of checks are not pre-registered.
     */
    #[Required('check_transfer_deposit')]
    public ?CheckTransferDeposit $checkTransferDeposit;

    /**
     * A FedNow Transfer Acknowledgement object. This field will be present in the JSON response if and only if `category` is equal to `fednow_transfer_acknowledgement`. A FedNow Transfer Acknowledgement is created when a FedNow Transfer sent from Increase is acknowledged by the receiving bank.
     */
    #[Required('fednow_transfer_acknowledgement')]
    public ?FednowTransferAcknowledgement $fednowTransferAcknowledgement;

    /**
     * A Fee Payment object. This field will be present in the JSON response if and only if `category` is equal to `fee_payment`. A Fee Payment represents a payment made to Increase.
     */
    #[Required('fee_payment')]
    public ?FeePayment $feePayment;

    /**
     * An Inbound ACH Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `inbound_ach_transfer`. An Inbound ACH Transfer Intention is created when an ACH transfer is initiated at another bank and received by Increase.
     */
    #[Required('inbound_ach_transfer')]
    public ?InboundACHTransfer $inboundACHTransfer;

    /**
     * An Inbound ACH Transfer Return Intention object. This field will be present in the JSON response if and only if `category` is equal to `inbound_ach_transfer_return_intention`. An Inbound ACH Transfer Return Intention is created when an ACH transfer is initiated at another bank and returned by Increase.
     */
    #[Required('inbound_ach_transfer_return_intention')]
    public ?InboundACHTransferReturnIntention $inboundACHTransferReturnIntention;

    /**
     * An Inbound Check Adjustment object. This field will be present in the JSON response if and only if `category` is equal to `inbound_check_adjustment`. An Inbound Check Adjustment is created when Increase receives an adjustment for a check or return deposited through Check21.
     */
    #[Required('inbound_check_adjustment')]
    public ?InboundCheckAdjustment $inboundCheckAdjustment;

    /**
     * An Inbound Check Deposit Return Intention object. This field will be present in the JSON response if and only if `category` is equal to `inbound_check_deposit_return_intention`. An Inbound Check Deposit Return Intention is created when Increase receives an Inbound Check and the User requests that it be returned.
     */
    #[Required('inbound_check_deposit_return_intention')]
    public ?InboundCheckDepositReturnIntention $inboundCheckDepositReturnIntention;

    /**
     * An Inbound FedNow Transfer Confirmation object. This field will be present in the JSON response if and only if `category` is equal to `inbound_fednow_transfer_confirmation`. An Inbound FedNow Transfer Confirmation is created when a FedNow transfer is initiated at another bank and received by Increase.
     */
    #[Required('inbound_fednow_transfer_confirmation')]
    public ?InboundFednowTransferConfirmation $inboundFednowTransferConfirmation;

    /**
     * An Inbound Real-Time Payments Transfer Confirmation object. This field will be present in the JSON response if and only if `category` is equal to `inbound_real_time_payments_transfer_confirmation`. An Inbound Real-Time Payments Transfer Confirmation is created when a Real-Time Payments transfer is initiated at another bank and received by Increase.
     */
    #[Required('inbound_real_time_payments_transfer_confirmation')]
    public ?InboundRealTimePaymentsTransferConfirmation $inboundRealTimePaymentsTransferConfirmation;

    /**
     * An Inbound Wire Reversal object. This field will be present in the JSON response if and only if `category` is equal to `inbound_wire_reversal`. An Inbound Wire Reversal represents a reversal of a wire transfer that was initiated via Increase. The other bank is sending the money back. This most often happens when the original destination account details were incorrect.
     */
    #[Required('inbound_wire_reversal')]
    public ?InboundWireReversal $inboundWireReversal;

    /**
     * An Inbound Wire Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `inbound_wire_transfer`. An Inbound Wire Transfer Intention is created when a wire transfer is initiated at another bank and received by Increase.
     */
    #[Required('inbound_wire_transfer')]
    public ?InboundWireTransfer $inboundWireTransfer;

    /**
     * An Inbound Wire Transfer Reversal Intention object. This field will be present in the JSON response if and only if `category` is equal to `inbound_wire_transfer_reversal`. An Inbound Wire Transfer Reversal Intention is created when Increase has received a wire and the User requests that it be reversed.
     */
    #[Required('inbound_wire_transfer_reversal')]
    public ?InboundWireTransferReversal $inboundWireTransferReversal;

    /**
     * An Interest Payment object. This field will be present in the JSON response if and only if `category` is equal to `interest_payment`. An Interest Payment represents a payment of interest on an account. Interest is usually paid monthly.
     */
    #[Required('interest_payment')]
    public ?InterestPayment $interestPayment;

    /**
     * An Internal Source object. This field will be present in the JSON response if and only if `category` is equal to `internal_source`. A transaction between the user and Increase. See the `reason` attribute for more information.
     */
    #[Required('internal_source')]
    public ?InternalSource $internalSource;

    /**
     * If the category of this Transaction source is equal to `other`, this field will contain an empty object, otherwise it will contain null.
     */
    #[Required]
    public ?Other $other;

    /**
     * A Real-Time Payments Transfer Acknowledgement object. This field will be present in the JSON response if and only if `category` is equal to `real_time_payments_transfer_acknowledgement`. A Real-Time Payments Transfer Acknowledgement is created when a Real-Time Payments Transfer sent from Increase is acknowledged by the receiving bank.
     */
    #[Required('real_time_payments_transfer_acknowledgement')]
    public ?RealTimePaymentsTransferAcknowledgement $realTimePaymentsTransferAcknowledgement;

    /**
     * A Sample Funds object. This field will be present in the JSON response if and only if `category` is equal to `sample_funds`. Sample funds for testing purposes.
     */
    #[Required('sample_funds')]
    public ?SampleFunds $sampleFunds;

    /**
     * A Swift Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `swift_transfer_intention`. A Swift Transfer initiated via Increase.
     */
    #[Required('swift_transfer_intention')]
    public ?SwiftTransferIntention $swiftTransferIntention;

    /**
     * A Swift Transfer Return object. This field will be present in the JSON response if and only if `category` is equal to `swift_transfer_return`. A Swift Transfer Return is created when a Swift Transfer is returned by the receiving bank.
     */
    #[Required('swift_transfer_return')]
    public ?SwiftTransferReturn $swiftTransferReturn;

    /**
     * A Wire Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `wire_transfer_intention`. A Wire Transfer initiated via Increase and sent to a different bank.
     */
    #[Required('wire_transfer_intention')]
    public ?WireTransferIntention $wireTransferIntention;

    /**
     * `new Source()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Source::with(
     *   accountRevenuePayment: ...,
     *   accountTransferIntention: ...,
     *   achTransferIntention: ...,
     *   achTransferRejection: ...,
     *   achTransferReturn: ...,
     *   blockchainOfframpTransferSettlement: ...,
     *   blockchainOnrampTransferIntention: ...,
     *   cardDisputeAcceptance: ...,
     *   cardDisputeFinancial: ...,
     *   cardDisputeLoss: ...,
     *   cardFinancial: ...,
     *   cardPushTransferAcceptance: ...,
     *   cardRefund: ...,
     *   cardRevenuePayment: ...,
     *   cardSettlement: ...,
     *   cashbackPayment: ...,
     *   category: ...,
     *   checkDepositAcceptance: ...,
     *   checkDepositReturn: ...,
     *   checkTransferDeposit: ...,
     *   fednowTransferAcknowledgement: ...,
     *   feePayment: ...,
     *   inboundACHTransfer: ...,
     *   inboundACHTransferReturnIntention: ...,
     *   inboundCheckAdjustment: ...,
     *   inboundCheckDepositReturnIntention: ...,
     *   inboundFednowTransferConfirmation: ...,
     *   inboundRealTimePaymentsTransferConfirmation: ...,
     *   inboundWireReversal: ...,
     *   inboundWireTransfer: ...,
     *   inboundWireTransferReversal: ...,
     *   interestPayment: ...,
     *   internalSource: ...,
     *   other: ...,
     *   realTimePaymentsTransferAcknowledgement: ...,
     *   sampleFunds: ...,
     *   swiftTransferIntention: ...,
     *   swiftTransferReturn: ...,
     *   wireTransferIntention: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Source)
     *   ->withAccountRevenuePayment(...)
     *   ->withAccountTransferIntention(...)
     *   ->withACHTransferIntention(...)
     *   ->withACHTransferRejection(...)
     *   ->withACHTransferReturn(...)
     *   ->withBlockchainOfframpTransferSettlement(...)
     *   ->withBlockchainOnrampTransferIntention(...)
     *   ->withCardDisputeAcceptance(...)
     *   ->withCardDisputeFinancial(...)
     *   ->withCardDisputeLoss(...)
     *   ->withCardFinancial(...)
     *   ->withCardPushTransferAcceptance(...)
     *   ->withCardRefund(...)
     *   ->withCardRevenuePayment(...)
     *   ->withCardSettlement(...)
     *   ->withCashbackPayment(...)
     *   ->withCategory(...)
     *   ->withCheckDepositAcceptance(...)
     *   ->withCheckDepositReturn(...)
     *   ->withCheckTransferDeposit(...)
     *   ->withFednowTransferAcknowledgement(...)
     *   ->withFeePayment(...)
     *   ->withInboundACHTransfer(...)
     *   ->withInboundACHTransferReturnIntention(...)
     *   ->withInboundCheckAdjustment(...)
     *   ->withInboundCheckDepositReturnIntention(...)
     *   ->withInboundFednowTransferConfirmation(...)
     *   ->withInboundRealTimePaymentsTransferConfirmation(...)
     *   ->withInboundWireReversal(...)
     *   ->withInboundWireTransfer(...)
     *   ->withInboundWireTransferReversal(...)
     *   ->withInterestPayment(...)
     *   ->withInternalSource(...)
     *   ->withOther(...)
     *   ->withRealTimePaymentsTransferAcknowledgement(...)
     *   ->withSampleFunds(...)
     *   ->withSwiftTransferIntention(...)
     *   ->withSwiftTransferReturn(...)
     *   ->withWireTransferIntention(...)
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
     * @param AccountRevenuePayment|AccountRevenuePaymentShape|null $accountRevenuePayment
     * @param AccountTransferIntention|AccountTransferIntentionShape|null $accountTransferIntention
     * @param ACHTransferIntention|ACHTransferIntentionShape|null $achTransferIntention
     * @param ACHTransferRejection|ACHTransferRejectionShape|null $achTransferRejection
     * @param ACHTransferReturn|ACHTransferReturnShape|null $achTransferReturn
     * @param BlockchainOfframpTransferSettlement|BlockchainOfframpTransferSettlementShape|null $blockchainOfframpTransferSettlement
     * @param BlockchainOnrampTransferIntention|BlockchainOnrampTransferIntentionShape|null $blockchainOnrampTransferIntention
     * @param CardDisputeAcceptance|CardDisputeAcceptanceShape|null $cardDisputeAcceptance
     * @param CardDisputeFinancial|CardDisputeFinancialShape|null $cardDisputeFinancial
     * @param CardDisputeLoss|CardDisputeLossShape|null $cardDisputeLoss
     * @param CardFinancial|CardFinancialShape|null $cardFinancial
     * @param CardPushTransferAcceptance|CardPushTransferAcceptanceShape|null $cardPushTransferAcceptance
     * @param CardRefund|CardRefundShape|null $cardRefund
     * @param CardRevenuePayment|CardRevenuePaymentShape|null $cardRevenuePayment
     * @param CardSettlement|CardSettlementShape|null $cardSettlement
     * @param CashbackPayment|CashbackPaymentShape|null $cashbackPayment
     * @param Category|value-of<Category> $category
     * @param CheckDepositAcceptance|CheckDepositAcceptanceShape|null $checkDepositAcceptance
     * @param CheckDepositReturn|CheckDepositReturnShape|null $checkDepositReturn
     * @param CheckTransferDeposit|CheckTransferDepositShape|null $checkTransferDeposit
     * @param FednowTransferAcknowledgement|FednowTransferAcknowledgementShape|null $fednowTransferAcknowledgement
     * @param FeePayment|FeePaymentShape|null $feePayment
     * @param InboundACHTransfer|InboundACHTransferShape|null $inboundACHTransfer
     * @param InboundACHTransferReturnIntention|InboundACHTransferReturnIntentionShape|null $inboundACHTransferReturnIntention
     * @param InboundCheckAdjustment|InboundCheckAdjustmentShape|null $inboundCheckAdjustment
     * @param InboundCheckDepositReturnIntention|InboundCheckDepositReturnIntentionShape|null $inboundCheckDepositReturnIntention
     * @param InboundFednowTransferConfirmation|InboundFednowTransferConfirmationShape|null $inboundFednowTransferConfirmation
     * @param InboundRealTimePaymentsTransferConfirmation|InboundRealTimePaymentsTransferConfirmationShape|null $inboundRealTimePaymentsTransferConfirmation
     * @param InboundWireReversal|InboundWireReversalShape|null $inboundWireReversal
     * @param InboundWireTransfer|InboundWireTransferShape|null $inboundWireTransfer
     * @param InboundWireTransferReversal|InboundWireTransferReversalShape|null $inboundWireTransferReversal
     * @param InterestPayment|InterestPaymentShape|null $interestPayment
     * @param InternalSource|InternalSourceShape|null $internalSource
     * @param Other|OtherShape|null $other
     * @param RealTimePaymentsTransferAcknowledgement|RealTimePaymentsTransferAcknowledgementShape|null $realTimePaymentsTransferAcknowledgement
     * @param SampleFunds|SampleFundsShape|null $sampleFunds
     * @param SwiftTransferIntention|SwiftTransferIntentionShape|null $swiftTransferIntention
     * @param SwiftTransferReturn|SwiftTransferReturnShape|null $swiftTransferReturn
     * @param WireTransferIntention|WireTransferIntentionShape|null $wireTransferIntention
     */
    public static function with(
        AccountRevenuePayment|array|null $accountRevenuePayment,
        AccountTransferIntention|array|null $accountTransferIntention,
        ACHTransferIntention|array|null $achTransferIntention,
        ACHTransferRejection|array|null $achTransferRejection,
        ACHTransferReturn|array|null $achTransferReturn,
        BlockchainOfframpTransferSettlement|array|null $blockchainOfframpTransferSettlement,
        BlockchainOnrampTransferIntention|array|null $blockchainOnrampTransferIntention,
        CardDisputeAcceptance|array|null $cardDisputeAcceptance,
        CardDisputeFinancial|array|null $cardDisputeFinancial,
        CardDisputeLoss|array|null $cardDisputeLoss,
        CardFinancial|array|null $cardFinancial,
        CardPushTransferAcceptance|array|null $cardPushTransferAcceptance,
        CardRefund|array|null $cardRefund,
        CardRevenuePayment|array|null $cardRevenuePayment,
        CardSettlement|array|null $cardSettlement,
        CashbackPayment|array|null $cashbackPayment,
        Category|string $category,
        CheckDepositAcceptance|array|null $checkDepositAcceptance,
        CheckDepositReturn|array|null $checkDepositReturn,
        CheckTransferDeposit|array|null $checkTransferDeposit,
        FednowTransferAcknowledgement|array|null $fednowTransferAcknowledgement,
        FeePayment|array|null $feePayment,
        InboundACHTransfer|array|null $inboundACHTransfer,
        InboundACHTransferReturnIntention|array|null $inboundACHTransferReturnIntention,
        InboundCheckAdjustment|array|null $inboundCheckAdjustment,
        InboundCheckDepositReturnIntention|array|null $inboundCheckDepositReturnIntention,
        InboundFednowTransferConfirmation|array|null $inboundFednowTransferConfirmation,
        InboundRealTimePaymentsTransferConfirmation|array|null $inboundRealTimePaymentsTransferConfirmation,
        InboundWireReversal|array|null $inboundWireReversal,
        InboundWireTransfer|array|null $inboundWireTransfer,
        InboundWireTransferReversal|array|null $inboundWireTransferReversal,
        InterestPayment|array|null $interestPayment,
        InternalSource|array|null $internalSource,
        Other|array|null $other,
        RealTimePaymentsTransferAcknowledgement|array|null $realTimePaymentsTransferAcknowledgement,
        SampleFunds|array|null $sampleFunds,
        SwiftTransferIntention|array|null $swiftTransferIntention,
        SwiftTransferReturn|array|null $swiftTransferReturn,
        WireTransferIntention|array|null $wireTransferIntention,
    ): self {
        $self = new self;

        $self['accountRevenuePayment'] = $accountRevenuePayment;
        $self['accountTransferIntention'] = $accountTransferIntention;
        $self['achTransferIntention'] = $achTransferIntention;
        $self['achTransferRejection'] = $achTransferRejection;
        $self['achTransferReturn'] = $achTransferReturn;
        $self['blockchainOfframpTransferSettlement'] = $blockchainOfframpTransferSettlement;
        $self['blockchainOnrampTransferIntention'] = $blockchainOnrampTransferIntention;
        $self['cardDisputeAcceptance'] = $cardDisputeAcceptance;
        $self['cardDisputeFinancial'] = $cardDisputeFinancial;
        $self['cardDisputeLoss'] = $cardDisputeLoss;
        $self['cardFinancial'] = $cardFinancial;
        $self['cardPushTransferAcceptance'] = $cardPushTransferAcceptance;
        $self['cardRefund'] = $cardRefund;
        $self['cardRevenuePayment'] = $cardRevenuePayment;
        $self['cardSettlement'] = $cardSettlement;
        $self['cashbackPayment'] = $cashbackPayment;
        $self['category'] = $category;
        $self['checkDepositAcceptance'] = $checkDepositAcceptance;
        $self['checkDepositReturn'] = $checkDepositReturn;
        $self['checkTransferDeposit'] = $checkTransferDeposit;
        $self['fednowTransferAcknowledgement'] = $fednowTransferAcknowledgement;
        $self['feePayment'] = $feePayment;
        $self['inboundACHTransfer'] = $inboundACHTransfer;
        $self['inboundACHTransferReturnIntention'] = $inboundACHTransferReturnIntention;
        $self['inboundCheckAdjustment'] = $inboundCheckAdjustment;
        $self['inboundCheckDepositReturnIntention'] = $inboundCheckDepositReturnIntention;
        $self['inboundFednowTransferConfirmation'] = $inboundFednowTransferConfirmation;
        $self['inboundRealTimePaymentsTransferConfirmation'] = $inboundRealTimePaymentsTransferConfirmation;
        $self['inboundWireReversal'] = $inboundWireReversal;
        $self['inboundWireTransfer'] = $inboundWireTransfer;
        $self['inboundWireTransferReversal'] = $inboundWireTransferReversal;
        $self['interestPayment'] = $interestPayment;
        $self['internalSource'] = $internalSource;
        $self['other'] = $other;
        $self['realTimePaymentsTransferAcknowledgement'] = $realTimePaymentsTransferAcknowledgement;
        $self['sampleFunds'] = $sampleFunds;
        $self['swiftTransferIntention'] = $swiftTransferIntention;
        $self['swiftTransferReturn'] = $swiftTransferReturn;
        $self['wireTransferIntention'] = $wireTransferIntention;

        return $self;
    }

    /**
     * An Account Revenue Payment object. This field will be present in the JSON response if and only if `category` is equal to `account_revenue_payment`. An Account Revenue Payment represents a payment made to an account from the bank. Account revenue is a type of non-interest income.
     *
     * @param AccountRevenuePayment|AccountRevenuePaymentShape|null $accountRevenuePayment
     */
    public function withAccountRevenuePayment(
        AccountRevenuePayment|array|null $accountRevenuePayment
    ): self {
        $self = clone $this;
        $self['accountRevenuePayment'] = $accountRevenuePayment;

        return $self;
    }

    /**
     * An Account Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `account_transfer_intention`. Two Account Transfer Intentions are created from each Account Transfer. One decrements the source account, and the other increments the destination account.
     *
     * @param AccountTransferIntention|AccountTransferIntentionShape|null $accountTransferIntention
     */
    public function withAccountTransferIntention(
        AccountTransferIntention|array|null $accountTransferIntention
    ): self {
        $self = clone $this;
        $self['accountTransferIntention'] = $accountTransferIntention;

        return $self;
    }

    /**
     * An ACH Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `ach_transfer_intention`. An ACH Transfer Intention is created from an ACH Transfer. It reflects the intention to move money into or out of an Increase account via the ACH network.
     *
     * @param ACHTransferIntention|ACHTransferIntentionShape|null $achTransferIntention
     */
    public function withACHTransferIntention(
        ACHTransferIntention|array|null $achTransferIntention
    ): self {
        $self = clone $this;
        $self['achTransferIntention'] = $achTransferIntention;

        return $self;
    }

    /**
     * An ACH Transfer Rejection object. This field will be present in the JSON response if and only if `category` is equal to `ach_transfer_rejection`. An ACH Transfer Rejection is created when an ACH Transfer is rejected by Increase. It offsets the ACH Transfer Intention. These rejections are rare.
     *
     * @param ACHTransferRejection|ACHTransferRejectionShape|null $achTransferRejection
     */
    public function withACHTransferRejection(
        ACHTransferRejection|array|null $achTransferRejection
    ): self {
        $self = clone $this;
        $self['achTransferRejection'] = $achTransferRejection;

        return $self;
    }

    /**
     * An ACH Transfer Return object. This field will be present in the JSON response if and only if `category` is equal to `ach_transfer_return`. An ACH Transfer Return is created when an ACH Transfer is returned by the receiving bank. It offsets the ACH Transfer Intention. ACH Transfer Returns usually occur within the first two business days after the transfer is initiated, but can occur much later.
     *
     * @param ACHTransferReturn|ACHTransferReturnShape|null $achTransferReturn
     */
    public function withACHTransferReturn(
        ACHTransferReturn|array|null $achTransferReturn
    ): self {
        $self = clone $this;
        $self['achTransferReturn'] = $achTransferReturn;

        return $self;
    }

    /**
     * A Blockchain Off-Ramp Transfer Settlement object. This field will be present in the JSON response if and only if `category` is equal to `blockchain_offramp_transfer_settlement`.
     *
     * @param BlockchainOfframpTransferSettlement|BlockchainOfframpTransferSettlementShape|null $blockchainOfframpTransferSettlement
     */
    public function withBlockchainOfframpTransferSettlement(
        BlockchainOfframpTransferSettlement|array|null $blockchainOfframpTransferSettlement,
    ): self {
        $self = clone $this;
        $self['blockchainOfframpTransferSettlement'] = $blockchainOfframpTransferSettlement;

        return $self;
    }

    /**
     * A Blockchain On-Ramp Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `blockchain_onramp_transfer_intention`.
     *
     * @param BlockchainOnrampTransferIntention|BlockchainOnrampTransferIntentionShape|null $blockchainOnrampTransferIntention
     */
    public function withBlockchainOnrampTransferIntention(
        BlockchainOnrampTransferIntention|array|null $blockchainOnrampTransferIntention,
    ): self {
        $self = clone $this;
        $self['blockchainOnrampTransferIntention'] = $blockchainOnrampTransferIntention;

        return $self;
    }

    /**
     * A Legacy Card Dispute Acceptance object. This field will be present in the JSON response if and only if `category` is equal to `card_dispute_acceptance`. Contains the details of a successful Card Dispute.
     *
     * @param CardDisputeAcceptance|CardDisputeAcceptanceShape|null $cardDisputeAcceptance
     */
    public function withCardDisputeAcceptance(
        CardDisputeAcceptance|array|null $cardDisputeAcceptance
    ): self {
        $self = clone $this;
        $self['cardDisputeAcceptance'] = $cardDisputeAcceptance;

        return $self;
    }

    /**
     * A Card Dispute Financial object. This field will be present in the JSON response if and only if `category` is equal to `card_dispute_financial`. Financial event related to a Card Dispute.
     *
     * @param CardDisputeFinancial|CardDisputeFinancialShape|null $cardDisputeFinancial
     */
    public function withCardDisputeFinancial(
        CardDisputeFinancial|array|null $cardDisputeFinancial
    ): self {
        $self = clone $this;
        $self['cardDisputeFinancial'] = $cardDisputeFinancial;

        return $self;
    }

    /**
     * A Legacy Card Dispute Loss object. This field will be present in the JSON response if and only if `category` is equal to `card_dispute_loss`. Contains the details of a lost Card Dispute.
     *
     * @param CardDisputeLoss|CardDisputeLossShape|null $cardDisputeLoss
     */
    public function withCardDisputeLoss(
        CardDisputeLoss|array|null $cardDisputeLoss
    ): self {
        $self = clone $this;
        $self['cardDisputeLoss'] = $cardDisputeLoss;

        return $self;
    }

    /**
     * A Card Financial object. This field will be present in the JSON response if and only if `category` is equal to `card_financial`. Card Financials are temporary holds placed on a customers funds with the intent to later clear a transaction.
     *
     * @param CardFinancial|CardFinancialShape|null $cardFinancial
     */
    public function withCardFinancial(
        CardFinancial|array|null $cardFinancial
    ): self {
        $self = clone $this;
        $self['cardFinancial'] = $cardFinancial;

        return $self;
    }

    /**
     * A Card Push Transfer Acceptance object. This field will be present in the JSON response if and only if `category` is equal to `card_push_transfer_acceptance`. A Card Push Transfer Acceptance is created when an Outbound Card Push Transfer sent from Increase is accepted by the receiving bank.
     *
     * @param CardPushTransferAcceptance|CardPushTransferAcceptanceShape|null $cardPushTransferAcceptance
     */
    public function withCardPushTransferAcceptance(
        CardPushTransferAcceptance|array|null $cardPushTransferAcceptance
    ): self {
        $self = clone $this;
        $self['cardPushTransferAcceptance'] = $cardPushTransferAcceptance;

        return $self;
    }

    /**
     * A Card Refund object. This field will be present in the JSON response if and only if `category` is equal to `card_refund`. Card Refunds move money back to the cardholder. While they are usually connected to a Card Settlement an acquirer can also refund money directly to a card without relation to a transaction.
     *
     * @param CardRefund|CardRefundShape|null $cardRefund
     */
    public function withCardRefund(CardRefund|array|null $cardRefund): self
    {
        $self = clone $this;
        $self['cardRefund'] = $cardRefund;

        return $self;
    }

    /**
     * A Card Revenue Payment object. This field will be present in the JSON response if and only if `category` is equal to `card_revenue_payment`. Card Revenue Payments reflect earnings from fees on card transactions.
     *
     * @param CardRevenuePayment|CardRevenuePaymentShape|null $cardRevenuePayment
     */
    public function withCardRevenuePayment(
        CardRevenuePayment|array|null $cardRevenuePayment
    ): self {
        $self = clone $this;
        $self['cardRevenuePayment'] = $cardRevenuePayment;

        return $self;
    }

    /**
     * A Card Settlement object. This field will be present in the JSON response if and only if `category` is equal to `card_settlement`. Card Settlements are card transactions that have cleared and settled. While a settlement is usually preceded by an authorization, an acquirer can also directly clear a transaction without first authorizing it.
     *
     * @param CardSettlement|CardSettlementShape|null $cardSettlement
     */
    public function withCardSettlement(
        CardSettlement|array|null $cardSettlement
    ): self {
        $self = clone $this;
        $self['cardSettlement'] = $cardSettlement;

        return $self;
    }

    /**
     * A Cashback Payment object. This field will be present in the JSON response if and only if `category` is equal to `cashback_payment`. A Cashback Payment represents the cashback paid to a cardholder for a given period. Cashback is usually paid monthly for the prior month's transactions.
     *
     * @param CashbackPayment|CashbackPaymentShape|null $cashbackPayment
     */
    public function withCashbackPayment(
        CashbackPayment|array|null $cashbackPayment
    ): self {
        $self = clone $this;
        $self['cashbackPayment'] = $cashbackPayment;

        return $self;
    }

    /**
     * The type of the resource. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * A Check Deposit Acceptance object. This field will be present in the JSON response if and only if `category` is equal to `check_deposit_acceptance`. A Check Deposit Acceptance is created when a Check Deposit is processed and its details confirmed. Check Deposits may be returned by the receiving bank, which will appear as a Check Deposit Return.
     *
     * @param CheckDepositAcceptance|CheckDepositAcceptanceShape|null $checkDepositAcceptance
     */
    public function withCheckDepositAcceptance(
        CheckDepositAcceptance|array|null $checkDepositAcceptance
    ): self {
        $self = clone $this;
        $self['checkDepositAcceptance'] = $checkDepositAcceptance;

        return $self;
    }

    /**
     * A Check Deposit Return object. This field will be present in the JSON response if and only if `category` is equal to `check_deposit_return`. A Check Deposit Return is created when a Check Deposit is returned by the bank holding the account it was drawn against. Check Deposits may be returned for a variety of reasons, including insufficient funds or a mismatched account number. Usually, checks are returned within the first 7 days after the deposit is made.
     *
     * @param CheckDepositReturn|CheckDepositReturnShape|null $checkDepositReturn
     */
    public function withCheckDepositReturn(
        CheckDepositReturn|array|null $checkDepositReturn
    ): self {
        $self = clone $this;
        $self['checkDepositReturn'] = $checkDepositReturn;

        return $self;
    }

    /**
     * A Check Transfer Deposit object. This field will be present in the JSON response if and only if `category` is equal to `check_transfer_deposit`. An Inbound Check is a check drawn on an Increase account that has been deposited by an external bank account. These types of checks are not pre-registered.
     *
     * @param CheckTransferDeposit|CheckTransferDepositShape|null $checkTransferDeposit
     */
    public function withCheckTransferDeposit(
        CheckTransferDeposit|array|null $checkTransferDeposit
    ): self {
        $self = clone $this;
        $self['checkTransferDeposit'] = $checkTransferDeposit;

        return $self;
    }

    /**
     * A FedNow Transfer Acknowledgement object. This field will be present in the JSON response if and only if `category` is equal to `fednow_transfer_acknowledgement`. A FedNow Transfer Acknowledgement is created when a FedNow Transfer sent from Increase is acknowledged by the receiving bank.
     *
     * @param FednowTransferAcknowledgement|FednowTransferAcknowledgementShape|null $fednowTransferAcknowledgement
     */
    public function withFednowTransferAcknowledgement(
        FednowTransferAcknowledgement|array|null $fednowTransferAcknowledgement
    ): self {
        $self = clone $this;
        $self['fednowTransferAcknowledgement'] = $fednowTransferAcknowledgement;

        return $self;
    }

    /**
     * A Fee Payment object. This field will be present in the JSON response if and only if `category` is equal to `fee_payment`. A Fee Payment represents a payment made to Increase.
     *
     * @param FeePayment|FeePaymentShape|null $feePayment
     */
    public function withFeePayment(FeePayment|array|null $feePayment): self
    {
        $self = clone $this;
        $self['feePayment'] = $feePayment;

        return $self;
    }

    /**
     * An Inbound ACH Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `inbound_ach_transfer`. An Inbound ACH Transfer Intention is created when an ACH transfer is initiated at another bank and received by Increase.
     *
     * @param InboundACHTransfer|InboundACHTransferShape|null $inboundACHTransfer
     */
    public function withInboundACHTransfer(
        InboundACHTransfer|array|null $inboundACHTransfer
    ): self {
        $self = clone $this;
        $self['inboundACHTransfer'] = $inboundACHTransfer;

        return $self;
    }

    /**
     * An Inbound ACH Transfer Return Intention object. This field will be present in the JSON response if and only if `category` is equal to `inbound_ach_transfer_return_intention`. An Inbound ACH Transfer Return Intention is created when an ACH transfer is initiated at another bank and returned by Increase.
     *
     * @param InboundACHTransferReturnIntention|InboundACHTransferReturnIntentionShape|null $inboundACHTransferReturnIntention
     */
    public function withInboundACHTransferReturnIntention(
        InboundACHTransferReturnIntention|array|null $inboundACHTransferReturnIntention,
    ): self {
        $self = clone $this;
        $self['inboundACHTransferReturnIntention'] = $inboundACHTransferReturnIntention;

        return $self;
    }

    /**
     * An Inbound Check Adjustment object. This field will be present in the JSON response if and only if `category` is equal to `inbound_check_adjustment`. An Inbound Check Adjustment is created when Increase receives an adjustment for a check or return deposited through Check21.
     *
     * @param InboundCheckAdjustment|InboundCheckAdjustmentShape|null $inboundCheckAdjustment
     */
    public function withInboundCheckAdjustment(
        InboundCheckAdjustment|array|null $inboundCheckAdjustment
    ): self {
        $self = clone $this;
        $self['inboundCheckAdjustment'] = $inboundCheckAdjustment;

        return $self;
    }

    /**
     * An Inbound Check Deposit Return Intention object. This field will be present in the JSON response if and only if `category` is equal to `inbound_check_deposit_return_intention`. An Inbound Check Deposit Return Intention is created when Increase receives an Inbound Check and the User requests that it be returned.
     *
     * @param InboundCheckDepositReturnIntention|InboundCheckDepositReturnIntentionShape|null $inboundCheckDepositReturnIntention
     */
    public function withInboundCheckDepositReturnIntention(
        InboundCheckDepositReturnIntention|array|null $inboundCheckDepositReturnIntention,
    ): self {
        $self = clone $this;
        $self['inboundCheckDepositReturnIntention'] = $inboundCheckDepositReturnIntention;

        return $self;
    }

    /**
     * An Inbound FedNow Transfer Confirmation object. This field will be present in the JSON response if and only if `category` is equal to `inbound_fednow_transfer_confirmation`. An Inbound FedNow Transfer Confirmation is created when a FedNow transfer is initiated at another bank and received by Increase.
     *
     * @param InboundFednowTransferConfirmation|InboundFednowTransferConfirmationShape|null $inboundFednowTransferConfirmation
     */
    public function withInboundFednowTransferConfirmation(
        InboundFednowTransferConfirmation|array|null $inboundFednowTransferConfirmation,
    ): self {
        $self = clone $this;
        $self['inboundFednowTransferConfirmation'] = $inboundFednowTransferConfirmation;

        return $self;
    }

    /**
     * An Inbound Real-Time Payments Transfer Confirmation object. This field will be present in the JSON response if and only if `category` is equal to `inbound_real_time_payments_transfer_confirmation`. An Inbound Real-Time Payments Transfer Confirmation is created when a Real-Time Payments transfer is initiated at another bank and received by Increase.
     *
     * @param InboundRealTimePaymentsTransferConfirmation|InboundRealTimePaymentsTransferConfirmationShape|null $inboundRealTimePaymentsTransferConfirmation
     */
    public function withInboundRealTimePaymentsTransferConfirmation(
        InboundRealTimePaymentsTransferConfirmation|array|null $inboundRealTimePaymentsTransferConfirmation,
    ): self {
        $self = clone $this;
        $self['inboundRealTimePaymentsTransferConfirmation'] = $inboundRealTimePaymentsTransferConfirmation;

        return $self;
    }

    /**
     * An Inbound Wire Reversal object. This field will be present in the JSON response if and only if `category` is equal to `inbound_wire_reversal`. An Inbound Wire Reversal represents a reversal of a wire transfer that was initiated via Increase. The other bank is sending the money back. This most often happens when the original destination account details were incorrect.
     *
     * @param InboundWireReversal|InboundWireReversalShape|null $inboundWireReversal
     */
    public function withInboundWireReversal(
        InboundWireReversal|array|null $inboundWireReversal
    ): self {
        $self = clone $this;
        $self['inboundWireReversal'] = $inboundWireReversal;

        return $self;
    }

    /**
     * An Inbound Wire Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `inbound_wire_transfer`. An Inbound Wire Transfer Intention is created when a wire transfer is initiated at another bank and received by Increase.
     *
     * @param InboundWireTransfer|InboundWireTransferShape|null $inboundWireTransfer
     */
    public function withInboundWireTransfer(
        InboundWireTransfer|array|null $inboundWireTransfer
    ): self {
        $self = clone $this;
        $self['inboundWireTransfer'] = $inboundWireTransfer;

        return $self;
    }

    /**
     * An Inbound Wire Transfer Reversal Intention object. This field will be present in the JSON response if and only if `category` is equal to `inbound_wire_transfer_reversal`. An Inbound Wire Transfer Reversal Intention is created when Increase has received a wire and the User requests that it be reversed.
     *
     * @param InboundWireTransferReversal|InboundWireTransferReversalShape|null $inboundWireTransferReversal
     */
    public function withInboundWireTransferReversal(
        InboundWireTransferReversal|array|null $inboundWireTransferReversal
    ): self {
        $self = clone $this;
        $self['inboundWireTransferReversal'] = $inboundWireTransferReversal;

        return $self;
    }

    /**
     * An Interest Payment object. This field will be present in the JSON response if and only if `category` is equal to `interest_payment`. An Interest Payment represents a payment of interest on an account. Interest is usually paid monthly.
     *
     * @param InterestPayment|InterestPaymentShape|null $interestPayment
     */
    public function withInterestPayment(
        InterestPayment|array|null $interestPayment
    ): self {
        $self = clone $this;
        $self['interestPayment'] = $interestPayment;

        return $self;
    }

    /**
     * An Internal Source object. This field will be present in the JSON response if and only if `category` is equal to `internal_source`. A transaction between the user and Increase. See the `reason` attribute for more information.
     *
     * @param InternalSource|InternalSourceShape|null $internalSource
     */
    public function withInternalSource(
        InternalSource|array|null $internalSource
    ): self {
        $self = clone $this;
        $self['internalSource'] = $internalSource;

        return $self;
    }

    /**
     * If the category of this Transaction source is equal to `other`, this field will contain an empty object, otherwise it will contain null.
     *
     * @param Other|OtherShape|null $other
     */
    public function withOther(Other|array|null $other): self
    {
        $self = clone $this;
        $self['other'] = $other;

        return $self;
    }

    /**
     * A Real-Time Payments Transfer Acknowledgement object. This field will be present in the JSON response if and only if `category` is equal to `real_time_payments_transfer_acknowledgement`. A Real-Time Payments Transfer Acknowledgement is created when a Real-Time Payments Transfer sent from Increase is acknowledged by the receiving bank.
     *
     * @param RealTimePaymentsTransferAcknowledgement|RealTimePaymentsTransferAcknowledgementShape|null $realTimePaymentsTransferAcknowledgement
     */
    public function withRealTimePaymentsTransferAcknowledgement(
        RealTimePaymentsTransferAcknowledgement|array|null $realTimePaymentsTransferAcknowledgement,
    ): self {
        $self = clone $this;
        $self['realTimePaymentsTransferAcknowledgement'] = $realTimePaymentsTransferAcknowledgement;

        return $self;
    }

    /**
     * A Sample Funds object. This field will be present in the JSON response if and only if `category` is equal to `sample_funds`. Sample funds for testing purposes.
     *
     * @param SampleFunds|SampleFundsShape|null $sampleFunds
     */
    public function withSampleFunds(SampleFunds|array|null $sampleFunds): self
    {
        $self = clone $this;
        $self['sampleFunds'] = $sampleFunds;

        return $self;
    }

    /**
     * A Swift Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `swift_transfer_intention`. A Swift Transfer initiated via Increase.
     *
     * @param SwiftTransferIntention|SwiftTransferIntentionShape|null $swiftTransferIntention
     */
    public function withSwiftTransferIntention(
        SwiftTransferIntention|array|null $swiftTransferIntention
    ): self {
        $self = clone $this;
        $self['swiftTransferIntention'] = $swiftTransferIntention;

        return $self;
    }

    /**
     * A Swift Transfer Return object. This field will be present in the JSON response if and only if `category` is equal to `swift_transfer_return`. A Swift Transfer Return is created when a Swift Transfer is returned by the receiving bank.
     *
     * @param SwiftTransferReturn|SwiftTransferReturnShape|null $swiftTransferReturn
     */
    public function withSwiftTransferReturn(
        SwiftTransferReturn|array|null $swiftTransferReturn
    ): self {
        $self = clone $this;
        $self['swiftTransferReturn'] = $swiftTransferReturn;

        return $self;
    }

    /**
     * A Wire Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `wire_transfer_intention`. A Wire Transfer initiated via Increase and sent to a different bank.
     *
     * @param WireTransferIntention|WireTransferIntentionShape|null $wireTransferIntention
     */
    public function withWireTransferIntention(
        WireTransferIntention|array|null $wireTransferIntention
    ): self {
        $self = clone $this;
        $self['wireTransferIntention'] = $wireTransferIntention;

        return $self;
    }
}
