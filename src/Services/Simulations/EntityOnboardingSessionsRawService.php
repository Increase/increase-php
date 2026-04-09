<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\EntityOnboardingSessions\EntityOnboardingSession;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\EntityOnboardingSessionsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class EntityOnboardingSessionsRawService implements EntityOnboardingSessionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates the submission of an [Entity Onboarding Session](#entity-onboarding-sessions). This session must have a `status` of `active`. After submission, the session will transition to `expired` and a new Entity will be created.
     *
     * @param string $entityOnboardingSessionID the identifier of the Entity Onboarding Session you wish to submit
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntityOnboardingSession>
     *
     * @throws APIException
     */
    public function submit(
        string $entityOnboardingSessionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'simulations/entity_onboarding_sessions/%1$s/submit',
                $entityOnboardingSessionID,
            ],
            options: $requestOptions,
            convert: EntityOnboardingSession::class,
        );
    }
}
