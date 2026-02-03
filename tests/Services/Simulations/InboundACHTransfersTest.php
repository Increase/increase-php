<?php

namespace Tests\Services\Simulations;

use Increase\Client;
use Increase\Core\Util;
use Increase\InboundACHTransfers\InboundACHTransfer;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class InboundACHTransfersTest extends TestCase
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
        $result = $this->client->simulations->inboundACHTransfers->create(
            accountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            amount: 1000
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundACHTransfer::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->simulations->inboundACHTransfers->create(
            accountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            amount: 1000,
            addenda: [
                'category' => 'freeform',
                'freeform' => ['entries' => [['paymentRelatedInformation' => 'x']]],
            ],
            companyDescriptiveDate: 'x',
            companyDiscretionaryData: 'x',
            companyEntryDescription: 'x',
            companyID: 'x',
            companyName: 'x',
            receiverIDNumber: 'x',
            receiverName: 'x',
            resolveAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            standardEntryClassCode: 'corporate_credit_or_debit',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundACHTransfer::class, $result);
    }
}
