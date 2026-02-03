<?php

namespace Tests\Services\Simulations;

use Increase\Client;
use Increase\Core\Util;
use Increase\InboundWireDrawdownRequests\InboundWireDrawdownRequest;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class InboundWireDrawdownRequestsTest extends TestCase
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
        $result = $this->client->simulations->inboundWireDrawdownRequests->create(
            amount: 10000,
            creditorAccountNumber: '987654321',
            creditorRoutingNumber: '101050001',
            currency: 'USD',
            recipientAccountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundWireDrawdownRequest::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->simulations->inboundWireDrawdownRequests->create(
            amount: 10000,
            creditorAccountNumber: '987654321',
            creditorRoutingNumber: '101050001',
            currency: 'USD',
            recipientAccountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            creditorAddressLine1: '33 Liberty Street',
            creditorAddressLine2: 'New York, NY, 10045',
            creditorAddressLine3: 'x',
            creditorName: 'Ian Crease',
            debtorAccountNumber: '987654321',
            debtorAddressLine1: '33 Liberty Street',
            debtorAddressLine2: 'New York, NY, 10045',
            debtorAddressLine3: 'x',
            debtorName: 'Ian Crease',
            debtorRoutingNumber: '101050001',
            endToEndIdentification: 'x',
            instructionIdentification: 'x',
            uniqueEndToEndTransactionReference: 'x',
            unstructuredRemittanceInformation: 'x',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundWireDrawdownRequest::class, $result);
    }
}
