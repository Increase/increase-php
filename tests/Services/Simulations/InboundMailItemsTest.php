<?php

namespace Tests\Services\Simulations;

use Increase\Client;
use Increase\InboundMailItems\InboundMailItem;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class InboundMailItemsTest extends TestCase
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
        $result = $this->client->simulations->inboundMailItems->create(
            amount: 1000,
            lockboxID: 'lockbox_3xt21ok13q19advds4t5'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundMailItem::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->simulations->inboundMailItems->create(
            amount: 1000,
            lockboxID: 'lockbox_3xt21ok13q19advds4t5',
            contentsFileID: 'contents_file_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundMailItem::class, $result);
    }
}
