<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\PhysicalCardProfiles\PhysicalCardProfile;
use Increase\PhysicalCardProfiles\PhysicalCardProfileCloneParams;
use Increase\PhysicalCardProfiles\PhysicalCardProfileCreateParams;
use Increase\PhysicalCardProfiles\PhysicalCardProfileListParams;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface PhysicalCardProfilesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|PhysicalCardProfileCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCardProfile>
     *
     * @throws APIException
     */
    public function create(
        array|PhysicalCardProfileCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $physicalCardProfileID the identifier of the Card Profile
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCardProfile>
     *
     * @throws APIException
     */
    public function retrieve(
        string $physicalCardProfileID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|PhysicalCardProfileListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<PhysicalCardProfile>>
     *
     * @throws APIException
     */
    public function list(
        array|PhysicalCardProfileListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $physicalCardProfileID the identifier of the Physical Card Profile to archive
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCardProfile>
     *
     * @throws APIException
     */
    public function archive(
        string $physicalCardProfileID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $physicalCardProfileID the identifier of the Physical Card Profile to clone
     * @param array<string,mixed>|PhysicalCardProfileCloneParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCardProfile>
     *
     * @throws APIException
     */
    public function clone(
        string $physicalCardProfileID,
        array|PhysicalCardProfileCloneParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
