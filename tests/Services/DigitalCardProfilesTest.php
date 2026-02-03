<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\DigitalCardProfiles\DigitalCardProfile;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class DigitalCardProfilesTest extends TestCase
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
        $result = $this->client->digitalCardProfiles->create(
            appIconFileID: 'file_8zxqkwlh43wo144u8yec',
            backgroundImageFileID: 'file_1ai913suu1zfn1pdetru',
            cardDescription: 'MyBank Signature Card',
            description: 'My Card Profile',
            issuerName: 'MyBank',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DigitalCardProfile::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->digitalCardProfiles->create(
            appIconFileID: 'file_8zxqkwlh43wo144u8yec',
            backgroundImageFileID: 'file_1ai913suu1zfn1pdetru',
            cardDescription: 'MyBank Signature Card',
            description: 'My Card Profile',
            issuerName: 'MyBank',
            contactEmail: 'user@example.com',
            contactPhone: '+18885551212',
            contactWebsite: 'https://example.com',
            textColor: ['blue' => 59, 'green' => 43, 'red' => 26],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DigitalCardProfile::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->digitalCardProfiles->retrieve(
            'digital_card_profile_s3puplu90f04xhcwkiga'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DigitalCardProfile::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->digitalCardProfiles->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(DigitalCardProfile::class, $item);
        }
    }

    #[Test]
    public function testArchive(): void
    {
        $result = $this->client->digitalCardProfiles->archive(
            'digital_card_profile_s3puplu90f04xhcwkiga'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DigitalCardProfile::class, $result);
    }

    #[Test]
    public function testClone(): void
    {
        $result = $this->client->digitalCardProfiles->clone(
            'digital_card_profile_s3puplu90f04xhcwkiga'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DigitalCardProfile::class, $result);
    }
}
