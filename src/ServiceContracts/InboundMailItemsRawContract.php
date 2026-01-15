<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundMailItems\InboundMailItem;
use Increase\InboundMailItems\InboundMailItemActionParams;
use Increase\InboundMailItems\InboundMailItemListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundMailItemsRawContract
{
    /**
     * @api
     *
     * @param string $inboundMailItemID the identifier of the Inbound Mail Item to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundMailItem>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundMailItemID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|InboundMailItemListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundMailItem>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundMailItemListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $inboundMailItemID the identifier of the Inbound Mail Item to action
     * @param array<string,mixed>|InboundMailItemActionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundMailItem>
     *
     * @throws APIException
     */
    public function action(
        string $inboundMailItemID,
        array|InboundMailItemActionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
