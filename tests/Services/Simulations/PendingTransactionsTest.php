<?php

namespace Tests\Services\Simulations;

use Increase\Client;
use Increase\Core\Util;
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

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testReleaseInboundFundsHold(): void
    {
        $result = $this
            ->client
            ->simulations
            ->pendingTransactions
            ->releaseInboundFundsHold('pending_transaction_k1sfetcau2qbvjbzgju4')
        ;

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PendingTransaction::class, $result);
    }
}
