<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\Page;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class RealTimePaymentsRequestsForPaymentTest extends TestCase
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
        $result = $this->client->realTimePaymentsRequestsForPayment->create(
            accountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            amount: 100,
            debtor: ['address' => ['country' => 'US'], 'name' => 'Ian Crease'],
            debtorAccountNumber: '987654321',
            debtorRoutingNumber: '101050001',
            expiresAt: new \DateTimeImmutable('2020-02-14T23:59:59Z'),
            requestedExecutionAt: new \DateTimeImmutable('2020-02-07T23:59:59Z'),
            unstructuredRemittanceInformation: 'Invoice 29582',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RealTimePaymentsRequestForPayment::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->realTimePaymentsRequestsForPayment->create(
            accountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            amount: 100,
            debtor: [
                'address' => [
                    'country' => 'US',
                    'addressLine2' => 'x',
                    'buildingNumber' => 'x',
                    'city' => 'x',
                    'postalCode' => 'x',
                    'state' => 'xx',
                    'streetName' => 'Liberty Street',
                ],
                'name' => 'Ian Crease',
            ],
            debtorAccountNumber: '987654321',
            debtorRoutingNumber: '101050001',
            expiresAt: new \DateTimeImmutable('2020-02-14T23:59:59Z'),
            requestedExecutionAt: new \DateTimeImmutable('2020-02-07T23:59:59Z'),
            unstructuredRemittanceInformation: 'Invoice 29582',
            creditorName: 'National Phonograph Company',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RealTimePaymentsRequestForPayment::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->realTimePaymentsRequestsForPayment->retrieve(
            'real_time_payments_request_for_payment_28kcliz1oevcnqyn9qp7'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RealTimePaymentsRequestForPayment::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->realTimePaymentsRequestsForPayment->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(RealTimePaymentsRequestForPayment::class, $item);
        }
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->realTimePaymentsRequestsForPayment->cancel(
            'real_time_payments_request_for_payment_28kcliz1oevcnqyn9qp7'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RealTimePaymentsRequestForPayment::class, $result);
    }
}
