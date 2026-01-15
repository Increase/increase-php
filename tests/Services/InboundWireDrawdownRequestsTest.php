<?php

namespace Tests\Services;

use Increase\Client;
use Increase\InboundWireDrawdownRequests\InboundWireDrawdownRequest;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class InboundWireDrawdownRequestsTest extends TestCase
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
    public function testRetrieve(): void
    {
        $result = $this->client->inboundWireDrawdownRequests->retrieve(
            'inbound_wire_drawdown_request_u5a92ikqhz1ytphn799e'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundWireDrawdownRequest::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->inboundWireDrawdownRequests->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(InboundWireDrawdownRequest::class, $item);
        }
    }
}
