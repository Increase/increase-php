<?php

declare(strict_types=1);

namespace Increase\OAuthConnections;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\OAuthConnections\OAuthConnectionListParams\Status;

/**
 * List OAuth Connections.
 *
 * @see Increase\Services\OAuthConnectionsService::list()
 *
 * @phpstan-import-type StatusShape from \Increase\OAuthConnections\OAuthConnectionListParams\Status
 *
 * @phpstan-type OAuthConnectionListParamsShape = array{
 *   cursor?: string|null,
 *   limit?: int|null,
 *   oauthApplicationID?: string|null,
 *   status?: null|Status|StatusShape,
 * }
 */
final class OAuthConnectionListParams implements BaseModel
{
    /** @use SdkModel<OAuthConnectionListParamsShape> */
    use SdkModel;
    use SdkParams;

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

    /**
     * Filter results to only include OAuth Connections for a specific OAuth Application.
     */
    #[Optional]
    public ?string $oauthApplicationID;

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
        ?string $cursor = null,
        ?int $limit = null,
        ?string $oauthApplicationID = null,
        Status|array|null $status = null,
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $oauthApplicationID && $self['oauthApplicationID'] = $oauthApplicationID;
        null !== $status && $self['status'] = $status;

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
     * Filter results to only include OAuth Connections for a specific OAuth Application.
     */
    public function withOAuthApplicationID(string $oauthApplicationID): self
    {
        $self = clone $this;
        $self['oauthApplicationID'] = $oauthApplicationID;

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
