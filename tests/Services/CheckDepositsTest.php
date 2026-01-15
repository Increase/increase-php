<?php

namespace Tests\Services;

use Increase\CheckDeposits\CheckDeposit;
use Increase\Client;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class CheckDepositsTest extends TestCase
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
        $result = $this->client->checkDeposits->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: 1000,
            backImageFileID: 'file_26khfk98mzfz90a11oqx',
            frontImageFileID: 'file_hkv175ovmc2tb2v2zbrm',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckDeposit::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->checkDeposits->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: 1000,
            backImageFileID: 'file_26khfk98mzfz90a11oqx',
            frontImageFileID: 'file_hkv175ovmc2tb2v2zbrm',
            description: 'Vendor payment',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckDeposit::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->checkDeposits->retrieve(
            'check_deposit_f06n9gpg7sxn8t19lfc1'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckDeposit::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->checkDeposits->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(CheckDeposit::class, $item);
        }
    }
}
