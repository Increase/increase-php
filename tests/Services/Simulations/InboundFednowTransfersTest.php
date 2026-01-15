<?php

namespace Tests\Services\Simulations;

use Increase\Client;
use Increase\InboundFednowTransfers\InboundFednowTransfer;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class InboundFednowTransfersTest extends TestCase
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
        $result = $this->client->simulations->inboundFednowTransfers->create(
            accountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            amount: 1000
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundFednowTransfer::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->simulations->inboundFednowTransfers->create(
            accountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            amount: 1000,
            debtorAccountNumber: 'x',
            debtorName: 'x',
            debtorRoutingNumber: 'xxxxxxxxx',
            unstructuredRemittanceInformation: 'x',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundFednowTransfer::class, $result);
    }
}
