<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\Files\File;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class FilesTest extends TestCase
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
        $result = $this->client->files->create(
            file: 'file',
            purpose: 'check_image_front'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(File::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->files->create(
            file: 'file',
            purpose: 'check_image_front',
            description: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(File::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->files->retrieve('file_makxrc67oh9l6sg7w9yc');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(File::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->files->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(File::class, $item);
        }
    }
}
