<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\EntityOnboardingSessions\EntityOnboardingSession;
use Increase\EntityOnboardingSessions\EntityOnboardingSessionCreateParams;
use Increase\EntityOnboardingSessions\EntityOnboardingSessionListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface EntityOnboardingSessionsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|EntityOnboardingSessionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntityOnboardingSession>
     *
     * @throws APIException
     */
    public function create(
        array|EntityOnboardingSessionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $entityOnboardingSessionID the identifier of the Entity Onboarding Session
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntityOnboardingSession>
     *
     * @throws APIException
     */
    public function retrieve(
        string $entityOnboardingSessionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|EntityOnboardingSessionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<EntityOnboardingSession>>
     *
     * @throws APIException
     */
    public function list(
        array|EntityOnboardingSessionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $entityOnboardingSessionID the identifier of the Entity Onboarding Session to expire
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntityOnboardingSession>
     *
     * @throws APIException
     */
    public function expire(
        string $entityOnboardingSessionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
