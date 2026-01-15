<?php

declare(strict_types=1);

namespace Increase\SupplementalDocuments;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * List Entity Supplemental Document Submissions.
 *
 * @see Increase\Services\SupplementalDocumentsService::list()
 *
 * @phpstan-type SupplementalDocumentListParamsShape = array{
 *   entityID: string,
 *   cursor?: string|null,
 *   idempotencyKey?: string|null,
 *   limit?: int|null,
 * }
 */
final class SupplementalDocumentListParams implements BaseModel
{
    /** @use SdkModel<SupplementalDocumentListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Entity to list supplemental documents for.
     */
    #[Required]
    public string $entityID;

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

    /**
     * `new SupplementalDocumentListParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SupplementalDocumentListParams::with(entityID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SupplementalDocumentListParams)->withEntityID(...)
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
     */
    public static function with(
        string $entityID,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
    ): self {
        $self = new self;

        $self['entityID'] = $entityID;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * The identifier of the Entity to list supplemental documents for.
     */
    public function withEntityID(string $entityID): self
    {
        $self = clone $this;
        $self['entityID'] = $entityID;

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
}
