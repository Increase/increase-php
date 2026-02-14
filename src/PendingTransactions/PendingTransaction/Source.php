<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\PendingTransactions\PendingTransaction\Source\AccountTransferInstruction;
use Increase\PendingTransactions\PendingTransaction\Source\ACHTransferInstruction;
use Increase\PendingTransactions\PendingTransaction\Source\BlockchainOfframpTransferInstruction;
use Increase\PendingTransactions\PendingTransaction\Source\BlockchainOnrampTransferInstruction;
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
 * @phpstan-import-type BlockchainOfframpTransferInstructionShape from \Increase\PendingTransactions\PendingTransaction\Source\BlockchainOfframpTransferInstruction
 * @phpstan-import-type BlockchainOnrampTransferInstructionShape from \Increase\PendingTransactions\PendingTransaction\Source\BlockchainOnrampTransferInstruction
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
 *   category: Category|value-of<Category>,
 *   accountTransferInstruction?: null|AccountTransferInstruction|AccountTransferInstructionShape,
 *   achTransferInstruction?: null|ACHTransferInstruction|ACHTransferInstructionShape,
 *   blockchainOfframpTransferInstruction?: null|BlockchainOfframpTransferInstruction|BlockchainOfframpTransferInstructionShape,
 *   blockchainOnrampTransferInstruction?: null|BlockchainOnrampTransferInstruction|BlockchainOnrampTransferInstructionShape,
 *   cardAuthorization?: null|CardAuthorization|CardAuthorizationShape,
 *   cardPushTransferInstruction?: null|CardPushTransferInstruction|CardPushTransferInstructionShape,
 *   checkDepositInstruction?: null|CheckDepositInstruction|CheckDepositInstructionShape,
 *   checkTransferInstruction?: null|CheckTransferInstruction|CheckTransferInstructionShape,
 *   fednowTransferInstruction?: null|FednowTransferInstruction|FednowTransferInstructionShape,
 *   inboundFundsHold?: null|InboundFundsHold|InboundFundsHoldShape,
 *   inboundWireTransferReversal?: null|InboundWireTransferReversal|InboundWireTransferReversalShape,
 *   other?: null|Other|OtherShape,
 *   realTimePaymentsTransferInstruction?: null|RealTimePaymentsTransferInstruction|RealTimePaymentsTransferInstructionShape,
 *   swiftTransferInstruction?: null|SwiftTransferInstruction|SwiftTransferInstructionShape,
 *   userInitiatedHold?: array<string,mixed>|null,
 *   wireTransferInstruction?: null|WireTransferInstruction|WireTransferInstructionShape,
 * }
 */
final class Source implements BaseModel
{
    /** @use SdkModel<SourceShape> */
    use SdkModel;

    /**
     * The type of the resource. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * An Account Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `account_transfer_instruction`.
     */
    #[Optional('account_transfer_instruction', nullable: true)]
    public ?AccountTransferInstruction $accountTransferInstruction;

    /**
     * An ACH Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `ach_transfer_instruction`.
     */
    #[Optional('ach_transfer_instruction', nullable: true)]
    public ?ACHTransferInstruction $achTransferInstruction;

    /**
     * A Blockchain Off-Ramp Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `blockchain_offramp_transfer_instruction`.
     */
    #[Optional('blockchain_offramp_transfer_instruction', nullable: true)]
    public ?BlockchainOfframpTransferInstruction $blockchainOfframpTransferInstruction;

    /**
     * A Blockchain On-Ramp Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `blockchain_onramp_transfer_instruction`.
     */
    #[Optional('blockchain_onramp_transfer_instruction', nullable: true)]
    public ?BlockchainOnrampTransferInstruction $blockchainOnrampTransferInstruction;

    /**
     * A Card Authorization object. This field will be present in the JSON response if and only if `category` is equal to `card_authorization`. Card Authorizations are temporary holds placed on a customer's funds with the intent to later clear a transaction.
     */
    #[Optional('card_authorization', nullable: true)]
    public ?CardAuthorization $cardAuthorization;

    /**
     * A Card Push Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `card_push_transfer_instruction`.
     */
    #[Optional('card_push_transfer_instruction', nullable: true)]
    public ?CardPushTransferInstruction $cardPushTransferInstruction;

    /**
     * A Check Deposit Instruction object. This field will be present in the JSON response if and only if `category` is equal to `check_deposit_instruction`.
     */
    #[Optional('check_deposit_instruction', nullable: true)]
    public ?CheckDepositInstruction $checkDepositInstruction;

    /**
     * A Check Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `check_transfer_instruction`.
     */
    #[Optional('check_transfer_instruction', nullable: true)]
    public ?CheckTransferInstruction $checkTransferInstruction;

    /**
     * A FedNow Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `fednow_transfer_instruction`.
     */
    #[Optional('fednow_transfer_instruction', nullable: true)]
    public ?FednowTransferInstruction $fednowTransferInstruction;

    /**
     * An Inbound Funds Hold object. This field will be present in the JSON response if and only if `category` is equal to `inbound_funds_hold`. We hold funds for certain transaction types to account for return windows where funds might still be clawed back by the sending institution.
     */
    #[Optional('inbound_funds_hold', nullable: true)]
    public ?InboundFundsHold $inboundFundsHold;

    /**
     * An Inbound Wire Transfer Reversal object. This field will be present in the JSON response if and only if `category` is equal to `inbound_wire_transfer_reversal`. An Inbound Wire Transfer Reversal is created when Increase has received a wire and the User requests that it be reversed.
     */
    #[Optional('inbound_wire_transfer_reversal', nullable: true)]
    public ?InboundWireTransferReversal $inboundWireTransferReversal;

    /**
     * If the category of this Transaction source is equal to `other`, this field will contain an empty object, otherwise it will contain null.
     */
    #[Optional(nullable: true)]
    public ?Other $other;

    /**
     * A Real-Time Payments Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `real_time_payments_transfer_instruction`.
     */
    #[Optional('real_time_payments_transfer_instruction', nullable: true)]
    public ?RealTimePaymentsTransferInstruction $realTimePaymentsTransferInstruction;

    /**
     * A Swift Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `swift_transfer_instruction`.
     */
    #[Optional('swift_transfer_instruction', nullable: true)]
    public ?SwiftTransferInstruction $swiftTransferInstruction;

    /**
     * An User Initiated Hold object. This field will be present in the JSON response if and only if `category` is equal to `user_initiated_hold`. Created when a user initiates a hold on funds in their account.
     *
     * @var array<string,mixed>|null $userInitiatedHold
     */
    #[Optional('user_initiated_hold', map: 'mixed', nullable: true)]
    public ?array $userInitiatedHold;

    /**
     * A Wire Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `wire_transfer_instruction`.
     */
    #[Optional('wire_transfer_instruction', nullable: true)]
    public ?WireTransferInstruction $wireTransferInstruction;

    /**
     * `new Source()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Source::with(category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Source)->withCategory(...)
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
     * @param Category|value-of<Category> $category
     * @param AccountTransferInstruction|AccountTransferInstructionShape|null $accountTransferInstruction
     * @param ACHTransferInstruction|ACHTransferInstructionShape|null $achTransferInstruction
     * @param BlockchainOfframpTransferInstruction|BlockchainOfframpTransferInstructionShape|null $blockchainOfframpTransferInstruction
     * @param BlockchainOnrampTransferInstruction|BlockchainOnrampTransferInstructionShape|null $blockchainOnrampTransferInstruction
     * @param CardAuthorization|CardAuthorizationShape|null $cardAuthorization
     * @param CardPushTransferInstruction|CardPushTransferInstructionShape|null $cardPushTransferInstruction
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
        Category|string $category,
        AccountTransferInstruction|array|null $accountTransferInstruction = null,
        ACHTransferInstruction|array|null $achTransferInstruction = null,
        BlockchainOfframpTransferInstruction|array|null $blockchainOfframpTransferInstruction = null,
        BlockchainOnrampTransferInstruction|array|null $blockchainOnrampTransferInstruction = null,
        CardAuthorization|array|null $cardAuthorization = null,
        CardPushTransferInstruction|array|null $cardPushTransferInstruction = null,
        CheckDepositInstruction|array|null $checkDepositInstruction = null,
        CheckTransferInstruction|array|null $checkTransferInstruction = null,
        FednowTransferInstruction|array|null $fednowTransferInstruction = null,
        InboundFundsHold|array|null $inboundFundsHold = null,
        InboundWireTransferReversal|array|null $inboundWireTransferReversal = null,
        Other|array|null $other = null,
        RealTimePaymentsTransferInstruction|array|null $realTimePaymentsTransferInstruction = null,
        SwiftTransferInstruction|array|null $swiftTransferInstruction = null,
        ?array $userInitiatedHold = null,
        WireTransferInstruction|array|null $wireTransferInstruction = null,
    ): self {
        $self = new self;

        $self['category'] = $category;

        null !== $accountTransferInstruction && $self['accountTransferInstruction'] = $accountTransferInstruction;
        null !== $achTransferInstruction && $self['achTransferInstruction'] = $achTransferInstruction;
        null !== $blockchainOfframpTransferInstruction && $self['blockchainOfframpTransferInstruction'] = $blockchainOfframpTransferInstruction;
        null !== $blockchainOnrampTransferInstruction && $self['blockchainOnrampTransferInstruction'] = $blockchainOnrampTransferInstruction;
        null !== $cardAuthorization && $self['cardAuthorization'] = $cardAuthorization;
        null !== $cardPushTransferInstruction && $self['cardPushTransferInstruction'] = $cardPushTransferInstruction;
        null !== $checkDepositInstruction && $self['checkDepositInstruction'] = $checkDepositInstruction;
        null !== $checkTransferInstruction && $self['checkTransferInstruction'] = $checkTransferInstruction;
        null !== $fednowTransferInstruction && $self['fednowTransferInstruction'] = $fednowTransferInstruction;
        null !== $inboundFundsHold && $self['inboundFundsHold'] = $inboundFundsHold;
        null !== $inboundWireTransferReversal && $self['inboundWireTransferReversal'] = $inboundWireTransferReversal;
        null !== $other && $self['other'] = $other;
        null !== $realTimePaymentsTransferInstruction && $self['realTimePaymentsTransferInstruction'] = $realTimePaymentsTransferInstruction;
        null !== $swiftTransferInstruction && $self['swiftTransferInstruction'] = $swiftTransferInstruction;
        null !== $userInitiatedHold && $self['userInitiatedHold'] = $userInitiatedHold;
        null !== $wireTransferInstruction && $self['wireTransferInstruction'] = $wireTransferInstruction;

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
     * A Blockchain Off-Ramp Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `blockchain_offramp_transfer_instruction`.
     *
     * @param BlockchainOfframpTransferInstruction|BlockchainOfframpTransferInstructionShape|null $blockchainOfframpTransferInstruction
     */
    public function withBlockchainOfframpTransferInstruction(
        BlockchainOfframpTransferInstruction|array|null $blockchainOfframpTransferInstruction,
    ): self {
        $self = clone $this;
        $self['blockchainOfframpTransferInstruction'] = $blockchainOfframpTransferInstruction;

        return $self;
    }

    /**
     * A Blockchain On-Ramp Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `blockchain_onramp_transfer_instruction`.
     *
     * @param BlockchainOnrampTransferInstruction|BlockchainOnrampTransferInstructionShape|null $blockchainOnrampTransferInstruction
     */
    public function withBlockchainOnrampTransferInstruction(
        BlockchainOnrampTransferInstruction|array|null $blockchainOnrampTransferInstruction,
    ): self {
        $self = clone $this;
        $self['blockchainOnrampTransferInstruction'] = $blockchainOnrampTransferInstruction;

        return $self;
    }

    /**
     * A Card Authorization object. This field will be present in the JSON response if and only if `category` is equal to `card_authorization`. Card Authorizations are temporary holds placed on a customer's funds with the intent to later clear a transaction.
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
