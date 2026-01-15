<?php

declare(strict_types=1);

namespace Increase\InboundRealTimePaymentsTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransferListParams\CreatedAt;

/**
 * List Inbound Real-Time Payments Transfers.
 *
 * @see Increase\Services\InboundRealTimePaymentsTransfersService::list()
 *
 * @phpstan-import-type CreatedAtShape from \Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransferListParams\CreatedAt
 *
 * @phpstan-type InboundRealTimePaymentsTransferListParamsShape = array{
 *   accountID?: string|null,
 *   accountNumberID?: string|null,
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   cursor?: string|null,
 *   limit?: int|null,
 * }
 */
final class InboundRealTimePaymentsTransferListParams implements BaseModel
{
    /** @use SdkModel<InboundRealTimePaymentsTransferListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter Inbound Real-Time Payments Transfers to those belonging to the specified Account.
     */
    #[Optional]
    public ?string $accountID;

    /**
     * Filter Inbound Real-Time Payments Transfers to ones belonging to the specified Account Number.
     */
    #[Optional]
    public ?string $accountNumberID;

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
        ?string $accountNumberID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $accountNumberID && $self['accountNumberID'] = $accountNumberID;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter Inbound Real-Time Payments Transfers to those belonging to the specified Account.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Filter Inbound Real-Time Payments Transfers to ones belonging to the specified Account Number.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

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
