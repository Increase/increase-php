<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardPurchaseSupplements\CardPurchaseSupplement;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardPurchaseSupplementsRawContract;
use Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams;
use Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\Invoice;
use Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\LineItem;

/**
 * @phpstan-import-type InvoiceShape from \Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\Invoice
 * @phpstan-import-type LineItemShape from \Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\LineItem
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
     * Simulates the creation of a Card Purchase Supplement (Level 3 data) for a card settlement. This happens asynchronously in production when Visa sends enhanced transaction data about a purchase.
     *
     * @param array{
     *   transactionID: string,
     *   invoice?: Invoice|InvoiceShape,
     *   lineItems?: list<LineItem|LineItemShape>,
     * }|CardPurchaseSupplementCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPurchaseSupplement>
     *
     * @throws APIException
     */
    public function create(
        array|CardPurchaseSupplementCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardPurchaseSupplementCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/card_purchase_supplements',
            body: (object) $parsed,
            options: $options,
            convert: CardPurchaseSupplement::class,
        );
    }
}
