<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardSettlement;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Network-specific identifiers for this refund.
 *
 * @phpstan-type NetworkIdentifiersShape = array{
 *   acquirerBusinessID: string,
 *   acquirerReferenceNumber: string,
 *   authorizationIdentificationResponse: string|null,
 *   transactionID: string|null,
 * }
 */
final class NetworkIdentifiers implements BaseModel
{
    /** @use SdkModel<NetworkIdentifiersShape> */
    use SdkModel;

    /**
     * A network assigned business ID that identifies the acquirer that processed this transaction.
     */
    #[Required('acquirer_business_id')]
    public string $acquirerBusinessID;

    /**
     * A globally unique identifier for this settlement.
     */
    #[Required('acquirer_reference_number')]
    public string $acquirerReferenceNumber;

    /**
     * The randomly generated 6-character Authorization Identification Response code sent back to the acquirer in an approved response.
     */
    #[Required('authorization_identification_response')]
    public ?string $authorizationIdentificationResponse;

    /**
     * A globally unique transaction identifier provided by the card network, used across multiple life-cycle requests.
     */
    #[Required('transaction_id')]
    public ?string $transactionID;

    /**
     * `new NetworkIdentifiers()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NetworkIdentifiers::with(
     *   acquirerBusinessID: ...,
     *   acquirerReferenceNumber: ...,
     *   authorizationIdentificationResponse: ...,
     *   transactionID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NetworkIdentifiers)
     *   ->withAcquirerBusinessID(...)
     *   ->withAcquirerReferenceNumber(...)
     *   ->withAuthorizationIdentificationResponse(...)
     *   ->withTransactionID(...)
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
        string $acquirerBusinessID,
        string $acquirerReferenceNumber,
        ?string $authorizationIdentificationResponse,
        ?string $transactionID,
    ): self {
        $self = new self;

        $self['acquirerBusinessID'] = $acquirerBusinessID;
        $self['acquirerReferenceNumber'] = $acquirerReferenceNumber;
        $self['authorizationIdentificationResponse'] = $authorizationIdentificationResponse;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * A network assigned business ID that identifies the acquirer that processed this transaction.
     */
    public function withAcquirerBusinessID(string $acquirerBusinessID): self
    {
        $self = clone $this;
        $self['acquirerBusinessID'] = $acquirerBusinessID;

        return $self;
    }

    /**
     * A globally unique identifier for this settlement.
     */
    public function withAcquirerReferenceNumber(
        string $acquirerReferenceNumber
    ): self {
        $self = clone $this;
        $self['acquirerReferenceNumber'] = $acquirerReferenceNumber;

        return $self;
    }

    /**
     * The randomly generated 6-character Authorization Identification Response code sent back to the acquirer in an approved response.
     */
    public function withAuthorizationIdentificationResponse(
        ?string $authorizationIdentificationResponse
    ): self {
        $self = clone $this;
        $self['authorizationIdentificationResponse'] = $authorizationIdentificationResponse;

        return $self;
    }

    /**
     * A globally unique transaction identifier provided by the card network, used across multiple life-cycle requests.
     */
    public function withTransactionID(?string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}
