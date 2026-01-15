<?php

declare(strict_types=1);

namespace Increase\CardPushTransfers\CardPushTransfer;

use Increase\CardPushTransfers\CardPushTransfer\Acceptance\CardVerificationValue2Result;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If the transfer is accepted by the recipient bank, this will contain supplemental details.
 *
 * @phpstan-type AcceptanceShape = array{
 *   acceptedAt: \DateTimeInterface,
 *   authorizationIdentificationResponse: string,
 *   cardVerificationValue2Result: null|CardVerificationValue2Result|value-of<CardVerificationValue2Result>,
 *   networkTransactionIdentifier: string|null,
 *   settlementAmount: int,
 * }
 */
final class Acceptance implements BaseModel
{
    /** @use SdkModel<AcceptanceShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was accepted by the issuing bank.
     */
    #[Required('accepted_at')]
    public \DateTimeInterface $acceptedAt;

    /**
     * The authorization identification response from the issuing bank.
     */
    #[Required('authorization_identification_response')]
    public string $authorizationIdentificationResponse;

    /**
     * The result of the Card Verification Value 2 match.
     *
     * @var value-of<CardVerificationValue2Result>|null $cardVerificationValue2Result
     */
    #[Required(
        'card_verification_value2_result',
        enum: CardVerificationValue2Result::class
    )]
    public ?string $cardVerificationValue2Result;

    /**
     * A unique identifier for the transaction on the card network.
     */
    #[Required('network_transaction_identifier')]
    public ?string $networkTransactionIdentifier;

    /**
     * The transfer amount in USD cents.
     */
    #[Required('settlement_amount')]
    public int $settlementAmount;

    /**
     * `new Acceptance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Acceptance::with(
     *   acceptedAt: ...,
     *   authorizationIdentificationResponse: ...,
     *   cardVerificationValue2Result: ...,
     *   networkTransactionIdentifier: ...,
     *   settlementAmount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Acceptance)
     *   ->withAcceptedAt(...)
     *   ->withAuthorizationIdentificationResponse(...)
     *   ->withCardVerificationValue2Result(...)
     *   ->withNetworkTransactionIdentifier(...)
     *   ->withSettlementAmount(...)
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
     * @param CardVerificationValue2Result|value-of<CardVerificationValue2Result>|null $cardVerificationValue2Result
     */
    public static function with(
        \DateTimeInterface $acceptedAt,
        string $authorizationIdentificationResponse,
        CardVerificationValue2Result|string|null $cardVerificationValue2Result,
        ?string $networkTransactionIdentifier,
        int $settlementAmount,
    ): self {
        $self = new self;

        $self['acceptedAt'] = $acceptedAt;
        $self['authorizationIdentificationResponse'] = $authorizationIdentificationResponse;
        $self['cardVerificationValue2Result'] = $cardVerificationValue2Result;
        $self['networkTransactionIdentifier'] = $networkTransactionIdentifier;
        $self['settlementAmount'] = $settlementAmount;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was accepted by the issuing bank.
     */
    public function withAcceptedAt(\DateTimeInterface $acceptedAt): self
    {
        $self = clone $this;
        $self['acceptedAt'] = $acceptedAt;

        return $self;
    }

    /**
     * The authorization identification response from the issuing bank.
     */
    public function withAuthorizationIdentificationResponse(
        string $authorizationIdentificationResponse
    ): self {
        $self = clone $this;
        $self['authorizationIdentificationResponse'] = $authorizationIdentificationResponse;

        return $self;
    }

    /**
     * The result of the Card Verification Value 2 match.
     *
     * @param CardVerificationValue2Result|value-of<CardVerificationValue2Result>|null $cardVerificationValue2Result
     */
    public function withCardVerificationValue2Result(
        CardVerificationValue2Result|string|null $cardVerificationValue2Result
    ): self {
        $self = clone $this;
        $self['cardVerificationValue2Result'] = $cardVerificationValue2Result;

        return $self;
    }

    /**
     * A unique identifier for the transaction on the card network.
     */
    public function withNetworkTransactionIdentifier(
        ?string $networkTransactionIdentifier
    ): self {
        $self = clone $this;
        $self['networkTransactionIdentifier'] = $networkTransactionIdentifier;

        return $self;
    }

    /**
     * The transfer amount in USD cents.
     */
    public function withSettlementAmount(int $settlementAmount): self
    {
        $self = clone $this;
        $self['settlementAmount'] = $settlementAmount;

        return $self;
    }
}
