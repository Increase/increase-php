<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\DigitalCardProfiles\DigitalCardProfile;
use Increase\DigitalCardProfiles\DigitalCardProfileCloneParams;
use Increase\DigitalCardProfiles\DigitalCardProfileCreateParams;
use Increase\DigitalCardProfiles\DigitalCardProfileListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface DigitalCardProfilesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|DigitalCardProfileCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DigitalCardProfile>
     *
     * @throws APIException
     */
    public function create(
        array|DigitalCardProfileCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $digitalCardProfileID the identifier of the Digital Card Profile
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DigitalCardProfile>
     *
     * @throws APIException
     */
    public function retrieve(
        string $digitalCardProfileID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DigitalCardProfileListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<DigitalCardProfile>>
     *
     * @throws APIException
     */
    public function list(
        array|DigitalCardProfileListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $digitalCardProfileID the identifier of the Digital Card Profile to archive
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DigitalCardProfile>
     *
     * @throws APIException
     */
    public function archive(
        string $digitalCardProfileID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $digitalCardProfileID the identifier of the Digital Card Profile to clone
     * @param array<string,mixed>|DigitalCardProfileCloneParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DigitalCardProfile>
     *
     * @throws APIException
     */
    public function clone(
        string $digitalCardProfileID,
        array|DigitalCardProfileCloneParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
