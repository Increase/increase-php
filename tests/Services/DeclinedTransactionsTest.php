<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\DeclinedTransactions\DeclinedTransaction;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class DeclinedTransactionsTest extends TestCase
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
    public function testRetrieve(): void
    {
        $result = $this->client->declinedTransactions->retrieve(
            'declined_transaction_17jbn0yyhvkt4v4ooym8'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeclinedTransaction::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->declinedTransactions->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(DeclinedTransaction::class, $item);
        }
    }
}
