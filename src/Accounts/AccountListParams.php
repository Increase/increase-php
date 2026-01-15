<?php

declare(strict_types=1);

namespace Increase\Accounts;

use Increase\Accounts\AccountListParams\CreatedAt;
use Increase\Accounts\AccountListParams\Status;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * List Accounts.
 *
 * @see Increase\Services\AccountsService::list()
 *
 * @phpstan-import-type CreatedAtShape from \Increase\Accounts\AccountListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\Accounts\AccountListParams\Status
 *
 * @phpstan-type AccountListParamsShape = array{
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   cursor?: string|null,
 *   entityID?: string|null,
 *   idempotencyKey?: string|null,
 *   informationalEntityID?: string|null,
 *   limit?: int|null,
 *   programID?: string|null,
 *   status?: null|Status|StatusShape,
 * }
 */
final class AccountListParams implements BaseModel
{
    /** @use SdkModel<AccountListParamsShape> */
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
     * Filter Accounts for those belonging to the specified Entity.
     */
    #[Optional]
    public ?string $entityID;

    /**
     * Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Optional]
    public ?string $idempotencyKey;

    /**
     * Filter Accounts for those belonging to the specified Entity as informational.
     */
    #[Optional]
    public ?string $informationalEntityID;

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter Accounts for those in a specific Program.
     */
    #[Optional]
    public ?string $programID;

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
     * @param CreatedAt|CreatedAtShape|null $createdAt
     * @param Status|StatusShape|null $status
     */
    public static function with(
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $entityID = null,
        ?string $idempotencyKey = null,
        ?string $informationalEntityID = null,
        ?int $limit = null,
        ?string $programID = null,
        Status|array|null $status = null,
    ): self {
        $self = new self;

        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $entityID && $self['entityID'] = $entityID;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $informationalEntityID && $self['informationalEntityID'] = $informationalEntityID;
        null !== $limit && $self['limit'] = $limit;
        null !== $programID && $self['programID'] = $programID;
        null !== $status && $self['status'] = $status;

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
     * Filter Accounts for those belonging to the specified Entity.
     */
    public function withEntityID(string $entityID): self
    {
        $self = clone $this;
        $self['entityID'] = $entityID;

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
     * Filter Accounts for those belonging to the specified Entity as informational.
     */
    public function withInformationalEntityID(
        string $informationalEntityID
    ): self {
        $self = clone $this;
        $self['informationalEntityID'] = $informationalEntityID;

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
     * Filter Accounts for those in a specific Program.
     */
    public function withProgramID(string $programID): self
    {
        $self = clone $this;
        $self['programID'] = $programID;

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
