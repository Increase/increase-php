<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Lockboxes\Lockbox;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class LockboxesTest extends TestCase
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
        $result = $this->client->lockboxes->create(
            accountID: 'account_in71c4amph0vgo2qllky'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Lockbox::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->lockboxes->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            description: 'Rent payments',
            recipientName: 'x',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Lockbox::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->lockboxes->retrieve(
            'lockbox_3xt21ok13q19advds4t5'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Lockbox::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->lockboxes->update('lockbox_3xt21ok13q19advds4t5');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Lockbox::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->lockboxes->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Lockbox::class, $item);
        }
    }
}
