<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Page;
use Increase\PendingTransactions\PendingTransaction;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class PendingTransactionsTest extends TestCase
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
        $result = $this->client->pendingTransactions->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: -1000
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PendingTransaction::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->pendingTransactions->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: -1000,
            description: 'Hold for pending transaction',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PendingTransaction::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->pendingTransactions->retrieve(
            'pending_transaction_k1sfetcau2qbvjbzgju4'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PendingTransaction::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->pendingTransactions->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(PendingTransaction::class, $item);
        }
    }

    #[Test]
    public function testRelease(): void
    {
        $result = $this->client->pendingTransactions->release(
            'pending_transaction_k1sfetcau2qbvjbzgju4'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PendingTransaction::class, $result);
    }
}
