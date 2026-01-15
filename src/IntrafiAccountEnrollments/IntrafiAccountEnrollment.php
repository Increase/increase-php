<?php

declare(strict_types=1);

namespace Increase\IntrafiAccountEnrollments;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollment\Status;
use Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollment\Type;

/**
 * IntraFi is a [network of financial institutions](https://www.intrafi.com/network-banks) that allows Increase users to sweep funds to multiple banks. This enables accounts to become eligible for additional Federal Deposit Insurance Corporation (FDIC) insurance. An IntraFi Account Enrollment object represents the status of an account in the network. Sweeping an account to IntraFi doesn't affect funds availability.
 *
 * @phpstan-type IntrafiAccountEnrollmentShape = array{
 *   id: string,
 *   accountID: string,
 *   createdAt: \DateTimeInterface,
 *   emailAddress: string|null,
 *   idempotencyKey: string|null,
 *   intrafiID: string,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class IntrafiAccountEnrollment implements BaseModel
{
    /** @use SdkModel<IntrafiAccountEnrollmentShape> */
    use SdkModel;

    /**
     * The identifier of this enrollment at IntraFi.
     */
    #[Required]
    public string $id;

    /**
     * The identifier of the Increase Account being swept into the network.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the enrollment was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The contact email for the account owner, to be shared with IntraFi.
     */
    #[Required('email_address')]
    public ?string $emailAddress;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The identifier of the account in IntraFi's system. This identifier will be printed on any IntraFi statements or documents.
     */
    #[Required('intrafi_id')]
    public string $intrafiID;

    /**
     * The status of the account in the network. An account takes about one business day to go from `pending_enrolling` to `enrolled`.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `intrafi_account_enrollment`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new IntrafiAccountEnrollment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * IntrafiAccountEnrollment::with(
     *   id: ...,
     *   accountID: ...,
     *   createdAt: ...,
     *   emailAddress: ...,
     *   idempotencyKey: ...,
     *   intrafiID: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new IntrafiAccountEnrollment)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withCreatedAt(...)
     *   ->withEmailAddress(...)
     *   ->withIdempotencyKey(...)
     *   ->withIntrafiID(...)
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
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        \DateTimeInterface $createdAt,
        ?string $emailAddress,
        ?string $idempotencyKey,
        string $intrafiID,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['createdAt'] = $createdAt;
        $self['emailAddress'] = $emailAddress;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['intrafiID'] = $intrafiID;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The identifier of this enrollment at IntraFi.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier of the Increase Account being swept into the network.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the enrollment was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The contact email for the account owner, to be shared with IntraFi.
     */
    public function withEmailAddress(?string $emailAddress): self
    {
        $self = clone $this;
        $self['emailAddress'] = $emailAddress;

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
     * The identifier of the account in IntraFi's system. This identifier will be printed on any IntraFi statements or documents.
     */
    public function withIntrafiID(string $intrafiID): self
    {
        $self = clone $this;
        $self['intrafiID'] = $intrafiID;

        return $self;
    }

    /**
     * The status of the account in the network. An account takes about one business day to go from `pending_enrolling` to `enrolled`.
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
     * A constant representing the object's type. For this resource it will always be `intrafi_account_enrollment`.
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
