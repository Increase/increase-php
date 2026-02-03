<?php

namespace Tests\Services\Simulations;

use Increase\AccountTransfers\AccountTransfer;
use Increase\Client;
use Increase\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class AccountTransfersTest extends TestCase
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
    public function testComplete(): void
    {
        $result = $this->client->simulations->accountTransfers->complete(
            'account_transfer_7k9qe1ysdgqztnt63l7n'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AccountTransfer::class, $result);
    }
}
