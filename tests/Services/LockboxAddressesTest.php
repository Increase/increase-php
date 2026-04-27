<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\LockboxAddresses\LockboxAddress;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class LockboxAddressesTest extends TestCase
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
        $result = $this->client->lockboxAddresses->create();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LockboxAddress::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->lockboxAddresses->retrieve(
            'lockbox_address_lw6sbzl9ol5dfd8hdml6'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LockboxAddress::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->lockboxAddresses->update(
            'lockbox_address_lw6sbzl9ol5dfd8hdml6'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LockboxAddress::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->lockboxAddresses->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(LockboxAddress::class, $item);
        }
    }
}
