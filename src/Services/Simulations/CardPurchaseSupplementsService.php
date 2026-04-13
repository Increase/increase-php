<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardPurchaseSupplements\CardPurchaseSupplement;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardPurchaseSupplementsContract;
use Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\Invoice;
use Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\LineItem;

/**
 * @phpstan-import-type InvoiceShape from \Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\Invoice
 * @phpstan-import-type LineItemShape from \Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\LineItem
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardPurchaseSupplementsService implements CardPurchaseSupplementsContract
{
    /**
     * @api
     */
    public CardPurchaseSupplementsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardPurchaseSupplementsRawService($client);
    }

    /**
     * @api
     *
     * Simulates the creation of a Card Purchase Supplement (Level 3 data) for a card settlement. This happens asynchronously in production when Visa sends enhanced transaction data about a purchase.
     *
     * @param string $transactionID The identifier of the Transaction to create a Card Purchase Supplement for. The Transaction must have a source of type `card_settlement`.
     * @param Invoice|InvoiceShape $invoice invoice-level information about the payment
     * @param list<LineItem|LineItemShape> $lineItems line item information, such as individual products purchased
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $transactionID,
        Invoice|array|null $invoice = null,
        ?array $lineItems = null,
        RequestOptions|array|null $requestOptions = null,
    ): CardPurchaseSupplement {
        $params = Util::removeNulls(
            [
                'transactionID' => $transactionID,
                'invoice' => $invoice,
                'lineItems' => $lineItems,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
