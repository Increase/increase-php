<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\FednowTransferReturn\ReturnReasonCode;

/**
 * A FedNow Transfer Return object. This field will be present in the JSON response if and only if `category` is equal to `fednow_transfer_return`. A FedNow Transfer Return is created when a FedNow Transfer sent from Increase is returned by the recipient's bank.
 *
 * @phpstan-type FednowTransferReturnShape = array{
 *   amount: int,
 *   returnReasonAdditionalInformation: string|null,
 *   returnReasonCode: ReturnReasonCode|value-of<ReturnReasonCode>,
 *   transferID: string,
 * }
 */
final class FednowTransferReturn implements BaseModel
{
    /** @use SdkModel<FednowTransferReturnShape> */
    use SdkModel;

    /**
     * The returned amount in USD cents. This is always a positive number.
     */
    #[Required]
    public int $amount;

    /**
     * Additional information about the return provided by the recipient's bank.
     */
    #[Required('return_reason_additional_information')]
    public ?string $returnReasonAdditionalInformation;

    /**
     * The reason the transfer was returned as provided by the recipient's bank.
     *
     * @var value-of<ReturnReasonCode> $returnReasonCode
     */
    #[Required('return_reason_code', enum: ReturnReasonCode::class)]
    public string $returnReasonCode;

    /**
     * The identifier of the FedNow Transfer that led to this Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new FednowTransferReturn()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FednowTransferReturn::with(
     *   amount: ...,
     *   returnReasonAdditionalInformation: ...,
     *   returnReasonCode: ...,
     *   transferID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FednowTransferReturn)
     *   ->withAmount(...)
     *   ->withReturnReasonAdditionalInformation(...)
     *   ->withReturnReasonCode(...)
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
     *
     * @param ReturnReasonCode|value-of<ReturnReasonCode> $returnReasonCode
     */
    public static function with(
        int $amount,
        ?string $returnReasonAdditionalInformation,
        ReturnReasonCode|string $returnReasonCode,
        string $transferID,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['returnReasonAdditionalInformation'] = $returnReasonAdditionalInformation;
        $self['returnReasonCode'] = $returnReasonCode;
        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * The returned amount in USD cents. This is always a positive number.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Additional information about the return provided by the recipient's bank.
     */
    public function withReturnReasonAdditionalInformation(
        ?string $returnReasonAdditionalInformation
    ): self {
        $self = clone $this;
        $self['returnReasonAdditionalInformation'] = $returnReasonAdditionalInformation;

        return $self;
    }

    /**
     * The reason the transfer was returned as provided by the recipient's bank.
     *
     * @param ReturnReasonCode|value-of<ReturnReasonCode> $returnReasonCode
     */
    public function withReturnReasonCode(
        ReturnReasonCode|string $returnReasonCode
    ): self {
        $self = clone $this;
        $self['returnReasonCode'] = $returnReasonCode;

        return $self;
    }

    /**
     * The identifier of the FedNow Transfer that led to this Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}
