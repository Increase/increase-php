<?php

declare(strict_types=1);

namespace Increase\Cards;

use Increase\Cards\Card\BillingAddress;
use Increase\Cards\Card\DigitalWallet;
use Increase\Cards\Card\Status;
use Increase\Cards\Card\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Cards are commercial credit cards. They'll immediately work for online purchases after you create them. All cards maintain a credit limit of 100% of the Account’s available balance at the time of transaction. Funds are deducted from the Account upon transaction settlement.
 *
 * @phpstan-import-type BillingAddressShape from \Increase\Cards\Card\BillingAddress
 * @phpstan-import-type DigitalWalletShape from \Increase\Cards\Card\DigitalWallet
 *
 * @phpstan-type CardShape = array{
 *   id: string,
 *   accountID: string,
 *   billingAddress: BillingAddress|BillingAddressShape,
 *   createdAt: \DateTimeInterface,
 *   description: string|null,
 *   digitalWallet: null|DigitalWallet|DigitalWalletShape,
 *   entityID: string|null,
 *   expirationMonth: int,
 *   expirationYear: int,
 *   idempotencyKey: string|null,
 *   last4: string,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class Card implements BaseModel
{
    /** @use SdkModel<CardShape> */
    use SdkModel;

    /**
     * The card identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier for the account this card belongs to.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The Card's billing address.
     */
    #[Required('billing_address')]
    public BillingAddress $billingAddress;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The card's description for display purposes.
     */
    #[Required]
    public ?string $description;

    /**
     * The contact information used in the two-factor steps for digital wallet card creation. At least one field must be present to complete the digital wallet steps.
     */
    #[Required('digital_wallet')]
    public ?DigitalWallet $digitalWallet;

    /**
     * The identifier for the entity associated with this card.
     */
    #[Required('entity_id')]
    public ?string $entityID;

    /**
     * The month the card expires in M format (e.g., August is 8).
     */
    #[Required('expiration_month')]
    public int $expirationMonth;

    /**
     * The year the card expires in YYYY format (e.g., 2025).
     */
    #[Required('expiration_year')]
    public int $expirationYear;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The last 4 digits of the Card's Primary Account Number.
     */
    #[Required]
    public string $last4;

    /**
     * This indicates if payments can be made with the card.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `card`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new Card()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Card::with(
     *   id: ...,
     *   accountID: ...,
     *   billingAddress: ...,
     *   createdAt: ...,
     *   description: ...,
     *   digitalWallet: ...,
     *   entityID: ...,
     *   expirationMonth: ...,
     *   expirationYear: ...,
     *   idempotencyKey: ...,
     *   last4: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Card)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withBillingAddress(...)
     *   ->withCreatedAt(...)
     *   ->withDescription(...)
     *   ->withDigitalWallet(...)
     *   ->withEntityID(...)
     *   ->withExpirationMonth(...)
     *   ->withExpirationYear(...)
     *   ->withIdempotencyKey(...)
     *   ->withLast4(...)
     *   ->withStatus(...)
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
     * @param BillingAddress|BillingAddressShape $billingAddress
     * @param DigitalWallet|DigitalWalletShape|null $digitalWallet
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        BillingAddress|array $billingAddress,
        \DateTimeInterface $createdAt,
        ?string $description,
        DigitalWallet|array|null $digitalWallet,
        ?string $entityID,
        int $expirationMonth,
        int $expirationYear,
        ?string $idempotencyKey,
        string $last4,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['billingAddress'] = $billingAddress;
        $self['createdAt'] = $createdAt;
        $self['description'] = $description;
        $self['digitalWallet'] = $digitalWallet;
        $self['entityID'] = $entityID;
        $self['expirationMonth'] = $expirationMonth;
        $self['expirationYear'] = $expirationYear;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['last4'] = $last4;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The card identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier for the account this card belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The Card's billing address.
     *
     * @param BillingAddress|BillingAddressShape $billingAddress
     */
    public function withBillingAddress(
        BillingAddress|array $billingAddress
    ): self {
        $self = clone $this;
        $self['billingAddress'] = $billingAddress;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The card's description for display purposes.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The contact information used in the two-factor steps for digital wallet card creation. At least one field must be present to complete the digital wallet steps.
     *
     * @param DigitalWallet|DigitalWalletShape|null $digitalWallet
     */
    public function withDigitalWallet(
        DigitalWallet|array|null $digitalWallet
    ): self {
        $self = clone $this;
        $self['digitalWallet'] = $digitalWallet;

        return $self;
    }

    /**
     * The identifier for the entity associated with this card.
     */
    public function withEntityID(?string $entityID): self
    {
        $self = clone $this;
        $self['entityID'] = $entityID;

        return $self;
    }

    /**
     * The month the card expires in M format (e.g., August is 8).
     */
    public function withExpirationMonth(int $expirationMonth): self
    {
        $self = clone $this;
        $self['expirationMonth'] = $expirationMonth;

        return $self;
    }

    /**
     * The year the card expires in YYYY format (e.g., 2025).
     */
    public function withExpirationYear(int $expirationYear): self
    {
        $self = clone $this;
        $self['expirationYear'] = $expirationYear;

        return $self;
    }

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * The last 4 digits of the Card's Primary Account Number.
     */
    public function withLast4(string $last4): self
    {
        $self = clone $this;
        $self['last4'] = $last4;

        return $self;
    }

    /**
     * This indicates if payments can be made with the card.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `card`.
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
