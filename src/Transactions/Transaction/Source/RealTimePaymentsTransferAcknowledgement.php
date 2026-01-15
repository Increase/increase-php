<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Real-Time Payments Transfer Acknowledgement object. This field will be present in the JSON response if and only if `category` is equal to `real_time_payments_transfer_acknowledgement`. A Real-Time Payments Transfer Acknowledgement is created when a Real-Time Payments Transfer sent from Increase is acknowledged by the receiving bank.
 *
 * @phpstan-type RealTimePaymentsTransferAcknowledgementShape = array{
 *   amount: int,
 *   destinationAccountNumber: string,
 *   destinationRoutingNumber: string,
 *   remittanceInformation: string,
 *   transferID: string,
 * }
 */
final class RealTimePaymentsTransferAcknowledgement implements BaseModel
{
    /** @use SdkModel<RealTimePaymentsTransferAcknowledgementShape> */
    use SdkModel;

    /**
     * The transfer amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The destination account number.
     */
    #[Required('destination_account_number')]
    public string $destinationAccountNumber;

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    #[Required('destination_routing_number')]
    public string $destinationRoutingNumber;

    /**
     * Unstructured information that will show on the recipient's bank statement.
     */
    #[Required('remittance_information')]
    public string $remittanceInformation;

    /**
     * The identifier of the Real-Time Payments Transfer that led to this Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new RealTimePaymentsTransferAcknowledgement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RealTimePaymentsTransferAcknowledgement::with(
     *   amount: ...,
     *   destinationAccountNumber: ...,
     *   destinationRoutingNumber: ...,
     *   remittanceInformation: ...,
     *   transferID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RealTimePaymentsTransferAcknowledgement)
     *   ->withAmount(...)
     *   ->withDestinationAccountNumber(...)
     *   ->withDestinationRoutingNumber(...)
     *   ->withRemittanceInformation(...)
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
        int $amount,
        string $destinationAccountNumber,
        string $destinationRoutingNumber,
        string $remittanceInformation,
        string $transferID,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['destinationAccountNumber'] = $destinationAccountNumber;
        $self['destinationRoutingNumber'] = $destinationRoutingNumber;
        $self['remittanceInformation'] = $remittanceInformation;
        $self['transferID'] = $transferID;

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
     * The destination account number.
     */
    public function withDestinationAccountNumber(
        string $destinationAccountNumber
    ): self {
        $self = clone $this;
        $self['destinationAccountNumber'] = $destinationAccountNumber;

        return $self;
    }

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    public function withDestinationRoutingNumber(
        string $destinationRoutingNumber
    ): self {
        $self = clone $this;
        $self['destinationRoutingNumber'] = $destinationRoutingNumber;

        return $self;
    }

    /**
     * Unstructured information that will show on the recipient's bank statement.
     */
    public function withRemittanceInformation(
        string $remittanceInformation
    ): self {
        $self = clone $this;
        $self['remittanceInformation'] = $remittanceInformation;

        return $self;
    }

    /**
     * The identifier of the Real-Time Payments Transfer that led to this Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}
