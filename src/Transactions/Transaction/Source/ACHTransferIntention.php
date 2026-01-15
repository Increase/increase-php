<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * An ACH Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `ach_transfer_intention`. An ACH Transfer Intention is created from an ACH Transfer. It reflects the intention to move money into or out of an Increase account via the ACH network.
 *
 * @phpstan-type ACHTransferIntentionShape = array{
 *   accountNumber: string,
 *   amount: int,
 *   routingNumber: string,
 *   statementDescriptor: string,
 *   transferID: string,
 * }
 */
final class ACHTransferIntention implements BaseModel
{
    /** @use SdkModel<ACHTransferIntentionShape> */
    use SdkModel;

    /**
     * The account number for the destination account.
     */
    #[Required('account_number')]
    public string $accountNumber;

    /**
     * The amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN) for the destination account.
     */
    #[Required('routing_number')]
    public string $routingNumber;

    /**
     * A description set when the ACH Transfer was created.
     */
    #[Required('statement_descriptor')]
    public string $statementDescriptor;

    /**
     * The identifier of the ACH Transfer that led to this Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new ACHTransferIntention()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ACHTransferIntention::with(
     *   accountNumber: ...,
     *   amount: ...,
     *   routingNumber: ...,
     *   statementDescriptor: ...,
     *   transferID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ACHTransferIntention)
     *   ->withAccountNumber(...)
     *   ->withAmount(...)
     *   ->withRoutingNumber(...)
     *   ->withStatementDescriptor(...)
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
        string $routingNumber,
        string $statementDescriptor,
        string $transferID,
    ): self {
        $self = new self;

        $self['accountNumber'] = $accountNumber;
        $self['amount'] = $amount;
        $self['routingNumber'] = $routingNumber;
        $self['statementDescriptor'] = $statementDescriptor;
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
     * The amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

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
     * A description set when the ACH Transfer was created.
     */
    public function withStatementDescriptor(string $statementDescriptor): self
    {
        $self = clone $this;
        $self['statementDescriptor'] = $statementDescriptor;

        return $self;
    }

    /**
     * The identifier of the ACH Transfer that led to this Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}
