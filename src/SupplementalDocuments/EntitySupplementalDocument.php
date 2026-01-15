<?php

declare(strict_types=1);

namespace Increase\SupplementalDocuments;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\SupplementalDocuments\EntitySupplementalDocument\Type;

/**
 * Supplemental Documents are uploaded files connected to an Entity during onboarding.
 *
 * @phpstan-type EntitySupplementalDocumentShape = array{
 *   createdAt: \DateTimeInterface,
 *   entityID: string,
 *   fileID: string,
 *   idempotencyKey: string|null,
 *   type: Type|value-of<Type>,
 * }
 */
final class EntitySupplementalDocument implements BaseModel
{
    /** @use SdkModel<EntitySupplementalDocumentShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Supplemental Document was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The Entity the supplemental document is attached to.
     */
    #[Required('entity_id')]
    public string $entityID;

    /**
     * The File containing the document.
     */
    #[Required('file_id')]
    public string $fileID;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * A constant representing the object's type. For this resource it will always be `entity_supplemental_document`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new EntitySupplementalDocument()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntitySupplementalDocument::with(
     *   createdAt: ..., entityID: ..., fileID: ..., idempotencyKey: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntitySupplementalDocument)
     *   ->withCreatedAt(...)
     *   ->withEntityID(...)
     *   ->withFileID(...)
     *   ->withIdempotencyKey(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        \DateTimeInterface $createdAt,
        string $entityID,
        string $fileID,
        ?string $idempotencyKey,
        Type|string $type,
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['entityID'] = $entityID;
        $self['fileID'] = $fileID;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Supplemental Document was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The Entity the supplemental document is attached to.
     */
    public function withEntityID(string $entityID): self
    {
        $self = clone $this;
        $self['entityID'] = $entityID;

        return $self;
    }

    /**
     * The File containing the document.
     */
    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

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
     * A constant representing the object's type. For this resource it will always be `entity_supplemental_document`.
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
