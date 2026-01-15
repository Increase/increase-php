<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardBalanceInquiry;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Network-specific identifiers for a specific request or transaction.
 *
 * @phpstan-type NetworkIdentifiersShape = array{
 *   authorizationIdentificationResponse: string|null,
 *   retrievalReferenceNumber: string|null,
 *   traceNumber: string|null,
 *   transactionID: string|null,
 * }
 */
final class NetworkIdentifiers implements BaseModel
{
    /** @use SdkModel<NetworkIdentifiersShape> */
    use SdkModel;

    /**
     * The randomly generated 6-character Authorization Identification Response code sent back to the acquirer in an approved response.
     */
    #[Required('authorization_identification_response')]
    public ?string $authorizationIdentificationResponse;

    /**
     * A life-cycle identifier used across e.g., an authorization and a reversal. Expected to be unique per acquirer within a window of time. For some card networks the retrieval reference number includes the trace counter.
     */
    #[Required('retrieval_reference_number')]
    public ?string $retrievalReferenceNumber;

    /**
     * A counter used to verify an individual authorization. Expected to be unique per acquirer within a window of time.
     */
    #[Required('trace_number')]
    public ?string $traceNumber;

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
     *   authorizationIdentificationResponse: ...,
     *   retrievalReferenceNumber: ...,
     *   traceNumber: ...,
     *   transactionID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NetworkIdentifiers)
     *   ->withAuthorizationIdentificationResponse(...)
     *   ->withRetrievalReferenceNumber(...)
     *   ->withTraceNumber(...)
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
        ?string $authorizationIdentificationResponse,
        ?string $retrievalReferenceNumber,
        ?string $traceNumber,
        ?string $transactionID,
    ): self {
        $self = new self;

        $self['authorizationIdentificationResponse'] = $authorizationIdentificationResponse;
        $self['retrievalReferenceNumber'] = $retrievalReferenceNumber;
        $self['traceNumber'] = $traceNumber;
        $self['transactionID'] = $transactionID;

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
     * A life-cycle identifier used across e.g., an authorization and a reversal. Expected to be unique per acquirer within a window of time. For some card networks the retrieval reference number includes the trace counter.
     */
    public function withRetrievalReferenceNumber(
        ?string $retrievalReferenceNumber
    ): self {
        $self = clone $this;
        $self['retrievalReferenceNumber'] = $retrievalReferenceNumber;

        return $self;
    }

    /**
     * A counter used to verify an individual authorization. Expected to be unique per acquirer within a window of time.
     */
    public function withTraceNumber(?string $traceNumber): self
    {
        $self = clone $this;
        $self['traceNumber'] = $traceNumber;

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
