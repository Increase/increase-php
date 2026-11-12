<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\CardDisputeProvisionalCredit\Currency;
use Increase\Transactions\Transaction\Source\CardDisputeProvisionalCredit\EventType;

/**
 * A Card Dispute Provisional Credit object. This field will be present in the JSON response if and only if `category` is equal to `card_dispute_provisional_credit`. A provisional credit given to the cardholder while a Card Dispute is investigated, or its reversal. Two Transactions are created: one on the cardholder's Account, and the other on the provisional credit funding Account.
 *
 * @phpstan-type CardDisputeProvisionalCreditShape = array{
 *   amount: int,
 *   cardDisputeID: string,
 *   cardholderAccountID: string,
 *   currency: Currency|value-of<Currency>,
 *   eventType: EventType|value-of<EventType>,
 *   provisionalCreditFundingAccountID: string,
 * }
 */
final class CardDisputeProvisionalCredit implements BaseModel
{
    /** @use SdkModel<CardDisputeProvisionalCreditShape> */
    use SdkModel;

    /**
     * The amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * The identifier of the Card Dispute the provisional credit was given for.
     */
    #[Required('card_dispute_id')]
    public string $cardDisputeID;

    /**
     * The identifier of the cardholder's Account. It is credited when the provisional credit is provided, and debited when it is reversed.
     */
    #[Required('cardholder_account_id')]
    public string $cardholderAccountID;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the provisional credit's currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Whether the provisional credit was provided or reversed.
     *
     * @var value-of<EventType> $eventType
     */
    #[Required('event_type', enum: EventType::class)]
    public string $eventType;

    /**
     * The identifier of the provisional credit funding Account, the Account that funds the provisional credit. It is debited when the provisional credit is provided, and credited when it is reversed.
     */
    #[Required('provisional_credit_funding_account_id')]
    public string $provisionalCreditFundingAccountID;

    /**
     * `new CardDisputeProvisionalCredit()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardDisputeProvisionalCredit::with(
     *   amount: ...,
     *   cardDisputeID: ...,
     *   cardholderAccountID: ...,
     *   currency: ...,
     *   eventType: ...,
     *   provisionalCreditFundingAccountID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardDisputeProvisionalCredit)
     *   ->withAmount(...)
     *   ->withCardDisputeID(...)
     *   ->withCardholderAccountID(...)
     *   ->withCurrency(...)
     *   ->withEventType(...)
     *   ->withProvisionalCreditFundingAccountID(...)
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
     * @param Currency|value-of<Currency> $currency
     * @param EventType|value-of<EventType> $eventType
     */
    public static function with(
        int $amount,
        string $cardDisputeID,
        string $cardholderAccountID,
        Currency|string $currency,
        EventType|string $eventType,
        string $provisionalCreditFundingAccountID,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['cardDisputeID'] = $cardDisputeID;
        $self['cardholderAccountID'] = $cardholderAccountID;
        $self['currency'] = $currency;
        $self['eventType'] = $eventType;
        $self['provisionalCreditFundingAccountID'] = $provisionalCreditFundingAccountID;

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
     * The identifier of the Card Dispute the provisional credit was given for.
     */
    public function withCardDisputeID(string $cardDisputeID): self
    {
        $self = clone $this;
        $self['cardDisputeID'] = $cardDisputeID;

        return $self;
    }

    /**
     * The identifier of the cardholder's Account. It is credited when the provisional credit is provided, and debited when it is reversed.
     */
    public function withCardholderAccountID(string $cardholderAccountID): self
    {
        $self = clone $this;
        $self['cardholderAccountID'] = $cardholderAccountID;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the provisional credit's currency.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Whether the provisional credit was provided or reversed.
     *
     * @param EventType|value-of<EventType> $eventType
     */
    public function withEventType(EventType|string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * The identifier of the provisional credit funding Account, the Account that funds the provisional credit. It is debited when the provisional credit is provided, and credited when it is reversed.
     */
    public function withProvisionalCreditFundingAccountID(
        string $provisionalCreditFundingAccountID
    ): self {
        $self = clone $this;
        $self['provisionalCreditFundingAccountID'] = $provisionalCreditFundingAccountID;

        return $self;
    }
}
