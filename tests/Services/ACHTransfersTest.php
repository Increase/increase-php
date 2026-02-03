<?php

namespace Tests\Services;

use Increase\ACHTransfers\ACHTransfer;
use Increase\Client;
use Increase\Core\Util;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ACHTransfersTest extends TestCase
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
        $result = $this->client->achTransfers->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: 100,
            statementDescriptor: 'New ACH transfer',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ACHTransfer::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->achTransfers->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: 100,
            statementDescriptor: 'New ACH transfer',
            accountNumber: '987654321',
            addenda: [
                'category' => 'freeform',
                'freeform' => ['entries' => [['paymentRelatedInformation' => 'x']]],
                'paymentOrderRemittanceAdvice' => [
                    'invoices' => [['invoiceNumber' => 'x', 'paidAmount' => 0]],
                ],
            ],
            companyDescriptiveDate: 'x',
            companyDiscretionaryData: 'x',
            companyEntryDescription: 'x',
            companyName: 'x',
            destinationAccountHolder: 'business',
            externalAccountID: 'external_account_id',
            funding: 'checking',
            individualID: 'x',
            individualName: 'x',
            preferredEffectiveDate: [
                'date' => '2019-12-27', 'settlementSchedule' => 'same_day',
            ],
            requireApproval: true,
            routingNumber: '101050001',
            standardEntryClassCode: 'corporate_credit_or_debit',
            transactionTiming: 'synchronous',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ACHTransfer::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->achTransfers->retrieve(
            'ach_transfer_uoxatyh3lt5evrsdvo7q'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ACHTransfer::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->achTransfers->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(ACHTransfer::class, $item);
        }
    }

    #[Test]
    public function testApprove(): void
    {
        $result = $this->client->achTransfers->approve(
            'ach_transfer_uoxatyh3lt5evrsdvo7q'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ACHTransfer::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->achTransfers->cancel(
            'ach_transfer_uoxatyh3lt5evrsdvo7q'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ACHTransfer::class, $result);
    }
}
