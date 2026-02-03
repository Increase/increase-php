<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\EventSubscriptions\EventSubscription;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class EventSubscriptionsTest extends TestCase
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
    public function testCreate(): void
    {
        $result = $this->client->eventSubscriptions->create(
            url: 'https://website.com/webhooks'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EventSubscription::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->eventSubscriptions->create(
            url: 'https://website.com/webhooks',
            oauthConnectionID: 'x',
            selectedEventCategory: 'account.created',
            sharedSecret: 'x',
            status: 'active',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EventSubscription::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->eventSubscriptions->retrieve(
            'event_subscription_001dzz0r20rcdxgb013zqb8m04g'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EventSubscription::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->eventSubscriptions->update(
            'event_subscription_001dzz0r20rcdxgb013zqb8m04g'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EventSubscription::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->eventSubscriptions->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(EventSubscription::class, $item);
        }
    }
}
