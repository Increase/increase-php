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
final class InterestPaymentsTest extends TestCase
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
        $result = $this->client->simulations->interestPayments->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: 1000
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Transaction::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->simulations->interestPayments->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: 1000,
            accruedOnAccountID: 'accrued_on_account_id',
            periodEnd: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            periodStart: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Transaction::class, $result);
    }
}
