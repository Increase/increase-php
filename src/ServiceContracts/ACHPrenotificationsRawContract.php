<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\ACHPrenotifications\ACHPrenotification;
use Increase\ACHPrenotifications\ACHPrenotificationCreateParams;
use Increase\ACHPrenotifications\ACHPrenotificationListParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface ACHPrenotificationsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ACHPrenotificationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHPrenotification>
     *
     * @throws APIException
     */
    public function create(
        array|ACHPrenotificationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $achPrenotificationID the identifier of the ACH Prenotification to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHPrenotification>
     *
     * @throws APIException
     */
    public function retrieve(
        string $achPrenotificationID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ACHPrenotificationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<ACHPrenotification>>
     *
     * @throws APIException
     */
    public function list(
        array|ACHPrenotificationListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
