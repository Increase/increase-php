<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\OAuthApplications\OAuthApplication;
use Increase\OAuthApplications\OAuthApplicationListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface OAuthApplicationsRawContract
{
    /**
     * @api
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
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|OAuthApplicationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<OAuthApplication>>
     *
     * @throws APIException
     */
    public function list(
        array|OAuthApplicationListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
