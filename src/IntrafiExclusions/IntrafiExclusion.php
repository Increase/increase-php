<?php

declare(strict_types=1);

namespace Increase\IntrafiExclusions;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\IntrafiExclusions\IntrafiExclusion\Status;
use Increase\IntrafiExclusions\IntrafiExclusion\Type;

/**
 * Certain institutions may be excluded per Entity when sweeping funds into the IntraFi network. This is useful when an Entity already has deposits at a particular bank, and does not want to sweep additional funds to it. It may take 5 business days for an exclusion to be processed.
 *
 * @phpstan-type IntrafiExclusionShape = array{
 *   id: string,
 *   bankName: string,
 *   createdAt: \DateTimeInterface,
 *   entityID: string,
 *   excludedAt: \DateTimeInterface|null,
 *   fdicCertificateNumber: string|null,
 *   idempotencyKey: string|null,
 *   status: Status|value-of<Status>,
 *   submittedAt: \DateTimeInterface|null,
 *   type: Type|value-of<Type>,
 * }
 */
final class IntrafiExclusion implements BaseModel
{
    /** @use SdkModel<IntrafiExclusionShape> */
    use SdkModel;

    /**
     * The identifier of this exclusion request.
     */
    #[Required]
    public string $id;

    /**
     * The name of the excluded institution.
     */
    #[Required('bank_name')]
    public string $bankName;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the exclusion was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The entity for which this institution is excluded.
     */
    #[Required('entity_id')]
    public string $entityID;

    /**
     * When this was exclusion was confirmed by IntraFi.
     */
    #[Required('excluded_at')]
    public ?\DateTimeInterface $excludedAt;

    /**
     * The Federal Deposit Insurance Corporation's certificate number for the institution.
     */
    #[Required('fdic_certificate_number')]
    public ?string $fdicCertificateNumber;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The status of the exclusion request.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * When this was exclusion was submitted to IntraFi by Increase.
     */
    #[Required('submitted_at')]
    public ?\DateTimeInterface $submittedAt;

    /**
     * A constant representing the object's type. For this resource it will always be `intrafi_exclusion`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new IntrafiExclusion()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * IntrafiExclusion::with(
     *   id: ...,
     *   bankName: ...,
     *   createdAt: ...,
     *   entityID: ...,
     *   excludedAt: ...,
     *   fdicCertificateNumber: ...,
     *   idempotencyKey: ...,
     *   status: ...,
     *   submittedAt: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new IntrafiExclusion)
     *   ->withID(...)
     *   ->withBankName(...)
     *   ->withCreatedAt(...)
     *   ->withEntityID(...)
     *   ->withExcludedAt(...)
     *   ->withFdicCertificateNumber(...)
     *   ->withIdempotencyKey(...)
     *   ->withStatus(...)
     *   ->withSubmittedAt(...)
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
        string $bankName,
        \DateTimeInterface $createdAt,
        string $entityID,
        ?\DateTimeInterface $excludedAt,
        ?string $fdicCertificateNumber,
        ?string $idempotencyKey,
        Status|string $status,
        ?\DateTimeInterface $submittedAt,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['bankName'] = $bankName;
        $self['createdAt'] = $createdAt;
        $self['entityID'] = $entityID;
        $self['excludedAt'] = $excludedAt;
        $self['fdicCertificateNumber'] = $fdicCertificateNumber;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['status'] = $status;
        $self['submittedAt'] = $submittedAt;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The identifier of this exclusion request.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The name of the excluded institution.
     */
    public function withBankName(string $bankName): self
    {
        $self = clone $this;
        $self['bankName'] = $bankName;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the exclusion was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The entity for which this institution is excluded.
     */
    public function withEntityID(string $entityID): self
    {
        $self = clone $this;
        $self['entityID'] = $entityID;

        return $self;
    }

    /**
     * When this was exclusion was confirmed by IntraFi.
     */
    public function withExcludedAt(?\DateTimeInterface $excludedAt): self
    {
        $self = clone $this;
        $self['excludedAt'] = $excludedAt;

        return $self;
    }

    /**
     * The Federal Deposit Insurance Corporation's certificate number for the institution.
     */
    public function withFdicCertificateNumber(
        ?string $fdicCertificateNumber
    ): self {
        $self = clone $this;
        $self['fdicCertificateNumber'] = $fdicCertificateNumber;

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
     * The status of the exclusion request.
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
     * When this was exclusion was submitted to IntraFi by Increase.
     */
    public function withSubmittedAt(?\DateTimeInterface $submittedAt): self
    {
        $self = clone $this;
        $self['submittedAt'] = $submittedAt;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `intrafi_exclusion`.
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
