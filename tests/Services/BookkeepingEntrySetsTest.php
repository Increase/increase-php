<?php

namespace Tests\Services;

use Increase\BookkeepingEntrySets\BookkeepingEntrySet;
use Increase\Client;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class BookkeepingEntrySetsTest extends TestCase
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
        $result = $this->client->bookkeepingEntrySets->create(
            entries: [
                [
                    'accountID' => 'bookkeeping_account_9husfpw68pzmve9dvvc7',
                    'amount' => 100,
                ],
                [
                    'accountID' => 'bookkeeping_account_t2obldz1rcu15zr54umg',
                    'amount' => -100,
                ],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BookkeepingEntrySet::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->bookkeepingEntrySets->create(
            entries: [
                [
                    'accountID' => 'bookkeeping_account_9husfpw68pzmve9dvvc7',
                    'amount' => 100,
                ],
                [
                    'accountID' => 'bookkeeping_account_t2obldz1rcu15zr54umg',
                    'amount' => -100,
                ],
            ],
            date: new \DateTimeImmutable('2020-01-31T23:59:59Z'),
            transactionID: 'transaction_uyrp7fld2ium70oa7oi',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BookkeepingEntrySet::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->bookkeepingEntrySets->retrieve(
            'bookkeeping_entry_set_n80c6wr2p8gtc6p4ingf'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BookkeepingEntrySet::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->bookkeepingEntrySets->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(BookkeepingEntrySet::class, $item);
        }
    }
}
