<?php

declare(strict_types=1);

namespace Increase\Files;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Files\FileListParams\CreatedAt;
use Increase\Files\FileListParams\Purpose;

/**
 * List Files.
 *
 * @see Increase\Services\FilesService::list()
 *
 * @phpstan-import-type CreatedAtShape from \Increase\Files\FileListParams\CreatedAt
 * @phpstan-import-type PurposeShape from \Increase\Files\FileListParams\Purpose
 *
 * @phpstan-type FileListParamsShape = array{
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   cursor?: string|null,
 *   idempotencyKey?: string|null,
 *   limit?: int|null,
 *   purpose?: null|Purpose|PurposeShape,
 * }
 */
final class FileListParams implements BaseModel
{
    /** @use SdkModel<FileListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?CreatedAt $createdAt;

    /**
     * Return the page of entries after this one.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Optional]
    public ?string $idempotencyKey;

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     */
    #[Optional]
    public ?int $limit;

    #[Optional]
    public ?Purpose $purpose;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CreatedAt|CreatedAtShape|null $createdAt
     * @param Purpose|PurposeShape|null $purpose
     */
    public static function with(
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        Purpose|array|null $purpose = null,
    ): self {
        $self = new self;

        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $limit && $self['limit'] = $limit;
        null !== $purpose && $self['purpose'] = $purpose;

        return $self;
    }

    /**
     * @param CreatedAt|CreatedAtShape $createdAt
     */
    public function withCreatedAt(CreatedAt|array $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Return the page of entries after this one.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    public function withIdempotencyKey(string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * @param Purpose|PurposeShape $purpose
     */
    public function withPurpose(Purpose|array $purpose): self
    {
        $self = clone $this;
        $self['purpose'] = $purpose;

        return $self;
    }
}
