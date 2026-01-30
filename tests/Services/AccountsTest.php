<?php

namespace Tests\Services;

use Increase\Accounts\Account;
use Increase\Accounts\BalanceLookup;
use Increase\Client;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class AccountsTest extends TestCase
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
        $result = $this->client->accounts->create(name: 'New Account!');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Account::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->accounts->create(
            name: 'New Account!',
            entityID: 'entity_n8y8tnk2p9339ti393yi',
            funding: 'loan',
            informationalEntityID: 'informational_entity_id',
            loan: [
                'creditLimit' => 0,
                'gracePeriodDays' => 0,
                'statementDayOfMonth' => 1,
                'statementPaymentType' => 'balance',
                'maturityDate' => '2019-12-27',
            ],
            programID: 'program_i2v2os4mwza1oetokh9i',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Account::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->accounts->retrieve('account_in71c4amph0vgo2qllky');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Account::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->accounts->update('account_in71c4amph0vgo2qllky');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Account::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->accounts->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Account::class, $item);
        }
    }

    #[Test]
    public function testBalance(): void
    {
        $result = $this->client->accounts->balance('account_in71c4amph0vgo2qllky');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BalanceLookup::class, $result);
    }

    #[Test]
    public function testClose(): void
    {
        $result = $this->client->accounts->close('account_in71c4amph0vgo2qllky');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Account::class, $result);
    }
}
