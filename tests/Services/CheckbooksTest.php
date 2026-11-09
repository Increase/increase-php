<?php

namespace Tests\Services;

use Increase\Checkbooks\Checkbook;
use Increase\Client;
use Increase\Core\Util;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class CheckbooksTest extends TestCase
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
        $result = $this->client->checkbooks->create(
            accountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            mailingAddress: [
                'city' => 'New York',
                'line1' => '33 Liberty Street',
                'name' => 'Ian Crease',
                'postalCode' => '10045',
                'state' => 'NY',
            ],
            payer: [
                ['contents' => 'National Phonograph Company'],
                ['contents' => '33 Liberty Street'],
                ['contents' => 'New York, NY 10045'],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Checkbook::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->checkbooks->create(
            accountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            mailingAddress: [
                'city' => 'New York',
                'line1' => '33 Liberty Street',
                'name' => 'Ian Crease',
                'postalCode' => '10045',
                'state' => 'NY',
                'line2' => 'line2',
            ],
            payer: [
                ['contents' => 'National Phonograph Company'],
                ['contents' => '33 Liberty Street'],
                ['contents' => 'New York, NY 10045'],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Checkbook::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->checkbooks->retrieve(
            'checkbook_7iudxhxum6vlkcjxmi8y'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Checkbook::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->checkbooks->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Checkbook::class, $item);
        }
    }

    #[Test]
    public function testStop(): void
    {
        $result = $this->client->checkbooks->stop('checkbook_7iudxhxum6vlkcjxmi8y');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Checkbook::class, $result);
    }
}
