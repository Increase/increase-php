<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestForPayment;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class InboundRealTimePaymentsRequestsForPaymentTest extends TestCase
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
    public function testRetrieve(): void
    {
        $result = $this
            ->client
            ->inboundRealTimePaymentsRequestsForPayment
            ->retrieve(
                'inbound_real_time_payments_request_for_payment_j9c5rm4hr6qf34en8tky'
            )
        ;

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            InboundRealTimePaymentsRequestForPayment::class,
            $result
        );
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->inboundRealTimePaymentsRequestsForPayment->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(
                InboundRealTimePaymentsRequestForPayment::class,
                $item
            );
        }
    }
}
