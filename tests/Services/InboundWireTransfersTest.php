<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\InboundWireTransfers\InboundWireTransfer;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class InboundWireTransfersTest extends TestCase
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
        $result = $this->client->inboundWireTransfers->retrieve(
            'inbound_wire_transfer_f228m6bmhtcxjco9pwp0'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundWireTransfer::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->inboundWireTransfers->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(InboundWireTransfer::class, $item);
        }
    }

    #[Test]
    public function testReverse(): void
    {
        $result = $this->client->inboundWireTransfers->reverse(
            'inbound_wire_transfer_f228m6bmhtcxjco9pwp0',
            reason: 'creditor_request'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundWireTransfer::class, $result);
    }

    #[Test]
    public function testReverseWithOptionalParams(): void
    {
        $result = $this->client->inboundWireTransfers->reverse(
            'inbound_wire_transfer_f228m6bmhtcxjco9pwp0',
            reason: 'creditor_request'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundWireTransfer::class, $result);
    }
}
