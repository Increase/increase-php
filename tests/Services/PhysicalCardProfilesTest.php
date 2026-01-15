<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Page;
use Increase\PhysicalCardProfiles\PhysicalCardProfile;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class PhysicalCardProfilesTest extends TestCase
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
        $result = $this->client->physicalCardProfiles->create(
            carrierImageFileID: 'file_h6v7mtipe119os47ehlu',
            contactPhone: '+16505046304',
            description: 'My Card Profile',
            frontImageFileID: 'file_o6aex13wm1jcc36sgcj1',
            programID: 'program_i2v2os4mwza1oetokh9i',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCardProfile::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->physicalCardProfiles->create(
            carrierImageFileID: 'file_h6v7mtipe119os47ehlu',
            contactPhone: '+16505046304',
            description: 'My Card Profile',
            frontImageFileID: 'file_o6aex13wm1jcc36sgcj1',
            programID: 'program_i2v2os4mwza1oetokh9i',
            frontText: ['line1' => 'x', 'line2' => 'x'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCardProfile::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->physicalCardProfiles->retrieve(
            'physical_card_profile_m534d5rn9qyy9ufqxoec'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCardProfile::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->physicalCardProfiles->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(PhysicalCardProfile::class, $item);
        }
    }

    #[Test]
    public function testArchive(): void
    {
        $result = $this->client->physicalCardProfiles->archive(
            'physical_card_profile_m534d5rn9qyy9ufqxoec'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCardProfile::class, $result);
    }

    #[Test]
    public function testClone(): void
    {
        $result = $this->client->physicalCardProfiles->clone(
            'physical_card_profile_m534d5rn9qyy9ufqxoec'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCardProfile::class, $result);
    }
}
