<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundMailItems\InboundMailItem;
use Increase\InboundMailItems\InboundMailItemActionParams;
use Increase\InboundMailItems\InboundMailItemActionParams\Check;
use Increase\InboundMailItems\InboundMailItemListParams;
use Increase\InboundMailItems\InboundMailItemListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundMailItemsRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundMailItems\InboundMailItemListParams\CreatedAt
 * @phpstan-import-type CheckShape from \Increase\InboundMailItems\InboundMailItemActionParams\Check
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundMailItemsRawService implements InboundMailItemsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve an Inbound Mail Item
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
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['inbound_mail_items/%1$s', $inboundMailItemID],
            options: $requestOptions,
            convert: InboundMailItem::class,
        );
    }

    /**
     * @api
     *
     * List Inbound Mail Items
     *
     * @param array{
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     *   lockboxID?: string,
     * }|InboundMailItemListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundMailItem>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundMailItemListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundMailItemListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'inbound_mail_items',
            query: Util::array_transform_keys(
                $parsed,
                ['createdAt' => 'created_at', 'lockboxID' => 'lockbox_id']
            ),
            options: $options,
            convert: InboundMailItem::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Action an Inbound Mail Item
     *
     * @param string $inboundMailItemID the identifier of the Inbound Mail Item to action
     * @param array{checks: list<Check|CheckShape>}|InboundMailItemActionParams $params
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
    ): BaseResponse {
        [$parsed, $options] = InboundMailItemActionParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['inbound_mail_items/%1$s/action', $inboundMailItemID],
            body: (object) $parsed,
            options: $options,
            convert: InboundMailItem::class,
        );
    }
}
