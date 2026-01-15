<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer;

use Increase\ACHTransfers\ACHTransfer\InboundFundsHold\Currency;
use Increase\ACHTransfers\ACHTransfer\InboundFundsHold\Status;
use Increase\ACHTransfers\ACHTransfer\InboundFundsHold\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Increase will sometimes hold the funds for ACH debit transfers. If funds are held, this sub-object will contain details of the hold.
 *
 * @phpstan-type InboundFundsHoldShape = array{
 *   amount: int,
 *   automaticallyReleasesAt: \DateTimeInterface,
 *   createdAt: \DateTimeInterface,
 *   currency: \Increase\ACHTransfers\ACHTransfer\InboundFundsHold\Currency|value-of<\Increase\ACHTransfers\ACHTransfer\InboundFundsHold\Currency>,
 *   heldTransactionID: string|null,
 *   pendingTransactionID: string|null,
 *   releasedAt: \DateTimeInterface|null,
 *   status: \Increase\ACHTransfers\ACHTransfer\InboundFundsHold\Status|value-of<\Increase\ACHTransfers\ACHTransfer\InboundFundsHold\Status>,
 *   type: \Increase\ACHTransfers\ACHTransfer\InboundFundsHold\Type|value-of<\Increase\ACHTransfers\ACHTransfer\InboundFundsHold\Type>,
 * }
 */
final class InboundFundsHold implements BaseModel
{
    /** @use SdkModel<InboundFundsHoldShape> */
    use SdkModel;

    /**
     * The held amount in the minor unit of the account's currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * When the hold will be released automatically. Certain conditions may cause it to be released before this time.
     */
    #[Required('automatically_releases_at')]
    public \DateTimeInterface $automaticallyReleasesAt;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the hold was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the hold's currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(
        enum: Currency::class
    )]
    public string $currency;

    /**
     * The ID of the Transaction for which funds were held.
     */
    #[Required('held_transaction_id')]
    public ?string $heldTransactionID;

    /**
     * The ID of the Pending Transaction representing the held funds.
     */
    #[Required('pending_transaction_id')]
    public ?string $pendingTransactionID;

    /**
     * When the hold was released (if it has been released).
     */
    #[Required('released_at')]
    public ?\DateTimeInterface $releasedAt;

    /**
     * The status of the hold.
     *
     * @var value-of<Status> $status
     */
    #[Required(
        enum: Status::class
    )]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_funds_hold`.
     *
     * @var value-of<Type> $type
     */
    #[Required(
        enum: Type::class
    )]
    public string $type;

    /**
     * `new InboundFundsHold()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundFundsHold::with(
     *   amount: ...,
     *   automaticallyReleasesAt: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   heldTransactionID: ...,
     *   pendingTransactionID: ...,
     *   releasedAt: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundFundsHold)
     *   ->withAmount(...)
     *   ->withAutomaticallyReleasesAt(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withHeldTransactionID(...)
     *   ->withPendingTransactionID(...)
     *   ->withReleasedAt(...)
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
     * @param Currency|value-of<Currency> $currency
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        int $amount,
        \DateTimeInterface $automaticallyReleasesAt,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        ?string $heldTransactionID,
        ?string $pendingTransactionID,
        ?\DateTimeInterface $releasedAt,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['automaticallyReleasesAt'] = $automaticallyReleasesAt;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['heldTransactionID'] = $heldTransactionID;
        $self['pendingTransactionID'] = $pendingTransactionID;
        $self['releasedAt'] = $releasedAt;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The held amount in the minor unit of the account's currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * When the hold will be released automatically. Certain conditions may cause it to be released before this time.
     */
    public function withAutomaticallyReleasesAt(
        \DateTimeInterface $automaticallyReleasesAt
    ): self {
        $self = clone $this;
        $self['automaticallyReleasesAt'] = $automaticallyReleasesAt;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the hold was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the hold's currency.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(
        Currency|string $currency,
    ): self {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The ID of the Transaction for which funds were held.
     */
    public function withHeldTransactionID(?string $heldTransactionID): self
    {
        $self = clone $this;
        $self['heldTransactionID'] = $heldTransactionID;

        return $self;
    }

    /**
     * The ID of the Pending Transaction representing the held funds.
     */
    public function withPendingTransactionID(
        ?string $pendingTransactionID
    ): self {
        $self = clone $this;
        $self['pendingTransactionID'] = $pendingTransactionID;

        return $self;
    }

    /**
     * When the hold was released (if it has been released).
     */
    public function withReleasedAt(?\DateTimeInterface $releasedAt): self
    {
        $self = clone $this;
        $self['releasedAt'] = $releasedAt;

        return $self;
    }

    /**
     * The status of the hold.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(
        Status|string $status
    ): self {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_funds_hold`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(
        Type|string $type
    ): self {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
