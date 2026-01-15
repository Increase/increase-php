<?php

declare(strict_types=1);

namespace Increase\OAuthConnections;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\OAuthConnections\OAuthConnection\Status;
use Increase\OAuthConnections\OAuthConnection\Type;

/**
 * When a user authorizes your OAuth application, an OAuth Connection object is created. Learn more about OAuth [here](https://increase.com/documentation/oauth).
 *
 * @phpstan-type OAuthConnectionShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   deletedAt: \DateTimeInterface|null,
 *   groupID: string,
 *   oauthApplicationID: string,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class OAuthConnection implements BaseModel
{
    /** @use SdkModel<OAuthConnectionShape> */
    use SdkModel;

    /**
     * The OAuth Connection's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp when the OAuth Connection was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp when the OAuth Connection was deleted.
     */
    #[Required('deleted_at')]
    public ?\DateTimeInterface $deletedAt;

    /**
     * The identifier of the Group that has authorized your OAuth application.
     */
    #[Required('group_id')]
    public string $groupID;

    /**
     * The identifier of the OAuth application this connection is for.
     */
    #[Required('oauth_application_id')]
    public string $oauthApplicationID;

    /**
     * Whether the connection is active.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `oauth_connection`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new OAuthConnection()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OAuthConnection::with(
     *   id: ...,
     *   createdAt: ...,
     *   deletedAt: ...,
     *   groupID: ...,
     *   oauthApplicationID: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OAuthConnection)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withDeletedAt(...)
     *   ->withGroupID(...)
     *   ->withOAuthApplicationID(...)
     *   ->withStatus(...)
     *   ->withType(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        ?\DateTimeInterface $deletedAt,
        string $groupID,
        string $oauthApplicationID,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['deletedAt'] = $deletedAt;
        $self['groupID'] = $groupID;
        $self['oauthApplicationID'] = $oauthApplicationID;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The OAuth Connection's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp when the OAuth Connection was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp when the OAuth Connection was deleted.
     */
    public function withDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $self = clone $this;
        $self['deletedAt'] = $deletedAt;

        return $self;
    }

    /**
     * The identifier of the Group that has authorized your OAuth application.
     */
    public function withGroupID(string $groupID): self
    {
        $self = clone $this;
        $self['groupID'] = $groupID;

        return $self;
    }

    /**
     * The identifier of the OAuth application this connection is for.
     */
    public function withOAuthApplicationID(string $oauthApplicationID): self
    {
        $self = clone $this;
        $self['oauthApplicationID'] = $oauthApplicationID;

        return $self;
    }

    /**
     * Whether the connection is active.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `oauth_connection`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
