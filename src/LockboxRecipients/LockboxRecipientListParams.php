<?php

declare(strict_types=1);

namespace Increase\LockboxRecipients;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\LockboxRecipients\LockboxRecipientListParams\CreatedAt;

/**
 * List Lockbox Recipients.
 *
 * @see Increase\Services\LockboxRecipientsService::list()
 *
 * @phpstan-import-type CreatedAtShape from \Increase\LockboxRecipients\LockboxRecipientListParams\CreatedAt
 *
 * @phpstan-type LockboxRecipientListParamsShape = array{
 *   accountID?: string|null,
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   cursor?: string|null,
 *   idempotencyKey?: string|null,
 *   limit?: int|null,
 *   lockboxAddressID?: string|null,
 * }
 */
final class LockboxRecipientListParams implements BaseModel
{
    /** @use SdkModel<LockboxRecipientListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter Lockbox Recipients to those associated with the provided Account.
     */
    #[Optional]
    public ?string $accountID;

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

    /**
     * Filter Lockbox Recipients to those associated with the provided Lockbox Address.
     */
    #[Optional]
    public ?string $lockboxAddressID;

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
     */
    public static function with(
        ?string $accountID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        ?string $lockboxAddressID = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $limit && $self['limit'] = $limit;
        null !== $lockboxAddressID && $self['lockboxAddressID'] = $lockboxAddressID;

        return $self;
    }

    /**
     * Filter Lockbox Recipients to those associated with the provided Account.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

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
     * Filter Lockbox Recipients to those associated with the provided Lockbox Address.
     */
    public function withLockboxAddressID(string $lockboxAddressID): self
    {
        $self = clone $this;
        $self['lockboxAddressID'] = $lockboxAddressID;

        return $self;
    }
}
