<?php

declare(strict_types=1);

namespace Increase\OAuthApplications;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\OAuthApplications\OAuthApplication\Status;
use Increase\OAuthApplications\OAuthApplication\Type;

/**
 * An OAuth Application lets you build an application for others to use with their Increase data. You can create an OAuth Application via the Dashboard and read information about it with the API. Learn more about OAuth [here](https://increase.com/documentation/oauth).
 *
 * @phpstan-type OAuthApplicationShape = array{
 *   id: string,
 *   clientID: string,
 *   createdAt: \DateTimeInterface,
 *   deletedAt: \DateTimeInterface|null,
 *   name: string|null,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class OAuthApplication implements BaseModel
{
    /** @use SdkModel<OAuthApplicationShape> */
    use SdkModel;

    /**
     * The OAuth Application's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The OAuth Application's client_id. Use this to authenticate with the OAuth Application.
     */
    #[Required('client_id')]
    public string $clientID;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp when the OAuth Application was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp when the OAuth Application was deleted.
     */
    #[Required('deleted_at')]
    public ?\DateTimeInterface $deletedAt;

    /**
     * The name you chose for this OAuth Application.
     */
    #[Required]
    public ?string $name;

    /**
     * Whether the application is active.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `oauth_application`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new OAuthApplication()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OAuthApplication::with(
     *   id: ...,
     *   clientID: ...,
     *   createdAt: ...,
     *   deletedAt: ...,
     *   name: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OAuthApplication)
     *   ->withID(...)
     *   ->withClientID(...)
     *   ->withCreatedAt(...)
     *   ->withDeletedAt(...)
     *   ->withName(...)
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
        string $clientID,
        \DateTimeInterface $createdAt,
        ?\DateTimeInterface $deletedAt,
        ?string $name,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['clientID'] = $clientID;
        $self['createdAt'] = $createdAt;
        $self['deletedAt'] = $deletedAt;
        $self['name'] = $name;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The OAuth Application's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The OAuth Application's client_id. Use this to authenticate with the OAuth Application.
     */
    public function withClientID(string $clientID): self
    {
        $self = clone $this;
        $self['clientID'] = $clientID;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp when the OAuth Application was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp when the OAuth Application was deleted.
     */
    public function withDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $self = clone $this;
        $self['deletedAt'] = $deletedAt;

        return $self;
    }

    /**
     * The name you chose for this OAuth Application.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Whether the application is active.
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
     * A constant representing the object's type. For this resource it will always be `oauth_application`.
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
