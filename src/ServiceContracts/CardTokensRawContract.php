<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\CardTokens\CardToken;
use Increase\CardTokens\CardTokenCapabilities;
use Increase\CardTokens\CardTokenListParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardTokensRawContract
{
    /**
     * @api
     *
     * @param string $cardTokenID the identifier of the Card Token
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardToken>
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardTokenID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CardTokenListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CardToken>>
     *
     * @throws APIException
     */
    public function list(
        array|CardTokenListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $cardTokenID the identifier of the Card Token
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardTokenCapabilities>
     *
     * @throws APIException
     */
    public function capabilities(
        string $cardTokenID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
