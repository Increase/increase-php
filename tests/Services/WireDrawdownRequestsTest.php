<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\Page;
use Increase\WireDrawdownRequests\WireDrawdownRequest;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class WireDrawdownRequestsTest extends TestCase
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
        $result = $this->client->wireDrawdownRequests->create(
            accountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            amount: 10000,
            creditorAddress: [
                'city' => 'New York', 'country' => 'US', 'line1' => '33 Liberty Street',
            ],
            creditorName: 'National Phonograph Company',
            debtorAddress: [
                'city' => 'New York', 'country' => 'US', 'line1' => '33 Liberty Street',
            ],
            debtorName: 'Ian Crease',
            unstructuredRemittanceInformation: 'Invoice 29582',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WireDrawdownRequest::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->wireDrawdownRequests->create(
            accountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            amount: 10000,
            creditorAddress: [
                'city' => 'New York',
                'country' => 'US',
                'line1' => '33 Liberty Street',
                'line2' => 'x',
                'postalCode' => '10045',
                'state' => 'NY',
            ],
            creditorName: 'National Phonograph Company',
            debtorAddress: [
                'city' => 'New York',
                'country' => 'US',
                'line1' => '33 Liberty Street',
                'line2' => 'x',
                'postalCode' => '10045',
                'state' => 'NY',
            ],
            debtorName: 'Ian Crease',
            unstructuredRemittanceInformation: 'Invoice 29582',
            debtorAccountNumber: '987654321',
            debtorExternalAccountID: 'debtor_external_account_id',
            debtorRoutingNumber: '101050001',
            endToEndIdentification: 'x',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WireDrawdownRequest::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->wireDrawdownRequests->retrieve(
            'wire_drawdown_request_q6lmocus3glo0lr2bfv3'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WireDrawdownRequest::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->wireDrawdownRequests->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(WireDrawdownRequest::class, $item);
        }
    }
}
