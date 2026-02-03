<?php

namespace Tests\Services;

use Increase\CheckTransfers\CheckTransfer;
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
final class CheckTransfersTest extends TestCase
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
        $result = $this->client->checkTransfers->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: 1000,
            fulfillmentMethod: 'physical_check',
            sourceAccountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckTransfer::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->checkTransfers->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: 1000,
            fulfillmentMethod: 'physical_check',
            sourceAccountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            balanceCheck: 'full',
            checkNumber: 'x',
            physicalCheck: [
                'mailingAddress' => [
                    'city' => 'New York',
                    'line1' => '33 Liberty Street',
                    'postalCode' => '10045',
                    'state' => 'NY',
                    'line2' => 'x',
                    'name' => 'Ian Crease',
                    'phone' => '+16505046304',
                ],
                'memo' => 'Check payment',
                'recipientName' => 'Ian Crease',
                'attachmentFileID' => 'attachment_file_id',
                'checkVoucherImageFileID' => 'check_voucher_image_file_id',
                'note' => 'x',
                'payer' => [['contents' => 'x']],
                'returnAddress' => [
                    'city' => 'x',
                    'line1' => 'x',
                    'name' => 'x',
                    'postalCode' => 'x',
                    'state' => 'x',
                    'line2' => 'x',
                    'phone' => 'x',
                ],
                'shippingMethod' => 'usps_first_class',
                'signatureText' => 'Ian Crease',
            ],
            requireApproval: true,
            thirdParty: ['recipientName' => 'x'],
            validUntilDate: '2025-12-31',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckTransfer::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->checkTransfers->retrieve(
            'check_transfer_30b43acfu9vw8fyc4f5'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckTransfer::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->checkTransfers->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(CheckTransfer::class, $item);
        }
    }

    #[Test]
    public function testApprove(): void
    {
        $result = $this->client->checkTransfers->approve(
            'check_transfer_30b43acfu9vw8fyc4f5'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckTransfer::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->checkTransfers->cancel(
            'check_transfer_30b43acfu9vw8fyc4f5'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckTransfer::class, $result);
    }

    #[Test]
    public function testStopPayment(): void
    {
        $result = $this->client->checkTransfers->stopPayment(
            'check_transfer_30b43acfu9vw8fyc4f5'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckTransfer::class, $result);
    }
}
