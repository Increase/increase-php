<?php

namespace Tests\Services;

use Increase\BookkeepingAccounts\BookkeepingAccount;
use Increase\BookkeepingAccounts\BookkeepingBalanceLookup;
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
final class BookkeepingAccountsTest extends TestCase
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
        $result = $this->client->bookkeepingAccounts->create(name: 'New Account!');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BookkeepingAccount::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->bookkeepingAccounts->create(
            name: 'New Account!',
            accountID: 'account_id',
            complianceCategory: 'commingled_cash',
            entityID: 'entity_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BookkeepingAccount::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->bookkeepingAccounts->update(
            'bookkeeping_account_e37p1f1iuocw5intf35v',
            name: 'Deprecated Account'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BookkeepingAccount::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $result = $this->client->bookkeepingAccounts->update(
            'bookkeeping_account_e37p1f1iuocw5intf35v',
            name: 'Deprecated Account'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BookkeepingAccount::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->bookkeepingAccounts->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(BookkeepingAccount::class, $item);
        }
    }

    #[Test]
    public function testBalance(): void
    {
        $result = $this->client->bookkeepingAccounts->balance(
            'bookkeeping_account_e37p1f1iuocw5intf35v'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BookkeepingBalanceLookup::class, $result);
    }
}
