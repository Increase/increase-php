<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\EntityOnboardingSessions\EntityOnboardingSession;
use Increase\EntityOnboardingSessions\EntityOnboardingSessionListParams\Status;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type StatusShape from \Increase\EntityOnboardingSessions\EntityOnboardingSessionListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface EntityOnboardingSessionsContract
{
    /**
     * @api
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
    ): EntityOnboardingSession;

    /**
     * @api
     *
     * @param string $entityOnboardingSessionID the identifier of the Entity Onboarding Session
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $entityOnboardingSessionID,
        RequestOptions|array|null $requestOptions = null,
    ): EntityOnboardingSession;

    /**
     * @api
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
    ): Page;

    /**
     * @api
     *
     * @param string $entityOnboardingSessionID the identifier of the Entity Onboarding Session to expire
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function expire(
        string $entityOnboardingSessionID,
        RequestOptions|array|null $requestOptions = null,
    ): EntityOnboardingSession;
}
