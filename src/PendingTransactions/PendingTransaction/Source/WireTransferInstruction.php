<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Wire Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `wire_transfer_instruction`.
 *
 * @phpstan-type WireTransferInstructionShape = array{
 *   accountNumber: string,
 *   amount: int,
 *   messageToRecipient: string,
 *   routingNumber: string,
 *   transferID: string,
 * }
 */
final class WireTransferInstruction implements BaseModel
{
    /** @use SdkModel<WireTransferInstructionShape> */
    use SdkModel;

    /**
     * The account number for the destination account.
     */
    #[Required('account_number')]
    public string $accountNumber;

    /**
     * The transfer amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The message that will show on the recipient's bank statement.
     */
    #[Required('message_to_recipient')]
    public string $messageToRecipient;

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN) for the destination account.
     */
    #[Required('routing_number')]
    public string $routingNumber;

    /**
     * The identifier of the Wire Transfer that led to this Pending Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new WireTransferInstruction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WireTransferInstruction::with(
     *   accountNumber: ...,
     *   amount: ...,
     *   messageToRecipient: ...,
     *   routingNumber: ...,
     *   transferID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WireTransferInstruction)
     *   ->withAccountNumber(...)
     *   ->withAmount(...)
     *   ->withMessageToRecipient(...)
     *   ->withRoutingNumber(...)
     *   ->withTransferID(...)
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
     */
    public static function with(
        string $accountNumber,
        int $amount,
        string $messageToRecipient,
        string $routingNumber,
        string $transferID,
    ): self {
        $self = new self;

        $self['accountNumber'] = $accountNumber;
        $self['amount'] = $amount;
        $self['messageToRecipient'] = $messageToRecipient;
        $self['routingNumber'] = $routingNumber;
        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * The account number for the destination account.
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

        return $self;
    }

    /**
     * The transfer amount in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The message that will show on the recipient's bank statement.
     */
    public function withMessageToRecipient(string $messageToRecipient): self
    {
        $self = clone $this;
        $self['messageToRecipient'] = $messageToRecipient;

        return $self;
    }

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN) for the destination account.
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }

    /**
     * The identifier of the Wire Transfer that led to this Pending Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}
