<?php

namespace Tests\Services;

use Increase\ACHPrenotifications\ACHPrenotification;
use Increase\Client;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ACHPrenotificationsTest extends TestCase
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
        $result = $this->client->achPrenotifications->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            accountNumber: '987654321',
            routingNumber: '101050001',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ACHPrenotification::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->achPrenotifications->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            accountNumber: '987654321',
            routingNumber: '101050001',
            addendum: 'x',
            companyDescriptiveDate: 'x',
            companyDiscretionaryData: 'x',
            companyEntryDescription: 'x',
            companyName: 'x',
            creditDebitIndicator: 'credit',
            effectiveDate: '2019-12-27',
            individualID: 'x',
            individualName: 'x',
            standardEntryClassCode: 'corporate_credit_or_debit',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ACHPrenotification::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->achPrenotifications->retrieve(
            'ach_prenotification_ubjf9qqsxl3obbcn1u34'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ACHPrenotification::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->achPrenotifications->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(ACHPrenotification::class, $item);
        }
    }
}
