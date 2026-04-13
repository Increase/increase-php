<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CardPurchaseSupplements\CardPurchaseSupplement;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\Invoice;
use Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\LineItem;

/**
 * @phpstan-import-type InvoiceShape from \Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\Invoice
 * @phpstan-import-type LineItemShape from \Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\LineItem
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardPurchaseSupplementsContract
{
    /**
     * @api
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
    ): CardPurchaseSupplement;
}
