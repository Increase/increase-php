<?php

declare(strict_types=1);

namespace Increase\EntityOnboardingSessions;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\EntityOnboardingSessions\EntityOnboardingSession\Status;
use Increase\EntityOnboardingSessions\EntityOnboardingSession\Type;

/**
 * Entity Onboarding Sessions let your customers onboard themselves by completing Increase-hosted forms. Create a session and redirect your customer to the returned URL. When they're done, they'll be redirected back to your site. This API is used for [hosted onboarding](/documentation/hosted-onboarding).
 *
 * @phpstan-type EntityOnboardingSessionShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   entityID: string|null,
 *   expiresAt: \DateTimeInterface,
 *   idempotencyKey: string|null,
 *   programID: string,
 *   redirectURL: string,
 *   sessionURL: string|null,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class EntityOnboardingSession implements BaseModel
{
    /** @use SdkModel<EntityOnboardingSessionShape> */
    use SdkModel;

    /**
     * The Entity Onboarding Session's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Entity Onboarding Session was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The identifier of the Entity associated with this session, if one has been created or was provided when creating the session.
     */
    #[Required('entity_id')]
    public ?string $entityID;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Entity Onboarding Session will expire.
     */
    #[Required('expires_at')]
    public \DateTimeInterface $expiresAt;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The identifier of the Program the Entity will be onboarded to.
     */
    #[Required('program_id')]
    public string $programID;

    /**
     * The URL to redirect to after the onboarding session is complete. Increase will include the query parameters `entity_onboarding_session_id` and `entity_id` when redirecting.
     */
    #[Required('redirect_url')]
    public string $redirectURL;

    /**
     * The URL containing the onboarding form. You should share this link with your customer. Only present when the session is active.
     */
    #[Required('session_url')]
    public ?string $sessionURL;

    /**
     * The status of the onboarding session.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `entity_onboarding_session`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new EntityOnboardingSession()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntityOnboardingSession::with(
     *   id: ...,
     *   createdAt: ...,
     *   entityID: ...,
     *   expiresAt: ...,
     *   idempotencyKey: ...,
     *   programID: ...,
     *   redirectURL: ...,
     *   sessionURL: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntityOnboardingSession)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withEntityID(...)
     *   ->withExpiresAt(...)
     *   ->withIdempotencyKey(...)
     *   ->withProgramID(...)
     *   ->withRedirectURL(...)
     *   ->withSessionURL(...)
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
        ?string $entityID,
        \DateTimeInterface $expiresAt,
        ?string $idempotencyKey,
        string $programID,
        string $redirectURL,
        ?string $sessionURL,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['entityID'] = $entityID;
        $self['expiresAt'] = $expiresAt;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['programID'] = $programID;
        $self['redirectURL'] = $redirectURL;
        $self['sessionURL'] = $sessionURL;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Entity Onboarding Session's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Entity Onboarding Session was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The identifier of the Entity associated with this session, if one has been created or was provided when creating the session.
     */
    public function withEntityID(?string $entityID): self
    {
        $self = clone $this;
        $self['entityID'] = $entityID;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Entity Onboarding Session will expire.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * The identifier of the Program the Entity will be onboarded to.
     */
    public function withProgramID(string $programID): self
    {
        $self = clone $this;
        $self['programID'] = $programID;

        return $self;
    }

    /**
     * The URL to redirect to after the onboarding session is complete. Increase will include the query parameters `entity_onboarding_session_id` and `entity_id` when redirecting.
     */
    public function withRedirectURL(string $redirectURL): self
    {
        $self = clone $this;
        $self['redirectURL'] = $redirectURL;

        return $self;
    }

    /**
     * The URL containing the onboarding form. You should share this link with your customer. Only present when the session is active.
     */
    public function withSessionURL(?string $sessionURL): self
    {
        $self = clone $this;
        $self['sessionURL'] = $sessionURL;

        return $self;
    }

    /**
     * The status of the onboarding session.
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
     * A constant representing the object's type. For this resource it will always be `entity_onboarding_session`.
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
