<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\EntityOnboardingSessions\EntityOnboardingSession;
use Increase\EntityOnboardingSessions\EntityOnboardingSessionCreateParams;
use Increase\EntityOnboardingSessions\EntityOnboardingSessionListParams;
use Increase\EntityOnboardingSessions\EntityOnboardingSessionListParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\EntityOnboardingSessionsRawContract;

/**
 * @phpstan-import-type StatusShape from \Increase\EntityOnboardingSessions\EntityOnboardingSessionListParams\Status
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
     * Create an Entity Onboarding Session
     *
     * @param array{
     *   programID: string, redirectURL: string, entityID?: string
     * }|EntityOnboardingSessionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntityOnboardingSession>
     *
     * @throws APIException
     */
    public function create(
        array|EntityOnboardingSessionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EntityOnboardingSessionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'entity_onboarding_sessions',
            body: (object) $parsed,
            options: $options,
            convert: EntityOnboardingSession::class,
        );
    }

    /**
     * @api
     *
     * Retrieve an Entity Onboarding Session
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['entity_onboarding_sessions/%1$s', $entityOnboardingSessionID],
            options: $requestOptions,
            convert: EntityOnboardingSession::class,
        );
    }

    /**
     * @api
     *
     * List Entity Onboarding Session
     *
     * @param array{
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|EntityOnboardingSessionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<EntityOnboardingSession>>
     *
     * @throws APIException
     */
    public function list(
        array|EntityOnboardingSessionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EntityOnboardingSessionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'entity_onboarding_sessions',
            query: Util::array_transform_keys(
                $parsed,
                ['idempotencyKey' => 'idempotency_key']
            ),
            options: $options,
            convert: EntityOnboardingSession::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Expire an Entity Onboarding Session
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'entity_onboarding_sessions/%1$s/expire', $entityOnboardingSessionID,
            ],
            options: $requestOptions,
            convert: EntityOnboardingSession::class,
        );
    }
}
