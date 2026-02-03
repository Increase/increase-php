<?php

namespace Tests\Services;

use Increase\AccountNumbers\AccountNumber;
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
final class AccountNumbersTest extends TestCase
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
        $result = $this->client->accountNumbers->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            name: 'Rent payments'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AccountNumber::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->accountNumbers->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            name: 'Rent payments',
            inboundACH: ['debitStatus' => 'allowed'],
            inboundChecks: ['status' => 'allowed'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AccountNumber::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->accountNumbers->retrieve(
            'account_number_v18nkfqm6afpsrvy82b2'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AccountNumber::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->accountNumbers->update(
            'account_number_v18nkfqm6afpsrvy82b2'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AccountNumber::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->accountNumbers->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(AccountNumber::class, $item);
        }
    }
}
