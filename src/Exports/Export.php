<?php

declare(strict_types=1);

namespace Increase\Exports;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Exports\Export\Category;
use Increase\Exports\Export\Status;
use Increase\Exports\Export\Type;

/**
 * Exports are generated files. Some exports can contain a lot of data, like a CSV of your transactions. Others can be a single document, like a tax form. Since they can take a while, they are generated asynchronously. We send a webhook when they are ready. For more information, please read our [Exports documentation](https://increase.com/documentation/exports).
 *
 * @phpstan-type ExportShape = array{
 *   id: string,
 *   category: Category|value-of<Category>,
 *   createdAt: \DateTimeInterface,
 *   fileDownloadURL: string|null,
 *   fileID: string|null,
 *   idempotencyKey: string|null,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class Export implements BaseModel
{
    /** @use SdkModel<ExportShape> */
    use SdkModel;

    /**
     * The Export identifier.
     */
    #[Required]
    public string $id;

    /**
     * The category of the Export. We may add additional possible values for this enum over time; your application should be able to handle that gracefully.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * The time the Export was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * A URL at which the Export's file can be downloaded. This will be present when the Export's status transitions to `complete`.
     */
    #[Required('file_download_url')]
    public ?string $fileDownloadURL;

    /**
     * The File containing the contents of the Export. This will be present when the Export's status transitions to `complete`.
     */
    #[Required('file_id')]
    public ?string $fileID;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The status of the Export.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `export`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new Export()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Export::with(
     *   id: ...,
     *   category: ...,
     *   createdAt: ...,
     *   fileDownloadURL: ...,
     *   fileID: ...,
     *   idempotencyKey: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Export)
     *   ->withID(...)
     *   ->withCategory(...)
     *   ->withCreatedAt(...)
     *   ->withFileDownloadURL(...)
     *   ->withFileID(...)
     *   ->withIdempotencyKey(...)
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
     * @param Category|value-of<Category> $category
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        Category|string $category,
        \DateTimeInterface $createdAt,
        ?string $fileDownloadURL,
        ?string $fileID,
        ?string $idempotencyKey,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['category'] = $category;
        $self['createdAt'] = $createdAt;
        $self['fileDownloadURL'] = $fileDownloadURL;
        $self['fileID'] = $fileID;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Export identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The category of the Export. We may add additional possible values for this enum over time; your application should be able to handle that gracefully.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * The time the Export was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * A URL at which the Export's file can be downloaded. This will be present when the Export's status transitions to `complete`.
     */
    public function withFileDownloadURL(?string $fileDownloadURL): self
    {
        $self = clone $this;
        $self['fileDownloadURL'] = $fileDownloadURL;

        return $self;
    }

    /**
     * The File containing the contents of the Export. This will be present when the Export's status transitions to `complete`.
     */
    public function withFileID(?string $fileID): self
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
     * The status of the Export.
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
     * A constant representing the object's type. For this resource it will always be `export`.
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
