<?php

declare(strict_types=1);

namespace Increase\FileLinks;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\FileLinks\FileLink\Type;

/**
 * File Links let you generate a URL that can be used to download a File.
 *
 * @phpstan-type FileLinkShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   expiresAt: \DateTimeInterface,
 *   fileID: string,
 *   idempotencyKey: string|null,
 *   type: Type|value-of<Type>,
 *   unauthenticatedURL: string,
 * }
 */
final class FileLink implements BaseModel
{
    /** @use SdkModel<FileLinkShape> */
    use SdkModel;

    /**
     * The File Link identifier.
     */
    #[Required]
    public string $id;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the File Link was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the File Link will expire.
     */
    #[Required('expires_at')]
    public \DateTimeInterface $expiresAt;

    /**
     * The identifier of the File the File Link points to.
     */
    #[Required('file_id')]
    public string $fileID;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * A constant representing the object's type. For this resource it will always be `file_link`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * A URL where the File can be downloaded. The URL will expire after the `expires_at` time. This URL is unauthenticated and can be used to download the File without an Increase API key.
     */
    #[Required('unauthenticated_url')]
    public string $unauthenticatedURL;

    /**
     * `new FileLink()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileLink::with(
     *   id: ...,
     *   createdAt: ...,
     *   expiresAt: ...,
     *   fileID: ...,
     *   idempotencyKey: ...,
     *   type: ...,
     *   unauthenticatedURL: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileLink)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withExpiresAt(...)
     *   ->withFileID(...)
     *   ->withIdempotencyKey(...)
     *   ->withType(...)
     *   ->withUnauthenticatedURL(...)
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
        string $id,
        \DateTimeInterface $createdAt,
        \DateTimeInterface $expiresAt,
        string $fileID,
        ?string $idempotencyKey,
        Type|string $type,
        string $unauthenticatedURL,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['expiresAt'] = $expiresAt;
        $self['fileID'] = $fileID;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['type'] = $type;
        $self['unauthenticatedURL'] = $unauthenticatedURL;

        return $self;
    }

    /**
     * The File Link identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the File Link was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the File Link will expire.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * The identifier of the File the File Link points to.
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
     * A constant representing the object's type. For this resource it will always be `file_link`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * A URL where the File can be downloaded. The URL will expire after the `expires_at` time. This URL is unauthenticated and can be used to download the File without an Increase API key.
     */
    public function withUnauthenticatedURL(string $unauthenticatedURL): self
    {
        $self = clone $this;
        $self['unauthenticatedURL'] = $unauthenticatedURL;

        return $self;
    }
}
