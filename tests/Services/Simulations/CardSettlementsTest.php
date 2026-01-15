<?php

namespace Tests\Services\Simulations;

use Increase\Client;
use Increase\Transactions\Transaction;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class CardSettlementsTest extends TestCase
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
        $result = $this->client->simulations->cardSettlements->create(
            cardID: 'card_oubs0hwk5rn6knuecxg2',
            pendingTransactionID: 'pending_transaction_k1sfetcau2qbvjbzgju4',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Transaction::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->simulations->cardSettlements->create(
            cardID: 'card_oubs0hwk5rn6knuecxg2',
            pendingTransactionID: 'pending_transaction_k1sfetcau2qbvjbzgju4',
            amount: 1,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Transaction::class, $result);
    }
}
