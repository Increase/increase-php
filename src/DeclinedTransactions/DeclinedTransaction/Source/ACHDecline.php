<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\ACHDecline\Reason;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\ACHDecline\Type;

/**
 * An ACH Decline object. This field will be present in the JSON response if and only if `category` is equal to `ach_decline`.
 *
 * @phpstan-type ACHDeclineShape = array{
 *   id: string,
 *   amount: int,
 *   inboundACHTransferID: string,
 *   originatorCompanyDescriptiveDate: string|null,
 *   originatorCompanyDiscretionaryData: string|null,
 *   originatorCompanyID: string,
 *   originatorCompanyName: string,
 *   reason: Reason|value-of<Reason>,
 *   receiverIDNumber: string|null,
 *   receiverName: string|null,
 *   traceNumber: string,
 *   type: Type|value-of<Type>,
 * }
 */
final class ACHDecline implements BaseModel
{
    /** @use SdkModel<ACHDeclineShape> */
    use SdkModel;

    /**
     * The ACH Decline's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The declined amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The identifier of the Inbound ACH Transfer object associated with this decline.
     */
    #[Required('inbound_ach_transfer_id')]
    public string $inboundACHTransferID;

    /**
     * The descriptive date of the transfer.
     */
    #[Required('originator_company_descriptive_date')]
    public ?string $originatorCompanyDescriptiveDate;

    /**
     * The additional information included with the transfer.
     */
    #[Required('originator_company_discretionary_data')]
    public ?string $originatorCompanyDiscretionaryData;

    /**
     * The identifier of the company that initiated the transfer.
     */
    #[Required('originator_company_id')]
    public string $originatorCompanyID;

    /**
     * The name of the company that initiated the transfer.
     */
    #[Required('originator_company_name')]
    public string $originatorCompanyName;

    /**
     * Why the ACH transfer was declined.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * The id of the receiver of the transfer.
     */
    #[Required('receiver_id_number')]
    public ?string $receiverIDNumber;

    /**
     * The name of the receiver of the transfer.
     */
    #[Required('receiver_name')]
    public ?string $receiverName;

    /**
     * The trace number of the transfer.
     */
    #[Required('trace_number')]
    public string $traceNumber;

    /**
     * A constant representing the object's type. For this resource it will always be `ach_decline`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new ACHDecline()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ACHDecline::with(
     *   id: ...,
     *   amount: ...,
     *   inboundACHTransferID: ...,
     *   originatorCompanyDescriptiveDate: ...,
     *   originatorCompanyDiscretionaryData: ...,
     *   originatorCompanyID: ...,
     *   originatorCompanyName: ...,
     *   reason: ...,
     *   receiverIDNumber: ...,
     *   receiverName: ...,
     *   traceNumber: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ACHDecline)
     *   ->withID(...)
     *   ->withAmount(...)
     *   ->withInboundACHTransferID(...)
     *   ->withOriginatorCompanyDescriptiveDate(...)
     *   ->withOriginatorCompanyDiscretionaryData(...)
     *   ->withOriginatorCompanyID(...)
     *   ->withOriginatorCompanyName(...)
     *   ->withReason(...)
     *   ->withReceiverIDNumber(...)
     *   ->withReceiverName(...)
     *   ->withTraceNumber(...)
     *   ->withType(...)
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
     * @param Reason|value-of<Reason> $reason
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        int $amount,
        string $inboundACHTransferID,
        ?string $originatorCompanyDescriptiveDate,
        ?string $originatorCompanyDiscretionaryData,
        string $originatorCompanyID,
        string $originatorCompanyName,
        Reason|string $reason,
        ?string $receiverIDNumber,
        ?string $receiverName,
        string $traceNumber,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['amount'] = $amount;
        $self['inboundACHTransferID'] = $inboundACHTransferID;
        $self['originatorCompanyDescriptiveDate'] = $originatorCompanyDescriptiveDate;
        $self['originatorCompanyDiscretionaryData'] = $originatorCompanyDiscretionaryData;
        $self['originatorCompanyID'] = $originatorCompanyID;
        $self['originatorCompanyName'] = $originatorCompanyName;
        $self['reason'] = $reason;
        $self['receiverIDNumber'] = $receiverIDNumber;
        $self['receiverName'] = $receiverName;
        $self['traceNumber'] = $traceNumber;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The ACH Decline's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The declined amount in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier of the Inbound ACH Transfer object associated with this decline.
     */
    public function withInboundACHTransferID(string $inboundACHTransferID): self
    {
        $self = clone $this;
        $self['inboundACHTransferID'] = $inboundACHTransferID;

        return $self;
    }

    /**
     * The descriptive date of the transfer.
     */
    public function withOriginatorCompanyDescriptiveDate(
        ?string $originatorCompanyDescriptiveDate
    ): self {
        $self = clone $this;
        $self['originatorCompanyDescriptiveDate'] = $originatorCompanyDescriptiveDate;

        return $self;
    }

    /**
     * The additional information included with the transfer.
     */
    public function withOriginatorCompanyDiscretionaryData(
        ?string $originatorCompanyDiscretionaryData
    ): self {
        $self = clone $this;
        $self['originatorCompanyDiscretionaryData'] = $originatorCompanyDiscretionaryData;

        return $self;
    }

    /**
     * The identifier of the company that initiated the transfer.
     */
    public function withOriginatorCompanyID(string $originatorCompanyID): self
    {
        $self = clone $this;
        $self['originatorCompanyID'] = $originatorCompanyID;

        return $self;
    }

    /**
     * The name of the company that initiated the transfer.
     */
    public function withOriginatorCompanyName(
        string $originatorCompanyName
    ): self {
        $self = clone $this;
        $self['originatorCompanyName'] = $originatorCompanyName;

        return $self;
    }

    /**
     * Why the ACH transfer was declined.
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
     * The id of the receiver of the transfer.
     */
    public function withReceiverIDNumber(?string $receiverIDNumber): self
    {
        $self = clone $this;
        $self['receiverIDNumber'] = $receiverIDNumber;

        return $self;
    }

    /**
     * The name of the receiver of the transfer.
     */
    public function withReceiverName(?string $receiverName): self
    {
        $self = clone $this;
        $self['receiverName'] = $receiverName;

        return $self;
    }

    /**
     * The trace number of the transfer.
     */
    public function withTraceNumber(string $traceNumber): self
    {
        $self = clone $this;
        $self['traceNumber'] = $traceNumber;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `ach_decline`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
