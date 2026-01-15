<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\PendingTransactions\PendingTransaction\Source\AccountTransferInstruction;
use Increase\PendingTransactions\PendingTransaction\Source\ACHTransferInstruction;
use Increase\PendingTransactions\PendingTransaction\Source\CardAuthorization;
use Increase\PendingTransactions\PendingTransaction\Source\CardPushTransferInstruction;
use Increase\PendingTransactions\PendingTransaction\Source\Category;
use Increase\PendingTransactions\PendingTransaction\Source\CheckDepositInstruction;
use Increase\PendingTransactions\PendingTransaction\Source\CheckTransferInstruction;
use Increase\PendingTransactions\PendingTransaction\Source\FednowTransferInstruction;
use Increase\PendingTransactions\PendingTransaction\Source\InboundFundsHold;
use Increase\PendingTransactions\PendingTransaction\Source\InboundWireTransferReversal;
use Increase\PendingTransactions\PendingTransaction\Source\Other;
use Increase\PendingTransactions\PendingTransaction\Source\RealTimePaymentsTransferInstruction;
use Increase\PendingTransactions\PendingTransaction\Source\SwiftTransferInstruction;
use Increase\PendingTransactions\PendingTransaction\Source\WireTransferInstruction;

/**
 * This is an object giving more details on the network-level event that caused the Pending Transaction. For example, for a card transaction this lists the merchant's industry and location.
 *
 * @phpstan-import-type AccountTransferInstructionShape from \Increase\PendingTransactions\PendingTransaction\Source\AccountTransferInstruction
 * @phpstan-import-type ACHTransferInstructionShape from \Increase\PendingTransactions\PendingTransaction\Source\ACHTransferInstruction
 * @phpstan-import-type CardAuthorizationShape from \Increase\PendingTransactions\PendingTransaction\Source\CardAuthorization
 * @phpstan-import-type CardPushTransferInstructionShape from \Increase\PendingTransactions\PendingTransaction\Source\CardPushTransferInstruction
 * @phpstan-import-type CheckDepositInstructionShape from \Increase\PendingTransactions\PendingTransaction\Source\CheckDepositInstruction
 * @phpstan-import-type CheckTransferInstructionShape from \Increase\PendingTransactions\PendingTransaction\Source\CheckTransferInstruction
 * @phpstan-import-type FednowTransferInstructionShape from \Increase\PendingTransactions\PendingTransaction\Source\FednowTransferInstruction
 * @phpstan-import-type InboundFundsHoldShape from \Increase\PendingTransactions\PendingTransaction\Source\InboundFundsHold
 * @phpstan-import-type InboundWireTransferReversalShape from \Increase\PendingTransactions\PendingTransaction\Source\InboundWireTransferReversal
 * @phpstan-import-type OtherShape from \Increase\PendingTransactions\PendingTransaction\Source\Other
 * @phpstan-import-type RealTimePaymentsTransferInstructionShape from \Increase\PendingTransactions\PendingTransaction\Source\RealTimePaymentsTransferInstruction
 * @phpstan-import-type SwiftTransferInstructionShape from \Increase\PendingTransactions\PendingTransaction\Source\SwiftTransferInstruction
 * @phpstan-import-type WireTransferInstructionShape from \Increase\PendingTransactions\PendingTransaction\Source\WireTransferInstruction
 *
 * @phpstan-type SourceShape = array{
 *   accountTransferInstruction: null|AccountTransferInstruction|AccountTransferInstructionShape,
 *   achTransferInstruction: null|ACHTransferInstruction|ACHTransferInstructionShape,
 *   cardAuthorization: null|CardAuthorization|CardAuthorizationShape,
 *   cardPushTransferInstruction: null|CardPushTransferInstruction|CardPushTransferInstructionShape,
 *   category: Category|value-of<Category>,
 *   checkDepositInstruction: null|CheckDepositInstruction|CheckDepositInstructionShape,
 *   checkTransferInstruction: null|CheckTransferInstruction|CheckTransferInstructionShape,
 *   fednowTransferInstruction: null|FednowTransferInstruction|FednowTransferInstructionShape,
 *   inboundFundsHold: null|InboundFundsHold|InboundFundsHoldShape,
 *   inboundWireTransferReversal: null|InboundWireTransferReversal|InboundWireTransferReversalShape,
 *   other: null|Other|OtherShape,
 *   realTimePaymentsTransferInstruction: null|RealTimePaymentsTransferInstruction|RealTimePaymentsTransferInstructionShape,
 *   swiftTransferInstruction: null|SwiftTransferInstruction|SwiftTransferInstructionShape,
 *   userInitiatedHold: array<string,mixed>|null,
 *   wireTransferInstruction: null|WireTransferInstruction|WireTransferInstructionShape,
 * }
 */
final class Source implements BaseModel
{
    /** @use SdkModel<SourceShape> */
    use SdkModel;

    /**
     * An Account Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `account_transfer_instruction`.
     */
    #[Required('account_transfer_instruction')]
    public ?AccountTransferInstruction $accountTransferInstruction;

    /**
     * An ACH Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `ach_transfer_instruction`.
     */
    #[Required('ach_transfer_instruction')]
    public ?ACHTransferInstruction $achTransferInstruction;

    /**
     * A Card Authorization object. This field will be present in the JSON response if and only if `category` is equal to `card_authorization`. Card Authorizations are temporary holds placed on a customers funds with the intent to later clear a transaction.
     */
    #[Required('card_authorization')]
    public ?CardAuthorization $cardAuthorization;

    /**
     * A Card Push Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `card_push_transfer_instruction`.
     */
    #[Required('card_push_transfer_instruction')]
    public ?CardPushTransferInstruction $cardPushTransferInstruction;

    /**
     * The type of the resource. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * A Check Deposit Instruction object. This field will be present in the JSON response if and only if `category` is equal to `check_deposit_instruction`.
     */
    #[Required('check_deposit_instruction')]
    public ?CheckDepositInstruction $checkDepositInstruction;

    /**
     * A Check Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `check_transfer_instruction`.
     */
    #[Required('check_transfer_instruction')]
    public ?CheckTransferInstruction $checkTransferInstruction;

    /**
     * A FedNow Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `fednow_transfer_instruction`.
     */
    #[Required('fednow_transfer_instruction')]
    public ?FednowTransferInstruction $fednowTransferInstruction;

    /**
     * An Inbound Funds Hold object. This field will be present in the JSON response if and only if `category` is equal to `inbound_funds_hold`. We hold funds for certain transaction types to account for return windows where funds might still be clawed back by the sending institution.
     */
    #[Required('inbound_funds_hold')]
    public ?InboundFundsHold $inboundFundsHold;

    /**
     * An Inbound Wire Transfer Reversal object. This field will be present in the JSON response if and only if `category` is equal to `inbound_wire_transfer_reversal`. An Inbound Wire Transfer Reversal is created when Increase has received a wire and the User requests that it be reversed.
     */
    #[Required('inbound_wire_transfer_reversal')]
    public ?InboundWireTransferReversal $inboundWireTransferReversal;

    /**
     * If the category of this Transaction source is equal to `other`, this field will contain an empty object, otherwise it will contain null.
     */
    #[Required]
    public ?Other $other;

    /**
     * A Real-Time Payments Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `real_time_payments_transfer_instruction`.
     */
    #[Required('real_time_payments_transfer_instruction')]
    public ?RealTimePaymentsTransferInstruction $realTimePaymentsTransferInstruction;

    /**
     * A Swift Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `swift_transfer_instruction`.
     */
    #[Required('swift_transfer_instruction')]
    public ?SwiftTransferInstruction $swiftTransferInstruction;

    /**
     * An User Initiated Hold object. This field will be present in the JSON response if and only if `category` is equal to `user_initiated_hold`. Created when a user initiates a hold on funds in their account.
     *
     * @var array<string,mixed>|null $userInitiatedHold
     */
    #[Required('user_initiated_hold', map: 'mixed')]
    public ?array $userInitiatedHold;

    /**
     * A Wire Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `wire_transfer_instruction`.
     */
    #[Required('wire_transfer_instruction')]
    public ?WireTransferInstruction $wireTransferInstruction;

    /**
     * `new Source()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Source::with(
     *   accountTransferInstruction: ...,
     *   achTransferInstruction: ...,
     *   cardAuthorization: ...,
     *   cardPushTransferInstruction: ...,
     *   category: ...,
     *   checkDepositInstruction: ...,
     *   checkTransferInstruction: ...,
     *   fednowTransferInstruction: ...,
     *   inboundFundsHold: ...,
     *   inboundWireTransferReversal: ...,
     *   other: ...,
     *   realTimePaymentsTransferInstruction: ...,
     *   swiftTransferInstruction: ...,
     *   userInitiatedHold: ...,
     *   wireTransferInstruction: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Source)
     *   ->withAccountTransferInstruction(...)
     *   ->withACHTransferInstruction(...)
     *   ->withCardAuthorization(...)
     *   ->withCardPushTransferInstruction(...)
     *   ->withCategory(...)
     *   ->withCheckDepositInstruction(...)
     *   ->withCheckTransferInstruction(...)
     *   ->withFednowTransferInstruction(...)
     *   ->withInboundFundsHold(...)
     *   ->withInboundWireTransferReversal(...)
     *   ->withOther(...)
     *   ->withRealTimePaymentsTransferInstruction(...)
     *   ->withSwiftTransferInstruction(...)
     *   ->withUserInitiatedHold(...)
     *   ->withWireTransferInstruction(...)
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
     * @param AccountTransferInstruction|AccountTransferInstructionShape|null $accountTransferInstruction
     * @param ACHTransferInstruction|ACHTransferInstructionShape|null $achTransferInstruction
     * @param CardAuthorization|CardAuthorizationShape|null $cardAuthorization
     * @param CardPushTransferInstruction|CardPushTransferInstructionShape|null $cardPushTransferInstruction
     * @param Category|value-of<Category> $category
     * @param CheckDepositInstruction|CheckDepositInstructionShape|null $checkDepositInstruction
     * @param CheckTransferInstruction|CheckTransferInstructionShape|null $checkTransferInstruction
     * @param FednowTransferInstruction|FednowTransferInstructionShape|null $fednowTransferInstruction
     * @param InboundFundsHold|InboundFundsHoldShape|null $inboundFundsHold
     * @param InboundWireTransferReversal|InboundWireTransferReversalShape|null $inboundWireTransferReversal
     * @param Other|OtherShape|null $other
     * @param RealTimePaymentsTransferInstruction|RealTimePaymentsTransferInstructionShape|null $realTimePaymentsTransferInstruction
     * @param SwiftTransferInstruction|SwiftTransferInstructionShape|null $swiftTransferInstruction
     * @param array<string,mixed>|null $userInitiatedHold
     * @param WireTransferInstruction|WireTransferInstructionShape|null $wireTransferInstruction
     */
    public static function with(
        AccountTransferInstruction|array|null $accountTransferInstruction,
        ACHTransferInstruction|array|null $achTransferInstruction,
        CardAuthorization|array|null $cardAuthorization,
        CardPushTransferInstruction|array|null $cardPushTransferInstruction,
        Category|string $category,
        CheckDepositInstruction|array|null $checkDepositInstruction,
        CheckTransferInstruction|array|null $checkTransferInstruction,
        FednowTransferInstruction|array|null $fednowTransferInstruction,
        InboundFundsHold|array|null $inboundFundsHold,
        InboundWireTransferReversal|array|null $inboundWireTransferReversal,
        Other|array|null $other,
        RealTimePaymentsTransferInstruction|array|null $realTimePaymentsTransferInstruction,
        SwiftTransferInstruction|array|null $swiftTransferInstruction,
        ?array $userInitiatedHold,
        WireTransferInstruction|array|null $wireTransferInstruction,
    ): self {
        $self = new self;

        $self['accountTransferInstruction'] = $accountTransferInstruction;
        $self['achTransferInstruction'] = $achTransferInstruction;
        $self['cardAuthorization'] = $cardAuthorization;
        $self['cardPushTransferInstruction'] = $cardPushTransferInstruction;
        $self['category'] = $category;
        $self['checkDepositInstruction'] = $checkDepositInstruction;
        $self['checkTransferInstruction'] = $checkTransferInstruction;
        $self['fednowTransferInstruction'] = $fednowTransferInstruction;
        $self['inboundFundsHold'] = $inboundFundsHold;
        $self['inboundWireTransferReversal'] = $inboundWireTransferReversal;
        $self['other'] = $other;
        $self['realTimePaymentsTransferInstruction'] = $realTimePaymentsTransferInstruction;
        $self['swiftTransferInstruction'] = $swiftTransferInstruction;
        $self['userInitiatedHold'] = $userInitiatedHold;
        $self['wireTransferInstruction'] = $wireTransferInstruction;

        return $self;
    }

    /**
     * An Account Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `account_transfer_instruction`.
     *
     * @param AccountTransferInstruction|AccountTransferInstructionShape|null $accountTransferInstruction
     */
    public function withAccountTransferInstruction(
        AccountTransferInstruction|array|null $accountTransferInstruction
    ): self {
        $self = clone $this;
        $self['accountTransferInstruction'] = $accountTransferInstruction;

        return $self;
    }

    /**
     * An ACH Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `ach_transfer_instruction`.
     *
     * @param ACHTransferInstruction|ACHTransferInstructionShape|null $achTransferInstruction
     */
    public function withACHTransferInstruction(
        ACHTransferInstruction|array|null $achTransferInstruction
    ): self {
        $self = clone $this;
        $self['achTransferInstruction'] = $achTransferInstruction;

        return $self;
    }

    /**
     * A Card Authorization object. This field will be present in the JSON response if and only if `category` is equal to `card_authorization`. Card Authorizations are temporary holds placed on a customers funds with the intent to later clear a transaction.
     *
     * @param CardAuthorization|CardAuthorizationShape|null $cardAuthorization
     */
    public function withCardAuthorization(
        CardAuthorization|array|null $cardAuthorization
    ): self {
        $self = clone $this;
        $self['cardAuthorization'] = $cardAuthorization;

        return $self;
    }

    /**
     * A Card Push Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `card_push_transfer_instruction`.
     *
     * @param CardPushTransferInstruction|CardPushTransferInstructionShape|null $cardPushTransferInstruction
     */
    public function withCardPushTransferInstruction(
        CardPushTransferInstruction|array|null $cardPushTransferInstruction
    ): self {
        $self = clone $this;
        $self['cardPushTransferInstruction'] = $cardPushTransferInstruction;

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
     * A Check Deposit Instruction object. This field will be present in the JSON response if and only if `category` is equal to `check_deposit_instruction`.
     *
     * @param CheckDepositInstruction|CheckDepositInstructionShape|null $checkDepositInstruction
     */
    public function withCheckDepositInstruction(
        CheckDepositInstruction|array|null $checkDepositInstruction
    ): self {
        $self = clone $this;
        $self['checkDepositInstruction'] = $checkDepositInstruction;

        return $self;
    }

    /**
     * A Check Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `check_transfer_instruction`.
     *
     * @param CheckTransferInstruction|CheckTransferInstructionShape|null $checkTransferInstruction
     */
    public function withCheckTransferInstruction(
        CheckTransferInstruction|array|null $checkTransferInstruction
    ): self {
        $self = clone $this;
        $self['checkTransferInstruction'] = $checkTransferInstruction;

        return $self;
    }

    /**
     * A FedNow Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `fednow_transfer_instruction`.
     *
     * @param FednowTransferInstruction|FednowTransferInstructionShape|null $fednowTransferInstruction
     */
    public function withFednowTransferInstruction(
        FednowTransferInstruction|array|null $fednowTransferInstruction
    ): self {
        $self = clone $this;
        $self['fednowTransferInstruction'] = $fednowTransferInstruction;

        return $self;
    }

    /**
     * An Inbound Funds Hold object. This field will be present in the JSON response if and only if `category` is equal to `inbound_funds_hold`. We hold funds for certain transaction types to account for return windows where funds might still be clawed back by the sending institution.
     *
     * @param InboundFundsHold|InboundFundsHoldShape|null $inboundFundsHold
     */
    public function withInboundFundsHold(
        InboundFundsHold|array|null $inboundFundsHold
    ): self {
        $self = clone $this;
        $self['inboundFundsHold'] = $inboundFundsHold;

        return $self;
    }

    /**
     * An Inbound Wire Transfer Reversal object. This field will be present in the JSON response if and only if `category` is equal to `inbound_wire_transfer_reversal`. An Inbound Wire Transfer Reversal is created when Increase has received a wire and the User requests that it be reversed.
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
     * A Real-Time Payments Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `real_time_payments_transfer_instruction`.
     *
     * @param RealTimePaymentsTransferInstruction|RealTimePaymentsTransferInstructionShape|null $realTimePaymentsTransferInstruction
     */
    public function withRealTimePaymentsTransferInstruction(
        RealTimePaymentsTransferInstruction|array|null $realTimePaymentsTransferInstruction,
    ): self {
        $self = clone $this;
        $self['realTimePaymentsTransferInstruction'] = $realTimePaymentsTransferInstruction;

        return $self;
    }

    /**
     * A Swift Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `swift_transfer_instruction`.
     *
     * @param SwiftTransferInstruction|SwiftTransferInstructionShape|null $swiftTransferInstruction
     */
    public function withSwiftTransferInstruction(
        SwiftTransferInstruction|array|null $swiftTransferInstruction
    ): self {
        $self = clone $this;
        $self['swiftTransferInstruction'] = $swiftTransferInstruction;

        return $self;
    }

    /**
     * An User Initiated Hold object. This field will be present in the JSON response if and only if `category` is equal to `user_initiated_hold`. Created when a user initiates a hold on funds in their account.
     *
     * @param array<string,mixed>|null $userInitiatedHold
     */
    public function withUserInitiatedHold(?array $userInitiatedHold): self
    {
        $self = clone $this;
        $self['userInitiatedHold'] = $userInitiatedHold;

        return $self;
    }

    /**
     * A Wire Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `wire_transfer_instruction`.
     *
     * @param WireTransferInstruction|WireTransferInstructionShape|null $wireTransferInstruction
     */
    public function withWireTransferInstruction(
        WireTransferInstruction|array|null $wireTransferInstruction
    ): self {
        $self = clone $this;
        $self['wireTransferInstruction'] = $wireTransferInstruction;

        return $self;
    }
}
