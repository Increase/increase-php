<?php

namespace Tests\Services\Simulations;

use Increase\CardPurchaseSupplements\CardPurchaseSupplement;
use Increase\Client;
use Increase\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class CardPurchaseSupplementsTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        $result = $this->client->simulations->cardPurchaseSupplements->create(
            transactionID: 'transaction_uyrp7fld2ium70oa7oi'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardPurchaseSupplement::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->simulations->cardPurchaseSupplements->create(
            transactionID: 'transaction_uyrp7fld2ium70oa7oi',
            invoice: [
                'discountAmount' => 100,
                'dutyTaxAmount' => 200,
                'orderDate' => '2023-07-20',
                'shippingAmount' => 300,
                'shippingDestinationCountryCode' => 'US',
                'shippingDestinationPostalCode' => '10045',
                'shippingSourcePostalCode' => '10045',
                'shippingTaxAmount' => 400,
                'shippingTaxRate' => '0.2',
                'uniqueValueAddedTaxInvoiceReference' => '12302',
            ],
            lineItems: [
                [
                    'discountAmount' => 0,
                    'itemCommodityCode' => '001',
                    'itemDescriptor' => 'Coffee',
                    'itemQuantity' => '1',
                    'productCode' => '101',
                    'salesTaxAmount' => 0,
                    'salesTaxRate' => '-16699',
                    'totalAmount' => 500,
                    'unitCost' => '5',
                    'unitOfMeasureCode' => 'NMB',
                ],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardPurchaseSupplement::class, $result);
    }
}
