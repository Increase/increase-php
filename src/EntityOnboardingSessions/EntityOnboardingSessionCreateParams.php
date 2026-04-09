<?php

declare(strict_types=1);

namespace Increase\EntityOnboardingSessions;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create an Entity Onboarding Session.
 *
 * @see Increase\Services\EntityOnboardingSessionsService::create()
 *
 * @phpstan-type EntityOnboardingSessionCreateParamsShape = array{
 *   programID: string, redirectURL: string, entityID?: string|null
 * }
 */
final class EntityOnboardingSessionCreateParams implements BaseModel
{
    /** @use SdkModel<EntityOnboardingSessionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Program the Entity will be onboarded to.
     */
    #[Required('program_id')]
    public string $programID;

    /**
     * The URL to redirect the customer to after they complete the onboarding form. The redirect will include `entity_onboarding_session_id` and `entity_id` query parameters.
     */
    #[Required('redirect_url')]
    public string $redirectURL;

    /**
     * The identifier of an existing Entity to associate with the onboarding session. If provided, the onboarding form will display any outstanding tasks required to complete the Entity's onboarding.
     */
    #[Optional('entity_id')]
    public ?string $entityID;

    /**
     * `new EntityOnboardingSessionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntityOnboardingSessionCreateParams::with(programID: ..., redirectURL: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntityOnboardingSessionCreateParams)
     *   ->withProgramID(...)
     *   ->withRedirectURL(...)
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
     */
    public static function with(
        string $programID,
        string $redirectURL,
        ?string $entityID = null
    ): self {
        $self = new self;

        $self['programID'] = $programID;
        $self['redirectURL'] = $redirectURL;

        null !== $entityID && $self['entityID'] = $entityID;

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
     * The URL to redirect the customer to after they complete the onboarding form. The redirect will include `entity_onboarding_session_id` and `entity_id` query parameters.
     */
    public function withRedirectURL(string $redirectURL): self
    {
        $self = clone $this;
        $self['redirectURL'] = $redirectURL;

        return $self;
    }

    /**
     * The identifier of an existing Entity to associate with the onboarding session. If provided, the onboarding form will display any outstanding tasks required to complete the Entity's onboarding.
     */
    public function withEntityID(string $entityID): self
    {
        $self = clone $this;
        $self['entityID'] = $entityID;

        return $self;
    }
}
