<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\AccountNumbers\AccountNumber;
use Increase\AccountNumbers\AccountNumberCreateParams;
use Increase\AccountNumbers\AccountNumberListParams;
use Increase\AccountNumbers\AccountNumberUpdateParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface AccountNumbersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AccountNumberCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountNumber>
     *
     * @throws APIException
     */
    public function create(
        array|AccountNumberCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $accountNumberID the identifier of the Account Number to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountNumber>
     *
     * @throws APIException
     */
    public function retrieve(
        string $accountNumberID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $accountNumberID the identifier of the Account Number
     * @param array<string,mixed>|AccountNumberUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountNumber>
     *
     * @throws APIException
     */
    public function update(
        string $accountNumberID,
        array|AccountNumberUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AccountNumberListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<AccountNumber>>
     *
     * @throws APIException
     */
    public function list(
        array|AccountNumberListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
