<?php

declare(strict_types=1);

namespace Increase\Exports;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Exports\ExportListParams\Category;
use Increase\Exports\ExportListParams\CreatedAt;
use Increase\Exports\ExportListParams\Form1099Int;
use Increase\Exports\ExportListParams\Form1099Misc;
use Increase\Exports\ExportListParams\Status;

/**
 * List Exports.
 *
 * @see Increase\Services\ExportsService::list()
 *
 * @phpstan-import-type CreatedAtShape from \Increase\Exports\ExportListParams\CreatedAt
 * @phpstan-import-type Form1099IntShape from \Increase\Exports\ExportListParams\Form1099Int
 * @phpstan-import-type Form1099MiscShape from \Increase\Exports\ExportListParams\Form1099Misc
 * @phpstan-import-type StatusShape from \Increase\Exports\ExportListParams\Status
 *
 * @phpstan-type ExportListParamsShape = array{
 *   category?: null|Category|value-of<Category>,
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   cursor?: string|null,
 *   form1099Int?: null|Form1099Int|Form1099IntShape,
 *   form1099Misc?: null|Form1099Misc|Form1099MiscShape,
 *   idempotencyKey?: string|null,
 *   limit?: int|null,
 *   status?: null|Status|StatusShape,
 * }
 */
final class ExportListParams implements BaseModel
{
    /** @use SdkModel<ExportListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter Exports for those with the specified category.
     *
     * @var value-of<Category>|null $category
     */
    #[Optional(enum: Category::class)]
    public ?string $category;

    #[Optional]
    public ?CreatedAt $createdAt;

    /**
     * Return the page of entries after this one.
     */
    #[Optional]
    public ?string $cursor;

    #[Optional]
    public ?Form1099Int $form1099Int;

    #[Optional]
    public ?Form1099Misc $form1099Misc;

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
    public ?Status $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Category|value-of<Category>|null $category
     * @param CreatedAt|CreatedAtShape|null $createdAt
     * @param Form1099Int|Form1099IntShape|null $form1099Int
     * @param Form1099Misc|Form1099MiscShape|null $form1099Misc
     * @param Status|StatusShape|null $status
     */
    public static function with(
        Category|string|null $category = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        Form1099Int|array|null $form1099Int = null,
        Form1099Misc|array|null $form1099Misc = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        Status|array|null $status = null,
    ): self {
        $self = new self;

        null !== $category && $self['category'] = $category;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $form1099Int && $self['form1099Int'] = $form1099Int;
        null !== $form1099Misc && $self['form1099Misc'] = $form1099Misc;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $limit && $self['limit'] = $limit;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Filter Exports for those with the specified category.
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
     * @param Form1099Int|Form1099IntShape $form1099Int
     */
    public function withForm1099Int(Form1099Int|array $form1099Int): self
    {
        $self = clone $this;
        $self['form1099Int'] = $form1099Int;

        return $self;
    }

    /**
     * @param Form1099Misc|Form1099MiscShape $form1099Misc
     */
    public function withForm1099Misc(Form1099Misc|array $form1099Misc): self
    {
        $self = clone $this;
        $self['form1099Misc'] = $form1099Misc;

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
     * @param Status|StatusShape $status
     */
    public function withStatus(Status|array $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
