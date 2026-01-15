<?php

namespace Tests\Services\Simulations;

use Increase\Client;
use Increase\WireTransfers\WireTransfer;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class WireTransfersTest extends TestCase
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
    public function testReverse(): void
    {
        $result = $this->client->simulations->wireTransfers->reverse(
            'wire_transfer_5akynk7dqsq25qwk9q2u'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WireTransfer::class, $result);
    }

    #[Test]
    public function testSubmit(): void
    {
        $result = $this->client->simulations->wireTransfers->submit(
            'wire_transfer_5akynk7dqsq25qwk9q2u'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WireTransfer::class, $result);
    }
}
