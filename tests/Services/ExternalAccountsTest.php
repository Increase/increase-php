<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\ExternalAccounts\ExternalAccount;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ExternalAccountsTest extends TestCase
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
        $result = $this->client->externalAccounts->create(
            accountNumber: '987654321',
            description: 'Landlord',
            routingNumber: '101050001',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ExternalAccount::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->externalAccounts->create(
            accountNumber: '987654321',
            description: 'Landlord',
            routingNumber: '101050001',
            accountHolder: 'business',
            funding: 'checking',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ExternalAccount::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->externalAccounts->retrieve(
            'external_account_ukk55lr923a3ac0pp7iv'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ExternalAccount::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->externalAccounts->update(
            'external_account_ukk55lr923a3ac0pp7iv'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ExternalAccount::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->externalAccounts->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(ExternalAccount::class, $item);
        }
    }
}
