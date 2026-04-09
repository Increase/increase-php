<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\EntityOnboardingSessions\EntityOnboardingSession;
use Increase\EntityOnboardingSessions\EntityOnboardingSessionListParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\EntityOnboardingSessionsContract;

/**
 * @phpstan-import-type StatusShape from \Increase\EntityOnboardingSessions\EntityOnboardingSessionListParams\Status
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
     * Create an Entity Onboarding Session
     *
     * @param string $programID the identifier of the Program the Entity will be onboarded to
     * @param string $redirectURL The URL to redirect the customer to after they complete the onboarding form. The redirect will include `entity_onboarding_session_id` and `entity_id` query parameters.
     * @param string $entityID The identifier of an existing Entity to associate with the onboarding session. If provided, the onboarding form will display any outstanding tasks required to complete the Entity's onboarding.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $programID,
        string $redirectURL,
        ?string $entityID = null,
        RequestOptions|array|null $requestOptions = null,
    ): EntityOnboardingSession {
        $params = Util::removeNulls(
            [
                'programID' => $programID,
                'redirectURL' => $redirectURL,
                'entityID' => $entityID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve an Entity Onboarding Session
     *
     * @param string $entityOnboardingSessionID the identifier of the Entity Onboarding Session
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $entityOnboardingSessionID,
        RequestOptions|array|null $requestOptions = null,
    ): EntityOnboardingSession {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($entityOnboardingSessionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Entity Onboarding Session
     *
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<EntityOnboardingSession>
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'cursor' => $cursor,
                'idempotencyKey' => $idempotencyKey,
                'limit' => $limit,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Expire an Entity Onboarding Session
     *
     * @param string $entityOnboardingSessionID the identifier of the Entity Onboarding Session to expire
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function expire(
        string $entityOnboardingSessionID,
        RequestOptions|array|null $requestOptions = null,
    ): EntityOnboardingSession {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->expire($entityOnboardingSessionID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
