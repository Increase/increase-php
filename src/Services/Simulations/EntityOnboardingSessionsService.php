<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\EntityOnboardingSessions\EntityOnboardingSession;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\EntityOnboardingSessionsContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class EntityOnboardingSessionsService implements EntityOnboardingSessionsContract
{
    /**
     * @api
     */
    public EntityOnboardingSessionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new EntityOnboardingSessionsRawService($client);
    }

    /**
     * @api
     *
     * Simulates the submission of an [Entity Onboarding Session](#entity-onboarding-sessions). This session must have a `status` of `active`. After submission, the session will transition to `expired` and a new Entity will be created.
     *
     * @param string $entityOnboardingSessionID the identifier of the Entity Onboarding Session you wish to submit
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submit(
        string $entityOnboardingSessionID,
        RequestOptions|array|null $requestOptions = null,
    ): EntityOnboardingSession {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->submit($entityOnboardingSessionID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
