<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\LockboxAddresses\LockboxAddress;
use Increase\LockboxAddresses\LockboxAddressCreateParams;
use Increase\LockboxAddresses\LockboxAddressListParams;
use Increase\LockboxAddresses\LockboxAddressUpdateParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface LockboxAddressesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|LockboxAddressCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LockboxAddress>
     *
     * @throws APIException
     */
    public function create(
        array|LockboxAddressCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $lockboxAddressID the identifier of the Lockbox Address to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LockboxAddress>
     *
     * @throws APIException
     */
    public function retrieve(
        string $lockboxAddressID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $lockboxAddressID the identifier of the Lockbox Address
     * @param array<string,mixed>|LockboxAddressUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LockboxAddress>
     *
     * @throws APIException
     */
    public function update(
        string $lockboxAddressID,
        array|LockboxAddressUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|LockboxAddressListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<LockboxAddress>>
     *
     * @throws APIException
     */
    public function list(
        array|LockboxAddressListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
