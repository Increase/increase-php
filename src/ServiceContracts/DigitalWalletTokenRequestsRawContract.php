<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequestListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface DigitalWalletTokenRequestsRawContract
{
    /**
     * @api
     *
     * @param string $digitalWalletTokenRequestID the identifier of the Digital Wallet Token Request
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DigitalWalletTokenRequest>
     *
     * @throws APIException
     */
    public function retrieve(
        string $digitalWalletTokenRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DigitalWalletTokenRequestListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<DigitalWalletTokenRequest>>
     *
     * @throws APIException
     */
    public function list(
        array|DigitalWalletTokenRequestListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
