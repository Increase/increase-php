<?php

namespace Tests\Services;

use Increase\Client;
use Increase\IntrafiBalances\IntrafiBalance;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class IntrafiBalancesTest extends TestCase
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
    public function testIntrafiBalance(): void
    {
        $result = $this->client->intrafiBalances->intrafiBalance(
            'account_in71c4amph0vgo2qllky'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(IntrafiBalance::class, $result);
    }
}
