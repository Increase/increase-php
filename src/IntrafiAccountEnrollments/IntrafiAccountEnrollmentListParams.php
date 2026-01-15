<?php

declare(strict_types=1);

namespace Increase\IntrafiAccountEnrollments;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollmentListParams\Status;

/**
 * List IntraFi Account Enrollments.
 *
 * @see Increase\Services\IntrafiAccountEnrollmentsService::list()
 *
 * @phpstan-import-type StatusShape from \Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollmentListParams\Status
 *
 * @phpstan-type IntrafiAccountEnrollmentListParamsShape = array{
 *   accountID?: string|null,
 *   cursor?: string|null,
 *   idempotencyKey?: string|null,
 *   limit?: int|null,
 *   status?: null|Status|StatusShape,
 * }
 */
final class IntrafiAccountEnrollmentListParams implements BaseModel
{
    /** @use SdkModel<IntrafiAccountEnrollmentListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter IntraFi Account Enrollments to the one belonging to an account.
     */
    #[Optional]
    public ?string $accountID;

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
     * @param Status|StatusShape|null $status
     */
    public static function with(
        ?string $accountID = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        Status|array|null $status = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $limit && $self['limit'] = $limit;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Filter IntraFi Account Enrollments to the one belonging to an account.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

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
     * @param Status|StatusShape $status
     */
    public function withStatus(Status|array $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
