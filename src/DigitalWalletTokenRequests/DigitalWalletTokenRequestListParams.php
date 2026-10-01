<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokenRequests;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequestListParams\CreatedAt;

/**
 * List Digital Wallet Token Requests.
 *
 * @see Increase\Services\DigitalWalletTokenRequestsService::list()
 *
 * @phpstan-import-type CreatedAtShape from \Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequestListParams\CreatedAt
 *
 * @phpstan-type DigitalWalletTokenRequestListParamsShape = array{
 *   cardID?: string|null,
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   cursor?: string|null,
 *   limit?: int|null,
 * }
 */
final class DigitalWalletTokenRequestListParams implements BaseModel
{
    /** @use SdkModel<DigitalWalletTokenRequestListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter Digital Wallet Token Requests to ones for the specified Card.
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
     *
     * Defaults to `100`.
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
        ?string $cardID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
    ): self {
        $self = new self;

        null !== $cardID && $self['cardID'] = $cardID;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter Digital Wallet Token Requests to ones for the specified Card.
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
     *
     * Defaults to `100`.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
