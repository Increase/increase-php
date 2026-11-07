<?php

declare(strict_types=1);

namespace Increase\AccountNumbers;

use Increase\AccountNumbers\AccountNumberListParams\CreatedAt;
use Increase\AccountNumbers\AccountNumberListParams\InboundACHDebits;
use Increase\AccountNumbers\AccountNumberListParams\Status;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * List Account Numbers.
 *
 * @see Increase\Services\AccountNumbersService::list()
 *
 * @phpstan-import-type CreatedAtShape from \Increase\AccountNumbers\AccountNumberListParams\CreatedAt
 * @phpstan-import-type InboundACHDebitsShape from \Increase\AccountNumbers\AccountNumberListParams\InboundACHDebits
 * @phpstan-import-type StatusShape from \Increase\AccountNumbers\AccountNumberListParams\Status
 *
 * @phpstan-type AccountNumberListParamsShape = array{
 *   accountID?: string|null,
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   cursor?: string|null,
 *   idempotencyKey?: string|null,
 *   inboundACHDebits?: null|InboundACHDebits|InboundACHDebitsShape,
 *   limit?: int|null,
 *   status?: null|Status|StatusShape,
 * }
 */
final class AccountNumberListParams implements BaseModel
{
    /** @use SdkModel<AccountNumberListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter Account Numbers to those belonging to the specified Account.
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

    #[Optional]
    public ?InboundACHDebits $inboundACHDebits;

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     *
     * Defaults to `100`.
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
     * @param CreatedAt|CreatedAtShape|null $createdAt
     * @param InboundACHDebits|InboundACHDebitsShape|null $inboundACHDebits
     * @param Status|StatusShape|null $status
     */
    public static function with(
        ?string $accountID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        InboundACHDebits|array|null $inboundACHDebits = null,
        ?int $limit = null,
        Status|array|null $status = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $inboundACHDebits && $self['inboundACHDebits'] = $inboundACHDebits;
        null !== $limit && $self['limit'] = $limit;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Filter Account Numbers to those belonging to the specified Account.
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
     * @param InboundACHDebits|InboundACHDebitsShape $inboundACHDebits
     */
    public function withInboundACHDebits(
        InboundACHDebits|array $inboundACHDebits
    ): self {
        $self = clone $this;
        $self['inboundACHDebits'] = $inboundACHDebits;

        return $self;
    }

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     *
     * Defaults to `100`.
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
