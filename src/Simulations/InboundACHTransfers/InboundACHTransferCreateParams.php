<?php

declare(strict_types=1);

namespace Increase\Simulations\InboundACHTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\Addenda;
use Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\StandardEntryClassCode;

/**
 * Simulates an inbound ACH transfer to your account. This imitates initiating a transfer to an Increase account from a different financial institution. The transfer may be either a credit or a debit depending on if the `amount` is positive or negative. The result of calling this API will contain the created transfer. You can pass a `resolve_at` parameter to allow for a window to [action on the Inbound ACH Transfer](https://increase.com/documentation/receiving-ach-transfers). Alternatively, if you don't pass the `resolve_at` parameter the result will contain either a [Transaction](#transactions) or a [Declined Transaction](#declined-transactions) depending on whether or not the transfer is allowed.
 *
 * @see Increase\Services\Simulations\InboundACHTransfersService::create()
 *
 * @phpstan-import-type AddendaShape from \Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\Addenda
 *
 * @phpstan-type InboundACHTransferCreateParamsShape = array{
 *   accountNumberID: string,
 *   amount: int,
 *   addenda?: null|Addenda|AddendaShape,
 *   companyDescriptiveDate?: string|null,
 *   companyDiscretionaryData?: string|null,
 *   companyEntryDescription?: string|null,
 *   companyID?: string|null,
 *   companyName?: string|null,
 *   receiverIDNumber?: string|null,
 *   receiverName?: string|null,
 *   resolveAt?: \DateTimeInterface|null,
 *   standardEntryClassCode?: null|StandardEntryClassCode|value-of<StandardEntryClassCode>,
 * }
 */
final class InboundACHTransferCreateParams implements BaseModel
{
    /** @use SdkModel<InboundACHTransferCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Account Number the inbound ACH Transfer is for.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * The transfer amount in cents. A positive amount originates a credit transfer pushing funds to the receiving account. A negative amount originates a debit transfer pulling funds from the receiving account.
     */
    #[Required]
    public int $amount;

    /**
     * Additional information to include in the transfer.
     */
    #[Optional]
    public ?Addenda $addenda;

    /**
     * The description of the date of the transfer.
     */
    #[Optional('company_descriptive_date')]
    public ?string $companyDescriptiveDate;

    /**
     * Data associated with the transfer set by the sender.
     */
    #[Optional('company_discretionary_data')]
    public ?string $companyDiscretionaryData;

    /**
     * The description of the transfer set by the sender.
     */
    #[Optional('company_entry_description')]
    public ?string $companyEntryDescription;

    /**
     * The sender's company ID.
     */
    #[Optional('company_id')]
    public ?string $companyID;

    /**
     * The name of the sender.
     */
    #[Optional('company_name')]
    public ?string $companyName;

    /**
     * The ID of the receiver of the transfer.
     */
    #[Optional('receiver_id_number')]
    public ?string $receiverIDNumber;

    /**
     * The name of the receiver of the transfer.
     */
    #[Optional('receiver_name')]
    public ?string $receiverName;

    /**
     * The time at which the transfer should be resolved. If not provided will resolve immediately.
     */
    #[Optional('resolve_at')]
    public ?\DateTimeInterface $resolveAt;

    /**
     * The standard entry class code for the transfer.
     *
     * @var value-of<StandardEntryClassCode>|null $standardEntryClassCode
     */
    #[Optional('standard_entry_class_code', enum: StandardEntryClassCode::class)]
    public ?string $standardEntryClassCode;

    /**
     * `new InboundACHTransferCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundACHTransferCreateParams::with(accountNumberID: ..., amount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundACHTransferCreateParams)->withAccountNumberID(...)->withAmount(...)
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
     * @param Addenda|AddendaShape|null $addenda
     * @param StandardEntryClassCode|value-of<StandardEntryClassCode>|null $standardEntryClassCode
     */
    public static function with(
        string $accountNumberID,
        int $amount,
        Addenda|array|null $addenda = null,
        ?string $companyDescriptiveDate = null,
        ?string $companyDiscretionaryData = null,
        ?string $companyEntryDescription = null,
        ?string $companyID = null,
        ?string $companyName = null,
        ?string $receiverIDNumber = null,
        ?string $receiverName = null,
        ?\DateTimeInterface $resolveAt = null,
        StandardEntryClassCode|string|null $standardEntryClassCode = null,
    ): self {
        $self = new self;

        $self['accountNumberID'] = $accountNumberID;
        $self['amount'] = $amount;

        null !== $addenda && $self['addenda'] = $addenda;
        null !== $companyDescriptiveDate && $self['companyDescriptiveDate'] = $companyDescriptiveDate;
        null !== $companyDiscretionaryData && $self['companyDiscretionaryData'] = $companyDiscretionaryData;
        null !== $companyEntryDescription && $self['companyEntryDescription'] = $companyEntryDescription;
        null !== $companyID && $self['companyID'] = $companyID;
        null !== $companyName && $self['companyName'] = $companyName;
        null !== $receiverIDNumber && $self['receiverIDNumber'] = $receiverIDNumber;
        null !== $receiverName && $self['receiverName'] = $receiverName;
        null !== $resolveAt && $self['resolveAt'] = $resolveAt;
        null !== $standardEntryClassCode && $self['standardEntryClassCode'] = $standardEntryClassCode;

        return $self;
    }

    /**
     * The identifier of the Account Number the inbound ACH Transfer is for.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * The transfer amount in cents. A positive amount originates a credit transfer pushing funds to the receiving account. A negative amount originates a debit transfer pulling funds from the receiving account.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Additional information to include in the transfer.
     *
     * @param Addenda|AddendaShape $addenda
     */
    public function withAddenda(Addenda|array $addenda): self
    {
        $self = clone $this;
        $self['addenda'] = $addenda;

        return $self;
    }

    /**
     * The description of the date of the transfer.
     */
    public function withCompanyDescriptiveDate(
        string $companyDescriptiveDate
    ): self {
        $self = clone $this;
        $self['companyDescriptiveDate'] = $companyDescriptiveDate;

        return $self;
    }

    /**
     * Data associated with the transfer set by the sender.
     */
    public function withCompanyDiscretionaryData(
        string $companyDiscretionaryData
    ): self {
        $self = clone $this;
        $self['companyDiscretionaryData'] = $companyDiscretionaryData;

        return $self;
    }

    /**
     * The description of the transfer set by the sender.
     */
    public function withCompanyEntryDescription(
        string $companyEntryDescription
    ): self {
        $self = clone $this;
        $self['companyEntryDescription'] = $companyEntryDescription;

        return $self;
    }

    /**
     * The sender's company ID.
     */
    public function withCompanyID(string $companyID): self
    {
        $self = clone $this;
        $self['companyID'] = $companyID;

        return $self;
    }

    /**
     * The name of the sender.
     */
    public function withCompanyName(string $companyName): self
    {
        $self = clone $this;
        $self['companyName'] = $companyName;

        return $self;
    }

    /**
     * The ID of the receiver of the transfer.
     */
    public function withReceiverIDNumber(string $receiverIDNumber): self
    {
        $self = clone $this;
        $self['receiverIDNumber'] = $receiverIDNumber;

        return $self;
    }

    /**
     * The name of the receiver of the transfer.
     */
    public function withReceiverName(string $receiverName): self
    {
        $self = clone $this;
        $self['receiverName'] = $receiverName;

        return $self;
    }

    /**
     * The time at which the transfer should be resolved. If not provided will resolve immediately.
     */
    public function withResolveAt(\DateTimeInterface $resolveAt): self
    {
        $self = clone $this;
        $self['resolveAt'] = $resolveAt;

        return $self;
    }

    /**
     * The standard entry class code for the transfer.
     *
     * @param StandardEntryClassCode|value-of<StandardEntryClassCode> $standardEntryClassCode
     */
    public function withStandardEntryClassCode(
        StandardEntryClassCode|string $standardEntryClassCode
    ): self {
        $self = clone $this;
        $self['standardEntryClassCode'] = $standardEntryClassCode;

        return $self;
    }
}
