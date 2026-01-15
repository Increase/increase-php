<?php

namespace Tests\Services;

use Increase\Client;
use Increase\FednowTransfers\FednowTransfer;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class FednowTransfersTest extends TestCase
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
        $result = $this->client->fednowTransfers->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: 100,
            creditorName: 'Ian Crease',
            debtorName: 'National Phonograph Company',
            sourceAccountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            unstructuredRemittanceInformation: 'Invoice 29582',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FednowTransfer::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->fednowTransfers->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: 100,
            creditorName: 'Ian Crease',
            debtorName: 'National Phonograph Company',
            sourceAccountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            unstructuredRemittanceInformation: 'Invoice 29582',
            accountNumber: '987654321',
            creditorAddress: [
                'city' => 'New York',
                'postalCode' => '10045',
                'state' => 'NY',
                'line1' => '33 Liberty Street',
            ],
            debtorAddress: [
                'city' => 'x', 'postalCode' => 'x', 'state' => 'x', 'line1' => 'x',
            ],
            externalAccountID: 'external_account_id',
            requireApproval: true,
            routingNumber: '101050001',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FednowTransfer::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->fednowTransfers->retrieve(
            'fednow_transfer_4i0mptrdu1mueg1196bg'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FednowTransfer::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->fednowTransfers->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(FednowTransfer::class, $item);
        }
    }

    #[Test]
    public function testApprove(): void
    {
        $result = $this->client->fednowTransfers->approve(
            'fednow_transfer_4i0mptrdu1mueg1196bg'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FednowTransfer::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->fednowTransfers->cancel(
            'fednow_transfer_4i0mptrdu1mueg1196bg'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FednowTransfer::class, $result);
    }
}
