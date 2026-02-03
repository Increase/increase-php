<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\Page;
use Increase\Programs\Program;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ProgramsTest extends TestCase
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
        $result = $this->client->programs->retrieve('program_i2v2os4mwza1oetokh9i');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Program::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->programs->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Program::class, $item);
        }
    }
}
