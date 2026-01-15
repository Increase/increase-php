<?php

declare(strict_types=1);

namespace Increase\CardPayments;

use Increase\CardPayments\CardPaymentListParams\CreatedAt;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * List Card Payments.
 *
 * @see Increase\Services\CardPaymentsService::list()
 *
 * @phpstan-import-type CreatedAtShape from \Increase\CardPayments\CardPaymentListParams\CreatedAt
 *
 * @phpstan-type CardPaymentListParamsShape = array{
 *   accountID?: string|null,
 *   cardID?: string|null,
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   cursor?: string|null,
 *   limit?: int|null,
 * }
 */
final class CardPaymentListParams implements BaseModel
{
    /** @use SdkModel<CardPaymentListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter Card Payments to ones belonging to the specified Account.
     */
    #[Optional]
    public ?string $accountID;

    /**
     * Filter Card Payments to ones belonging to the specified Card.
     */
    #[Optional]
    public ?string $cardID;

    #[Optional]
    public ?CreatedAt $createdAt;

    /**
     * Return the page of entries after this one.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     */
    #[Optional]
    public ?int $limit;

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
        ?string $cardID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $cardID && $self['cardID'] = $cardID;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter Card Payments to ones belonging to the specified Account.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Filter Card Payments to ones belonging to the specified Card.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

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
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
