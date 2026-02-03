<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\InboundMailItems\InboundMailItem;
use Increase\Page;
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

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->inboundMailItems->retrieve(
            'inbound_mail_item_q6rrg7mmqpplx80zceev'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundMailItem::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->inboundMailItems->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(InboundMailItem::class, $item);
        }
    }

    #[Test]
    public function testAction(): void
    {
        $result = $this->client->inboundMailItems->action(
            'inbound_mail_item_q6rrg7mmqpplx80zceev',
            checks: [['action' => 'deposit'], ['action' => 'ignore']],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundMailItem::class, $result);
    }

    #[Test]
    public function testActionWithOptionalParams(): void
    {
        $result = $this->client->inboundMailItems->action(
            'inbound_mail_item_q6rrg7mmqpplx80zceev',
            checks: [
                ['action' => 'deposit', 'account' => 'account_in71c4amph0vgo2qllky'],
                ['action' => 'ignore', 'account' => 'account'],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundMailItem::class, $result);
    }
}
