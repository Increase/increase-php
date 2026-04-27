<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\LockboxRecipients\LockboxRecipient;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class LockboxRecipientsTest extends TestCase
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
        $result = $this->client->lockboxRecipients->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            lockboxAddressID: 'lockbox_address_lw6sbzl9ol5dfd8hdml6',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LockboxRecipient::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->lockboxRecipients->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            lockboxAddressID: 'lockbox_address_lw6sbzl9ol5dfd8hdml6',
            description: 'x',
            recipientName: 'Ian Crease',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LockboxRecipient::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->lockboxRecipients->retrieve(
            'lockbox_3xt21ok13q19advds4t5'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LockboxRecipient::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->lockboxRecipients->update(
            'lockbox_3xt21ok13q19advds4t5'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LockboxRecipient::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->lockboxRecipients->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(LockboxRecipient::class, $item);
        }
    }
}
