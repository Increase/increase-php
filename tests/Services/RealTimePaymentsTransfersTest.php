<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\Page;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class RealTimePaymentsTransfersTest extends TestCase
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
        $result = $this->client->realTimePaymentsTransfers->create(
            amount: 100,
            creditorName: 'Ian Crease',
            remittanceInformation: 'Invoice 29582',
            sourceAccountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RealTimePaymentsTransfer::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->realTimePaymentsTransfers->create(
            amount: 100,
            creditorName: 'Ian Crease',
            remittanceInformation: 'Invoice 29582',
            sourceAccountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            debtorName: 'x',
            destinationAccountNumber: '987654321',
            destinationRoutingNumber: '101050001',
            externalAccountID: 'external_account_id',
            requireApproval: true,
            ultimateCreditorName: 'x',
            ultimateDebtorName: 'x',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RealTimePaymentsTransfer::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->realTimePaymentsTransfers->retrieve(
            'real_time_payments_transfer_iyuhl5kdn7ssmup83mvq'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RealTimePaymentsTransfer::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->realTimePaymentsTransfers->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(RealTimePaymentsTransfer::class, $item);
        }
    }

    #[Test]
    public function testApprove(): void
    {
        $result = $this->client->realTimePaymentsTransfers->approve(
            'real_time_payments_transfer_iyuhl5kdn7ssmup83mvq'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RealTimePaymentsTransfer::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->realTimePaymentsTransfers->cancel(
            'real_time_payments_transfer_iyuhl5kdn7ssmup83mvq'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RealTimePaymentsTransfer::class, $result);
    }
}
