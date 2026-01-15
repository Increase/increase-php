<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\OAuthApplications\OAuthApplication;
use Increase\OAuthApplications\OAuthApplicationListParams;
use Increase\OAuthApplications\OAuthApplicationListParams\CreatedAt;
use Increase\OAuthApplications\OAuthApplicationListParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\OAuthApplicationsRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\OAuthApplications\OAuthApplicationListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\OAuthApplications\OAuthApplicationListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class OAuthApplicationsRawService implements OAuthApplicationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve an OAuth Application
     *
     * @param string $oauthApplicationID the identifier of the OAuth Application
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<OAuthApplication>
     *
     * @throws APIException
     */
    public function retrieve(
        string $oauthApplicationID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['oauth_applications/%1$s', $oauthApplicationID],
            options: $requestOptions,
            convert: OAuthApplication::class,
        );
    }

    /**
     * @api
     *
     * List OAuth Applications
     *
     * @param array{
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|OAuthApplicationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<OAuthApplication>>
     *
     * @throws APIException
     */
    public function list(
        array|OAuthApplicationListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = OAuthApplicationListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'oauth_applications',
            query: Util::array_transform_keys($parsed, ['createdAt' => 'created_at']),
            options: $options,
            convert: OAuthApplication::class,
            page: Page::class,
        );
    }
}
