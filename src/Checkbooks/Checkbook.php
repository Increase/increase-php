<?php

declare(strict_types=1);

namespace Increase\Checkbooks;

use Increase\Checkbooks\Checkbook\MailingAddress;
use Increase\Checkbooks\Checkbook\Payer;
use Increase\Checkbooks\Checkbook\ReturnAddress;
use Increase\Checkbooks\Checkbook\Status;
use Increase\Checkbooks\Checkbook\Style;
use Increase\Checkbooks\Checkbook\TrackingUpdate;
use Increase\Checkbooks\Checkbook\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Checkbooks are sets of blank checks that Increase prints and mails on your behalf.
 *
 * @phpstan-import-type MailingAddressShape from \Increase\Checkbooks\Checkbook\MailingAddress
 * @phpstan-import-type PayerShape from \Increase\Checkbooks\Checkbook\Payer
 * @phpstan-import-type ReturnAddressShape from \Increase\Checkbooks\Checkbook\ReturnAddress
 * @phpstan-import-type TrackingUpdateShape from \Increase\Checkbooks\Checkbook\TrackingUpdate
 *
 * @phpstan-type CheckbookShape = array{
 *   id: string,
 *   accountNumberID: string,
 *   createdAt: \DateTimeInterface,
 *   idempotencyKey: string|null,
 *   mailingAddress: MailingAddress|MailingAddressShape,
 *   payer: list<Payer|PayerShape>,
 *   returnAddress: ReturnAddress|ReturnAddressShape,
 *   status: Status|value-of<Status>,
 *   style: Style|value-of<Style>,
 *   trackingUpdates: list<TrackingUpdate|TrackingUpdateShape>,
 *   type: Type|value-of<Type>,
 * }
 */
final class Checkbook implements BaseModel
{
    /** @use SdkModel<CheckbookShape> */
    use SdkModel;

    /**
     * The Checkbook's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier of the Account Number the Checkbook is attached to.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Checkbook was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The destination address that the Checkbook will be mailed to.
     */
    #[Required('mailing_address')]
    public MailingAddress $mailingAddress;

    /**
     * The payer information printed on the top-left corner of each check.
     *
     * @var list<Payer> $payer
     */
    #[Required(list: Payer::class)]
    public array $payer;

    /**
     * The address the Checkbook will return to if there is a delivery issue.
     */
    #[Required('return_address')]
    public ReturnAddress $returnAddress;

    /**
     * The lifecycle status of the Checkbook.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * The physical format of the Checkbook.
     *
     * @var value-of<Style> $style
     */
    #[Required(enum: Style::class)]
    public string $style;

    /**
     * Tracking updates relating to the Checkbook's delivery.
     *
     * @var list<TrackingUpdate> $trackingUpdates
     */
    #[Required('tracking_updates', list: TrackingUpdate::class)]
    public array $trackingUpdates;

    /**
     * A constant representing the object's type. For this resource it will always be `checkbook`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new Checkbook()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Checkbook::with(
     *   id: ...,
     *   accountNumberID: ...,
     *   createdAt: ...,
     *   idempotencyKey: ...,
     *   mailingAddress: ...,
     *   payer: ...,
     *   returnAddress: ...,
     *   status: ...,
     *   style: ...,
     *   trackingUpdates: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Checkbook)
     *   ->withID(...)
     *   ->withAccountNumberID(...)
     *   ->withCreatedAt(...)
     *   ->withIdempotencyKey(...)
     *   ->withMailingAddress(...)
     *   ->withPayer(...)
     *   ->withReturnAddress(...)
     *   ->withStatus(...)
     *   ->withStyle(...)
     *   ->withTrackingUpdates(...)
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
     * @param MailingAddress|MailingAddressShape $mailingAddress
     * @param list<Payer|PayerShape> $payer
     * @param ReturnAddress|ReturnAddressShape $returnAddress
     * @param Status|value-of<Status> $status
     * @param Style|value-of<Style> $style
     * @param list<TrackingUpdate|TrackingUpdateShape> $trackingUpdates
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountNumberID,
        \DateTimeInterface $createdAt,
        ?string $idempotencyKey,
        MailingAddress|array $mailingAddress,
        array $payer,
        ReturnAddress|array $returnAddress,
        Status|string $status,
        Style|string $style,
        array $trackingUpdates,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountNumberID'] = $accountNumberID;
        $self['createdAt'] = $createdAt;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['mailingAddress'] = $mailingAddress;
        $self['payer'] = $payer;
        $self['returnAddress'] = $returnAddress;
        $self['status'] = $status;
        $self['style'] = $style;
        $self['trackingUpdates'] = $trackingUpdates;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Checkbook's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier of the Account Number the Checkbook is attached to.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Checkbook was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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
     * The destination address that the Checkbook will be mailed to.
     *
     * @param MailingAddress|MailingAddressShape $mailingAddress
     */
    public function withMailingAddress(
        MailingAddress|array $mailingAddress
    ): self {
        $self = clone $this;
        $self['mailingAddress'] = $mailingAddress;

        return $self;
    }

    /**
     * The payer information printed on the top-left corner of each check.
     *
     * @param list<Payer|PayerShape> $payer
     */
    public function withPayer(array $payer): self
    {
        $self = clone $this;
        $self['payer'] = $payer;

        return $self;
    }

    /**
     * The address the Checkbook will return to if there is a delivery issue.
     *
     * @param ReturnAddress|ReturnAddressShape $returnAddress
     */
    public function withReturnAddress(ReturnAddress|array $returnAddress): self
    {
        $self = clone $this;
        $self['returnAddress'] = $returnAddress;

        return $self;
    }

    /**
     * The lifecycle status of the Checkbook.
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
     * The physical format of the Checkbook.
     *
     * @param Style|value-of<Style> $style
     */
    public function withStyle(Style|string $style): self
    {
        $self = clone $this;
        $self['style'] = $style;

        return $self;
    }

    /**
     * Tracking updates relating to the Checkbook's delivery.
     *
     * @param list<TrackingUpdate|TrackingUpdateShape> $trackingUpdates
     */
    public function withTrackingUpdates(array $trackingUpdates): self
    {
        $self = clone $this;
        $self['trackingUpdates'] = $trackingUpdates;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `checkbook`.
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
