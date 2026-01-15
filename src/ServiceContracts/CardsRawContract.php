<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Cards\Card;
use Increase\Cards\CardCreateDetailsIframeParams;
use Increase\Cards\CardCreateParams;
use Increase\Cards\CardDetails;
use Increase\Cards\CardIframeURL;
use Increase\Cards\CardListParams;
use Increase\Cards\CardUpdateParams;
use Increase\Cards\CardUpdatePinParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CardCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Card>
     *
     * @throws APIException
     */
    public function create(
        array|CardCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $cardID the identifier of the Card
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Card>
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $cardID the card identifier
     * @param array<string,mixed>|CardUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Card>
     *
     * @throws APIException
     */
    public function update(
        string $cardID,
        array|CardUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CardListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Card>>
     *
     * @throws APIException
     */
    public function list(
        array|CardListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $cardID the identifier of the Card to create an iframe for
     * @param array<string,mixed>|CardCreateDetailsIframeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardIframeURL>
     *
     * @throws APIException
     */
    public function createDetailsIframe(
        string $cardID,
        array|CardCreateDetailsIframeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $cardID the identifier of the Card to retrieve details for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardDetails>
     *
     * @throws APIException
     */
    public function details(
        string $cardID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $cardID the identifier of the Card to update the PIN for
     * @param array<string,mixed>|CardUpdatePinParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardDetails>
     *
     * @throws APIException
     */
    public function updatePin(
        string $cardID,
        array|CardUpdatePinParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
