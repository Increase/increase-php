<?php

declare(strict_types=1);

namespace Increase\LockboxRecipients;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\LockboxRecipients\LockboxRecipient\Status;
use Increase\LockboxRecipients\LockboxRecipient\Type;

/**
 * Lockbox Recipients represent an inbox at a Lockbox Address. Checks received for a Lockbox Recipient are deposited into its associated Account.
 *
 * @phpstan-type LockboxRecipientShape = array{
 *   id: string,
 *   accountID: string,
 *   createdAt: \DateTimeInterface,
 *   description: string|null,
 *   idempotencyKey: string|null,
 *   lockboxAddressID: string,
 *   mailStopCode: string,
 *   recipientName: string|null,
 *   status: null|Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class LockboxRecipient implements BaseModel
{
    /** @use SdkModel<LockboxRecipientShape> */
    use SdkModel;

    /**
     * The Lockbox Recipient identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier for the Account that checks sent to this Lockbox Recipient will be deposited into.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Lockbox Recipient was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The description of the Lockbox Recipient.
     */
    #[Required]
    public ?string $description;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The identifier for the Lockbox Address where this Lockbox Recipient may receive physical mail.
     */
    #[Required('lockbox_address_id')]
    public string $lockboxAddressID;

    /**
     * The mail stop code uniquely identifying this Lockbox Recipient at its Lockbox Address. It should be included in the mailing address intended for this Lockbox Recipient.
     */
    #[Required('mail_stop_code')]
    public string $mailStopCode;

    /**
     * The name of the Lockbox Recipient.
     */
    #[Required('recipient_name')]
    public ?string $recipientName;

    /**
     * The status of the Lockbox Recipient.
     *
     * @var value-of<Status>|null $status
     */
    #[Required(enum: Status::class)]
    public ?string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `lockbox_recipient`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new LockboxRecipient()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LockboxRecipient::with(
     *   id: ...,
     *   accountID: ...,
     *   createdAt: ...,
     *   description: ...,
     *   idempotencyKey: ...,
     *   lockboxAddressID: ...,
     *   mailStopCode: ...,
     *   recipientName: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LockboxRecipient)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withCreatedAt(...)
     *   ->withDescription(...)
     *   ->withIdempotencyKey(...)
     *   ->withLockboxAddressID(...)
     *   ->withMailStopCode(...)
     *   ->withRecipientName(...)
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
     * @param Status|value-of<Status>|null $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        \DateTimeInterface $createdAt,
        ?string $description,
        ?string $idempotencyKey,
        string $lockboxAddressID,
        string $mailStopCode,
        ?string $recipientName,
        Status|string|null $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['createdAt'] = $createdAt;
        $self['description'] = $description;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['lockboxAddressID'] = $lockboxAddressID;
        $self['mailStopCode'] = $mailStopCode;
        $self['recipientName'] = $recipientName;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Lockbox Recipient identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier for the Account that checks sent to this Lockbox Recipient will be deposited into.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Lockbox Recipient was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The description of the Lockbox Recipient.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

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
     * The identifier for the Lockbox Address where this Lockbox Recipient may receive physical mail.
     */
    public function withLockboxAddressID(string $lockboxAddressID): self
    {
        $self = clone $this;
        $self['lockboxAddressID'] = $lockboxAddressID;

        return $self;
    }

    /**
     * The mail stop code uniquely identifying this Lockbox Recipient at its Lockbox Address. It should be included in the mailing address intended for this Lockbox Recipient.
     */
    public function withMailStopCode(string $mailStopCode): self
    {
        $self = clone $this;
        $self['mailStopCode'] = $mailStopCode;

        return $self;
    }

    /**
     * The name of the Lockbox Recipient.
     */
    public function withRecipientName(?string $recipientName): self
    {
        $self = clone $this;
        $self['recipientName'] = $recipientName;

        return $self;
    }

    /**
     * The status of the Lockbox Recipient.
     *
     * @param Status|value-of<Status>|null $status
     */
    public function withStatus(Status|string|null $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `lockbox_recipient`.
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
