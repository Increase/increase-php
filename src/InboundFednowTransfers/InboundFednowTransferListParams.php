<?php

declare(strict_types=1);

namespace Increase\InboundFednowTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundFednowTransfers\InboundFednowTransferListParams\CreatedAt;

/**
 * List Inbound FedNow Transfers.
 *
 * @see Increase\Services\InboundFednowTransfersService::list()
 *
 * @phpstan-import-type CreatedAtShape from \Increase\InboundFednowTransfers\InboundFednowTransferListParams\CreatedAt
 *
 * @phpstan-type InboundFednowTransferListParamsShape = array{
 *   accountID?: string|null,
 *   accountNumberID?: string|null,
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   cursor?: string|null,
 *   limit?: int|null,
 * }
 */
final class InboundFednowTransferListParams implements BaseModel
{
    /** @use SdkModel<InboundFednowTransferListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter Inbound FedNow Transfers to those belonging to the specified Account.
     */
    #[Optional]
    public ?string $accountID;

    /**
     * Filter Inbound FedNow Transfers to ones belonging to the specified Account Number.
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
     * Filter Inbound FedNow Transfers to those belonging to the specified Account.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Filter Inbound FedNow Transfers to ones belonging to the specified Account Number.
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
