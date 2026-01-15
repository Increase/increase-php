<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Page;
use Increase\SwiftTransfers\SwiftTransfer;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class SwiftTransfersTest extends TestCase
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
        $result = $this->client->swiftTransfers->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            accountNumber: '987654321',
            bankIdentificationCode: 'ECBFDEFFTPP',
            creditorAddress: [
                'city' => 'Frankfurt',
                'country' => 'DE',
                'line1' => 'Sonnemannstrasse 20',
            ],
            creditorName: 'Ian Crease',
            debtorAddress: [
                'city' => 'New York', 'country' => 'US', 'line1' => '33 Liberty Street',
            ],
            debtorName: 'National Phonograph Company',
            instructedAmount: 100,
            instructedCurrency: 'USD',
            sourceAccountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            unstructuredRemittanceInformation: 'New Swift transfer',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SwiftTransfer::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->swiftTransfers->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            accountNumber: '987654321',
            bankIdentificationCode: 'ECBFDEFFTPP',
            creditorAddress: [
                'city' => 'Frankfurt',
                'country' => 'DE',
                'line1' => 'Sonnemannstrasse 20',
                'line2' => 'x',
                'postalCode' => '60314',
                'state' => 'x',
            ],
            creditorName: 'Ian Crease',
            debtorAddress: [
                'city' => 'New York',
                'country' => 'US',
                'line1' => '33 Liberty Street',
                'line2' => 'x',
                'postalCode' => '10045',
                'state' => 'NY',
            ],
            debtorName: 'National Phonograph Company',
            instructedAmount: 100,
            instructedCurrency: 'USD',
            sourceAccountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            unstructuredRemittanceInformation: 'New Swift transfer',
            requireApproval: true,
            routingNumber: 'x',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SwiftTransfer::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->swiftTransfers->retrieve(
            'swift_transfer_29h21xkng03788zwd3fh'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SwiftTransfer::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->swiftTransfers->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(SwiftTransfer::class, $item);
        }
    }

    #[Test]
    public function testApprove(): void
    {
        $result = $this->client->swiftTransfers->approve(
            'swift_transfer_29h21xkng03788zwd3fh'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SwiftTransfer::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->swiftTransfers->cancel(
            'swift_transfer_29h21xkng03788zwd3fh'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SwiftTransfer::class, $result);
    }
}
