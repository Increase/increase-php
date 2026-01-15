<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Page;
use Increase\WireTransfers\WireTransfer;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class WireTransfersTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        $result = $this->client->wireTransfers->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: 100,
            creditor: ['name' => 'Ian Crease'],
            remittance: ['category' => 'unstructured'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WireTransfer::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->wireTransfers->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: 100,
            creditor: [
                'name' => 'Ian Crease',
                'address' => [
                    'unstructured' => [
                        'line1' => '33 Liberty Street',
                        'line2' => 'New York',
                        'line3' => 'NY 10045',
                    ],
                ],
            ],
            remittance: [
                'category' => 'unstructured',
                'tax' => [
                    'date' => '2019-12-27',
                    'identificationNumber' => 'xxxxxxxxx',
                    'typeCode' => 'xxxxx',
                ],
                'unstructured' => ['message' => 'New account transfer'],
            ],
            accountNumber: '987654321',
            debtor: [
                'name' => 'x',
                'address' => [
                    'unstructured' => ['line1' => 'x', 'line2' => 'x', 'line3' => 'x'],
                ],
            ],
            externalAccountID: 'external_account_id',
            inboundWireDrawdownRequestID: 'inbound_wire_drawdown_request_id',
            requireApproval: true,
            routingNumber: '101050001',
            sourceAccountNumberID: 'source_account_number_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WireTransfer::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->wireTransfers->retrieve(
            'wire_transfer_5akynk7dqsq25qwk9q2u'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WireTransfer::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->wireTransfers->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(WireTransfer::class, $item);
        }
    }

    #[Test]
    public function testApprove(): void
    {
        $result = $this->client->wireTransfers->approve(
            'wire_transfer_5akynk7dqsq25qwk9q2u'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WireTransfer::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->wireTransfers->cancel(
            'wire_transfer_5akynk7dqsq25qwk9q2u'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WireTransfer::class, $result);
    }
}
