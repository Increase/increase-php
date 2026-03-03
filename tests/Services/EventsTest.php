<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Exceptions\WebhookException;
use Increase\Core\Util;
use Increase\Events\Event;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use StandardWebhooks\Webhook;

/**
 * @internal
 */
#[CoversNothing]
final class EventsTest extends TestCase
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
        $result = $this->client->events->retrieve(
            'event_001dzz0r20rzr4zrhrr1364hy80'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Event::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->events->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Event::class, $item);
        }
    }

    #[Test]
    public function testUnwrap(): void
    {
        $payload = '{"id":"event_001dzz0r20rzr4zrhrr1364hy80","associated_object_id":"account_in71c4amph0vgo2qllky","associated_object_type":"account","category":"account.created","created_at":"2020-01-31T23:59:59Z","type":"event"}';
        $this->client->events->unwrap($payload);
        // unwrap successful if not error thrown, increment assertion count to avoid risky test warning
        $this->addToAssertionCount(1);
    }

    #[Test]
    public function testUnwrapBadJson(): void
    {
        $this->expectException(WebhookException::class);

        $badPayload = 'not a json string';
        $this->client->events->unwrap($badPayload);
    }

    #[Test]
    public function testUnwrapWithVerification(): void
    {
        $payload = '{"id":"event_001dzz0r20rzr4zrhrr1364hy80","associated_object_id":"account_in71c4amph0vgo2qllky","associated_object_type":"account","category":"account.created","created_at":"2020-01-31T23:59:59Z","type":"event"}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $this->client->events->unwrap($payload, $headers, $secret);
        // unwrap successful if not error thrown, increment assertion count to avoid risky test warning
        $this->addToAssertionCount(1);
    }

    #[Test]
    public function testUnwrapWrongKey(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"id":"event_001dzz0r20rzr4zrhrr1364hy80","associated_object_id":"account_in71c4amph0vgo2qllky","associated_object_type":"account","category":"account.created","created_at":"2020-01-31T23:59:59Z","type":"event"}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $wrongKey = 'whsec_aaaaaaaaaa';
        $this->client->events->unwrap($payload, $headers, $wrongKey);
    }

    #[Test]
    public function testUnwrapBadSignature(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"id":"event_001dzz0r20rzr4zrhrr1364hy80","associated_object_id":"account_in71c4amph0vgo2qllky","associated_object_type":"account","category":"account.created","created_at":"2020-01-31T23:59:59Z","type":"event"}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $badSig = $webhook->sign($messageId, $timestamp, 'some other payload');

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$badSig],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $this->client->events->unwrap($payload, $headers, $secret);
    }

    #[Test]
    public function testUnwrapOldTimestamp(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"id":"event_001dzz0r20rzr4zrhrr1364hy80","associated_object_id":"account_in71c4amph0vgo2qllky","associated_object_type":"account","category":"account.created","created_at":"2020-01-31T23:59:59Z","type":"event"}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => ['5'],
        ];
        $this->client->events->unwrap($payload, $headers, $secret);
    }

    #[Test]
    public function testUnwrapWrongMessageID(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"id":"event_001dzz0r20rzr4zrhrr1364hy80","associated_object_id":"account_in71c4amph0vgo2qllky","associated_object_type":"account","category":"account.created","created_at":"2020-01-31T23:59:59Z","type":"event"}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => ['wrong'],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $this->client->events->unwrap($payload, $headers, $secret);
    }
}
