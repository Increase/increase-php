<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\IntrafiExclusions\IntrafiExclusion;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class IntrafiExclusionsTest extends TestCase
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
        $result = $this->client->intrafiExclusions->create(
            entityID: 'entity_n8y8tnk2p9339ti393yi',
            fdicCertificateNumber: '314159'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(IntrafiExclusion::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->intrafiExclusions->create(
            entityID: 'entity_n8y8tnk2p9339ti393yi',
            fdicCertificateNumber: '314159'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(IntrafiExclusion::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->intrafiExclusions->retrieve(
            'account_in71c4amph0vgo2qllky'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(IntrafiExclusion::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->intrafiExclusions->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(IntrafiExclusion::class, $item);
        }
    }

    #[Test]
    public function testArchive(): void
    {
        $result = $this->client->intrafiExclusions->archive(
            'intrafi_exclusion_ygfqduuzpau3jqof6jyh'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(IntrafiExclusion::class, $result);
    }
}
