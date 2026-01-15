<?php

declare(strict_types=1);

namespace Increase\InboundWireTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundWireTransfers\InboundWireTransferListParams\CreatedAt;
use Increase\InboundWireTransfers\InboundWireTransferListParams\Status;

/**
 * List Inbound Wire Transfers.
 *
 * @see Increase\Services\InboundWireTransfersService::list()
 *
 * @phpstan-import-type CreatedAtShape from \Increase\InboundWireTransfers\InboundWireTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\InboundWireTransfers\InboundWireTransferListParams\Status
 *
 * @phpstan-type InboundWireTransferListParamsShape = array{
 *   accountID?: string|null,
 *   accountNumberID?: string|null,
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   cursor?: string|null,
 *   limit?: int|null,
 *   status?: null|Status|StatusShape,
 *   wireDrawdownRequestID?: string|null,
 * }
 */
final class InboundWireTransferListParams implements BaseModel
{
    /** @use SdkModel<InboundWireTransferListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter Inbound Wire Transfers to ones belonging to the specified Account.
     */
    #[Optional]
    public ?string $accountID;

    /**
     * Filter Inbound Wire Transfers to ones belonging to the specified Account Number.
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

    #[Optional]
    public ?Status $status;

    /**
     * Filter Inbound Wire Transfers to ones belonging to the specified Wire Drawdown Request.
     */
    #[Optional]
    public ?string $wireDrawdownRequestID;

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
        ?string $accountID = null,
        ?string $accountNumberID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
        Status|array|null $status = null,
        ?string $wireDrawdownRequestID = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $accountNumberID && $self['accountNumberID'] = $accountNumberID;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $status && $self['status'] = $status;
        null !== $wireDrawdownRequestID && $self['wireDrawdownRequestID'] = $wireDrawdownRequestID;

        return $self;
    }

    /**
     * Filter Inbound Wire Transfers to ones belonging to the specified Account.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Filter Inbound Wire Transfers to ones belonging to the specified Account Number.
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

    /**
     * @param Status|StatusShape $status
     */
    public function withStatus(Status|array $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Filter Inbound Wire Transfers to ones belonging to the specified Wire Drawdown Request.
     */
    public function withWireDrawdownRequestID(
        string $wireDrawdownRequestID
    ): self {
        $self = clone $this;
        $self['wireDrawdownRequestID'] = $wireDrawdownRequestID;

        return $self;
    }
}
