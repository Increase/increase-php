<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\Page;
use Increase\SupplementalDocuments\EntitySupplementalDocument;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class SupplementalDocumentsTest extends TestCase
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
        $result = $this->client->supplementalDocuments->create(
            entityID: 'entity_n8y8tnk2p9339ti393yi',
            fileID: 'file_makxrc67oh9l6sg7w9yc',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EntitySupplementalDocument::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->supplementalDocuments->create(
            entityID: 'entity_n8y8tnk2p9339ti393yi',
            fileID: 'file_makxrc67oh9l6sg7w9yc',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EntitySupplementalDocument::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->supplementalDocuments->list(entityID: 'entity_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(EntitySupplementalDocument::class, $item);
        }
    }

    #[Test]
    public function testListWithOptionalParams(): void
    {
        $page = $this->client->supplementalDocuments->list(
            entityID: 'entity_id',
            cursor: 'cursor',
            idempotencyKey: 'x',
            limit: 1
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(EntitySupplementalDocument::class, $item);
        }
    }
}
