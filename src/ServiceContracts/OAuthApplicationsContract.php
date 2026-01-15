<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\OAuthApplications\OAuthApplication;
use Increase\OAuthApplications\OAuthApplicationListParams\CreatedAt;
use Increase\OAuthApplications\OAuthApplicationListParams\Status;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\OAuthApplications\OAuthApplicationListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\OAuthApplications\OAuthApplicationListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface OAuthApplicationsContract
{
    /**
     * @api
     *
     * @param string $oauthApplicationID the identifier of the OAuth Application
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $oauthApplicationID,
        RequestOptions|array|null $requestOptions = null,
    ): OAuthApplication;

    /**
     * @api
     *
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<OAuthApplication>
     *
     * @throws APIException
     */
    public function list(
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;
}
