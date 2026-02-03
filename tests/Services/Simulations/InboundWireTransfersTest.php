<?php

namespace Tests\Services\Simulations;

use Increase\Client;
use Increase\Core\Util;
use Increase\InboundWireTransfers\InboundWireTransfer;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class InboundWireTransfersTest extends TestCase
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
        $result = $this->client->simulations->inboundWireTransfers->create(
            accountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            amount: 1000
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundWireTransfer::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->simulations->inboundWireTransfers->create(
            accountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            amount: 1000,
            creditorAddressLine1: 'x',
            creditorAddressLine2: 'x',
            creditorAddressLine3: 'x',
            creditorName: 'x',
            debtorAddressLine1: 'x',
            debtorAddressLine2: 'x',
            debtorAddressLine3: 'x',
            debtorName: 'x',
            endToEndIdentification: 'x',
            instructingAgentRoutingNumber: 'x',
            instructionIdentification: 'x',
            uniqueEndToEndTransactionReference: 'x',
            unstructuredRemittanceInformation: 'x',
            wireDrawdownRequestID: 'wire_drawdown_request_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundWireTransfer::class, $result);
    }
}
