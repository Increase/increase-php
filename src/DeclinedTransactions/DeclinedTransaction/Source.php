<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\ACHDecline;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\Category;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\CheckDecline;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\CheckDepositRejection;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\InboundFednowTransferDecline;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\InboundRealTimePaymentsTransferDecline;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\Other;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\WireDecline;

/**
 * This is an object giving more details on the network-level event that caused the Declined Transaction. For example, for a card transaction this lists the merchant's industry and location. Note that for backwards compatibility reasons, additional undocumented keys may appear in this object. These should be treated as deprecated and will be removed in the future.
 *
 * @phpstan-import-type ACHDeclineShape from \Increase\DeclinedTransactions\DeclinedTransaction\Source\ACHDecline
 * @phpstan-import-type CardDeclineShape from \Increase\DeclinedTransactions\DeclinedTransaction\Source\CardDecline
 * @phpstan-import-type CheckDeclineShape from \Increase\DeclinedTransactions\DeclinedTransaction\Source\CheckDecline
 * @phpstan-import-type CheckDepositRejectionShape from \Increase\DeclinedTransactions\DeclinedTransaction\Source\CheckDepositRejection
 * @phpstan-import-type InboundFednowTransferDeclineShape from \Increase\DeclinedTransactions\DeclinedTransaction\Source\InboundFednowTransferDecline
 * @phpstan-import-type InboundRealTimePaymentsTransferDeclineShape from \Increase\DeclinedTransactions\DeclinedTransaction\Source\InboundRealTimePaymentsTransferDecline
 * @phpstan-import-type OtherShape from \Increase\DeclinedTransactions\DeclinedTransaction\Source\Other
 * @phpstan-import-type WireDeclineShape from \Increase\DeclinedTransactions\DeclinedTransaction\Source\WireDecline
 *
 * @phpstan-type SourceShape = array{
 *   achDecline: null|ACHDecline|ACHDeclineShape,
 *   cardDecline: null|CardDecline|CardDeclineShape,
 *   category: Category|value-of<Category>,
 *   checkDecline: null|CheckDecline|CheckDeclineShape,
 *   checkDepositRejection: null|CheckDepositRejection|CheckDepositRejectionShape,
 *   inboundFednowTransferDecline: null|InboundFednowTransferDecline|InboundFednowTransferDeclineShape,
 *   inboundRealTimePaymentsTransferDecline: null|InboundRealTimePaymentsTransferDecline|InboundRealTimePaymentsTransferDeclineShape,
 *   other: null|Other|OtherShape,
 *   wireDecline: null|WireDecline|WireDeclineShape,
 * }
 */
final class Source implements BaseModel
{
    /** @use SdkModel<SourceShape> */
    use SdkModel;

    /**
     * An ACH Decline object. This field will be present in the JSON response if and only if `category` is equal to `ach_decline`.
     */
    #[Required('ach_decline')]
    public ?ACHDecline $achDecline;

    /**
     * A Card Decline object. This field will be present in the JSON response if and only if `category` is equal to `card_decline`.
     */
    #[Required('card_decline')]
    public ?CardDecline $cardDecline;

    /**
     * The type of the resource. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * A Check Decline object. This field will be present in the JSON response if and only if `category` is equal to `check_decline`.
     */
    #[Required('check_decline')]
    public ?CheckDecline $checkDecline;

    /**
     * A Check Deposit Rejection object. This field will be present in the JSON response if and only if `category` is equal to `check_deposit_rejection`.
     */
    #[Required('check_deposit_rejection')]
    public ?CheckDepositRejection $checkDepositRejection;

    /**
     * An Inbound FedNow Transfer Decline object. This field will be present in the JSON response if and only if `category` is equal to `inbound_fednow_transfer_decline`.
     */
    #[Required('inbound_fednow_transfer_decline')]
    public ?InboundFednowTransferDecline $inboundFednowTransferDecline;

    /**
     * An Inbound Real-Time Payments Transfer Decline object. This field will be present in the JSON response if and only if `category` is equal to `inbound_real_time_payments_transfer_decline`.
     */
    #[Required('inbound_real_time_payments_transfer_decline')]
    public ?InboundRealTimePaymentsTransferDecline $inboundRealTimePaymentsTransferDecline;

    /**
     * If the category of this Transaction source is equal to `other`, this field will contain an empty object, otherwise it will contain null.
     */
    #[Required]
    public ?Other $other;

    /**
     * A Wire Decline object. This field will be present in the JSON response if and only if `category` is equal to `wire_decline`.
     */
    #[Required('wire_decline')]
    public ?WireDecline $wireDecline;

    /**
     * `new Source()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Source::with(
     *   achDecline: ...,
     *   cardDecline: ...,
     *   category: ...,
     *   checkDecline: ...,
     *   checkDepositRejection: ...,
     *   inboundFednowTransferDecline: ...,
     *   inboundRealTimePaymentsTransferDecline: ...,
     *   other: ...,
     *   wireDecline: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Source)
     *   ->withACHDecline(...)
     *   ->withCardDecline(...)
     *   ->withCategory(...)
     *   ->withCheckDecline(...)
     *   ->withCheckDepositRejection(...)
     *   ->withInboundFednowTransferDecline(...)
     *   ->withInboundRealTimePaymentsTransferDecline(...)
     *   ->withOther(...)
     *   ->withWireDecline(...)
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
     * @param ACHDecline|ACHDeclineShape|null $achDecline
     * @param CardDecline|CardDeclineShape|null $cardDecline
     * @param Category|value-of<Category> $category
     * @param CheckDecline|CheckDeclineShape|null $checkDecline
     * @param CheckDepositRejection|CheckDepositRejectionShape|null $checkDepositRejection
     * @param InboundFednowTransferDecline|InboundFednowTransferDeclineShape|null $inboundFednowTransferDecline
     * @param InboundRealTimePaymentsTransferDecline|InboundRealTimePaymentsTransferDeclineShape|null $inboundRealTimePaymentsTransferDecline
     * @param Other|OtherShape|null $other
     * @param WireDecline|WireDeclineShape|null $wireDecline
     */
    public static function with(
        ACHDecline|array|null $achDecline,
        CardDecline|array|null $cardDecline,
        Category|string $category,
        CheckDecline|array|null $checkDecline,
        CheckDepositRejection|array|null $checkDepositRejection,
        InboundFednowTransferDecline|array|null $inboundFednowTransferDecline,
        InboundRealTimePaymentsTransferDecline|array|null $inboundRealTimePaymentsTransferDecline,
        Other|array|null $other,
        WireDecline|array|null $wireDecline,
    ): self {
        $self = new self;

        $self['achDecline'] = $achDecline;
        $self['cardDecline'] = $cardDecline;
        $self['category'] = $category;
        $self['checkDecline'] = $checkDecline;
        $self['checkDepositRejection'] = $checkDepositRejection;
        $self['inboundFednowTransferDecline'] = $inboundFednowTransferDecline;
        $self['inboundRealTimePaymentsTransferDecline'] = $inboundRealTimePaymentsTransferDecline;
        $self['other'] = $other;
        $self['wireDecline'] = $wireDecline;

        return $self;
    }

    /**
     * An ACH Decline object. This field will be present in the JSON response if and only if `category` is equal to `ach_decline`.
     *
     * @param ACHDecline|ACHDeclineShape|null $achDecline
     */
    public function withACHDecline(ACHDecline|array|null $achDecline): self
    {
        $self = clone $this;
        $self['achDecline'] = $achDecline;

        return $self;
    }

    /**
     * A Card Decline object. This field will be present in the JSON response if and only if `category` is equal to `card_decline`.
     *
     * @param CardDecline|CardDeclineShape|null $cardDecline
     */
    public function withCardDecline(CardDecline|array|null $cardDecline): self
    {
        $self = clone $this;
        $self['cardDecline'] = $cardDecline;

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
     * A Check Decline object. This field will be present in the JSON response if and only if `category` is equal to `check_decline`.
     *
     * @param CheckDecline|CheckDeclineShape|null $checkDecline
     */
    public function withCheckDecline(
        CheckDecline|array|null $checkDecline
    ): self {
        $self = clone $this;
        $self['checkDecline'] = $checkDecline;

        return $self;
    }

    /**
     * A Check Deposit Rejection object. This field will be present in the JSON response if and only if `category` is equal to `check_deposit_rejection`.
     *
     * @param CheckDepositRejection|CheckDepositRejectionShape|null $checkDepositRejection
     */
    public function withCheckDepositRejection(
        CheckDepositRejection|array|null $checkDepositRejection
    ): self {
        $self = clone $this;
        $self['checkDepositRejection'] = $checkDepositRejection;

        return $self;
    }

    /**
     * An Inbound FedNow Transfer Decline object. This field will be present in the JSON response if and only if `category` is equal to `inbound_fednow_transfer_decline`.
     *
     * @param InboundFednowTransferDecline|InboundFednowTransferDeclineShape|null $inboundFednowTransferDecline
     */
    public function withInboundFednowTransferDecline(
        InboundFednowTransferDecline|array|null $inboundFednowTransferDecline
    ): self {
        $self = clone $this;
        $self['inboundFednowTransferDecline'] = $inboundFednowTransferDecline;

        return $self;
    }

    /**
     * An Inbound Real-Time Payments Transfer Decline object. This field will be present in the JSON response if and only if `category` is equal to `inbound_real_time_payments_transfer_decline`.
     *
     * @param InboundRealTimePaymentsTransferDecline|InboundRealTimePaymentsTransferDeclineShape|null $inboundRealTimePaymentsTransferDecline
     */
    public function withInboundRealTimePaymentsTransferDecline(
        InboundRealTimePaymentsTransferDecline|array|null $inboundRealTimePaymentsTransferDecline,
    ): self {
        $self = clone $this;
        $self['inboundRealTimePaymentsTransferDecline'] = $inboundRealTimePaymentsTransferDecline;

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
     * A Wire Decline object. This field will be present in the JSON response if and only if `category` is equal to `wire_decline`.
     *
     * @param WireDecline|WireDeclineShape|null $wireDecline
     */
    public function withWireDecline(WireDecline|array|null $wireDecline): self
    {
        $self = clone $this;
        $self['wireDecline'] = $wireDecline;

        return $self;
    }
}
