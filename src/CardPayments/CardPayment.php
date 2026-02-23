<?php

declare(strict_types=1);

namespace Increase\CardPayments;

use Increase\CardPayments\CardPayment\Element;
use Increase\CardPayments\CardPayment\SchemeFee;
use Increase\CardPayments\CardPayment\State;
use Increase\CardPayments\CardPayment\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Card Payments group together interactions related to a single card payment, such as an authorization and its corresponding settlement.
 *
 * @phpstan-import-type ElementShape from \Increase\CardPayments\CardPayment\Element
 * @phpstan-import-type SchemeFeeShape from \Increase\CardPayments\CardPayment\SchemeFee
 * @phpstan-import-type StateShape from \Increase\CardPayments\CardPayment\State
 *
 * @phpstan-type CardPaymentShape = array{
 *   id: string,
 *   accountID: string,
 *   cardID: string,
 *   createdAt: \DateTimeInterface,
 *   digitalWalletTokenID: string|null,
 *   elements: list<Element|ElementShape>,
 *   physicalCardID: string|null,
 *   schemeFees: list<SchemeFee|SchemeFeeShape>,
 *   state: State|StateShape,
 *   type: Type|value-of<Type>,
 * }
 */
final class CardPayment implements BaseModel
{
    /** @use SdkModel<CardPaymentShape> */
    use SdkModel;

    /**
     * The Card Payment identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier for the Account the Transaction belongs to.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The Card identifier for this payment.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Card Payment was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The Digital Wallet Token identifier for this payment.
     */
    #[Required('digital_wallet_token_id')]
    public ?string $digitalWalletTokenID;

    /**
     * The interactions related to this card payment.
     *
     * @var list<Element> $elements
     */
    #[Required(list: Element::class)]
    public array $elements;

    /**
     * The Physical Card identifier for this payment.
     */
    #[Required('physical_card_id')]
    public ?string $physicalCardID;

    /**
     * The scheme fees associated with this card payment.
     *
     * @var list<SchemeFee> $schemeFees
     */
    #[Required('scheme_fees', list: SchemeFee::class)]
    public array $schemeFees;

    /**
     * The summarized state of this card payment.
     */
    #[Required]
    public State $state;

    /**
     * A constant representing the object's type. For this resource it will always be `card_payment`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CardPayment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardPayment::with(
     *   id: ...,
     *   accountID: ...,
     *   cardID: ...,
     *   createdAt: ...,
     *   digitalWalletTokenID: ...,
     *   elements: ...,
     *   physicalCardID: ...,
     *   schemeFees: ...,
     *   state: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardPayment)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withCardID(...)
     *   ->withCreatedAt(...)
     *   ->withDigitalWalletTokenID(...)
     *   ->withElements(...)
     *   ->withPhysicalCardID(...)
     *   ->withSchemeFees(...)
     *   ->withState(...)
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
     * @param list<Element|ElementShape> $elements
     * @param list<SchemeFee|SchemeFeeShape> $schemeFees
     * @param State|StateShape $state
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        string $cardID,
        \DateTimeInterface $createdAt,
        ?string $digitalWalletTokenID,
        array $elements,
        ?string $physicalCardID,
        array $schemeFees,
        State|array $state,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['cardID'] = $cardID;
        $self['createdAt'] = $createdAt;
        $self['digitalWalletTokenID'] = $digitalWalletTokenID;
        $self['elements'] = $elements;
        $self['physicalCardID'] = $physicalCardID;
        $self['schemeFees'] = $schemeFees;
        $self['state'] = $state;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Card Payment identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier for the Account the Transaction belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The Card identifier for this payment.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Card Payment was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The Digital Wallet Token identifier for this payment.
     */
    public function withDigitalWalletTokenID(
        ?string $digitalWalletTokenID
    ): self {
        $self = clone $this;
        $self['digitalWalletTokenID'] = $digitalWalletTokenID;

        return $self;
    }

    /**
     * The interactions related to this card payment.
     *
     * @param list<Element|ElementShape> $elements
     */
    public function withElements(array $elements): self
    {
        $self = clone $this;
        $self['elements'] = $elements;

        return $self;
    }

    /**
     * The Physical Card identifier for this payment.
     */
    public function withPhysicalCardID(?string $physicalCardID): self
    {
        $self = clone $this;
        $self['physicalCardID'] = $physicalCardID;

        return $self;
    }

    /**
     * The scheme fees associated with this card payment.
     *
     * @param list<SchemeFee|SchemeFeeShape> $schemeFees
     */
    public function withSchemeFees(array $schemeFees): self
    {
        $self = clone $this;
        $self['schemeFees'] = $schemeFees;

        return $self;
    }

    /**
     * The summarized state of this card payment.
     *
     * @param State|StateShape $state
     */
    public function withState(State|array $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `card_payment`.
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
