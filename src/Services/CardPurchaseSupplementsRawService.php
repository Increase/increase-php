<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CardPurchaseSupplements\CardPurchaseSupplement;
use Increase\CardPurchaseSupplements\CardPurchaseSupplementListParams;
use Increase\CardPurchaseSupplements\CardPurchaseSupplementListParams\CreatedAt;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CardPurchaseSupplementsRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\CardPurchaseSupplements\CardPurchaseSupplementListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardPurchaseSupplementsRawService implements CardPurchaseSupplementsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a Card Purchase Supplement
     *
     * @param string $cardPurchaseSupplementID the identifier of the Card Purchase Supplement
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPurchaseSupplement>
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardPurchaseSupplementID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['card_purchase_supplements/%1$s', $cardPurchaseSupplementID],
            options: $requestOptions,
            convert: CardPurchaseSupplement::class,
        );
    }

    /**
     * @api
     *
     * List Card Purchase Supplements
     *
     * @param array{
     *   cardPaymentID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     * }|CardPurchaseSupplementListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CardPurchaseSupplement>>
     *
     * @throws APIException
     */
    public function list(
        array|CardPurchaseSupplementListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardPurchaseSupplementListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'card_purchase_supplements',
            query: Util::array_transform_keys(
                $parsed,
                ['cardPaymentID' => 'card_payment_id', 'createdAt' => 'created_at'],
            ),
            options: $options,
            convert: CardPurchaseSupplement::class,
            page: Page::class,
        );
    }
}
