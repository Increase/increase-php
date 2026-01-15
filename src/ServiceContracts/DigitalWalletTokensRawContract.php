<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\DigitalWalletTokens\DigitalWalletToken;
use Increase\DigitalWalletTokens\DigitalWalletTokenListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface DigitalWalletTokensRawContract
{
    /**
     * @api
     *
     * @param string $digitalWalletTokenID the identifier of the Digital Wallet Token
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DigitalWalletToken>
     *
     * @throws APIException
     */
    public function retrieve(
        string $digitalWalletTokenID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DigitalWalletTokenListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<DigitalWalletToken>>
     *
     * @throws APIException
     */
    public function list(
        array|DigitalWalletTokenListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
