<?php

namespace Tests\Services;

use Increase\CheckbookChecks\CheckbookCheck;
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
final class CheckbookChecksTest extends TestCase
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
        $result = $this->client->checkbookChecks->retrieve(
            'checkbook_check_klgh3z50guf6jcnfhibb'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckbookCheck::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->checkbookChecks->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(CheckbookCheck::class, $item);
        }
    }

    #[Test]
    public function testStop(): void
    {
        $result = $this->client->checkbookChecks->stop(
            'checkbook_check_klgh3z50guf6jcnfhibb'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckbookCheck::class, $result);
    }
}
