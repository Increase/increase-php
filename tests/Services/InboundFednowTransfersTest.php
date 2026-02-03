<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\InboundFednowTransfers\InboundFednowTransfer;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class InboundFednowTransfersTest extends TestCase
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
        $result = $this->client->inboundFednowTransfers->retrieve(
            'inbound_fednow_transfer_ctxxbc07oh5ke5w1hk20'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundFednowTransfer::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->inboundFednowTransfers->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(InboundFednowTransfer::class, $item);
        }
    }
}
