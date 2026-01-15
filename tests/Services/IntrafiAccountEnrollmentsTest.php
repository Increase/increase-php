<?php

namespace Tests\Services;

use Increase\Client;
use Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollment;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class IntrafiAccountEnrollmentsTest extends TestCase
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
        $result = $this->client->intrafiAccountEnrollments->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            emailAddress: 'user@example.com',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(IntrafiAccountEnrollment::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->intrafiAccountEnrollments->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            emailAddress: 'user@example.com',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(IntrafiAccountEnrollment::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->intrafiAccountEnrollments->retrieve(
            'intrafi_account_enrollment_w8l97znzreopkwf2tg75'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(IntrafiAccountEnrollment::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->intrafiAccountEnrollments->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(IntrafiAccountEnrollment::class, $item);
        }
    }

    #[Test]
    public function testUnenroll(): void
    {
        $result = $this->client->intrafiAccountEnrollments->unenroll(
            'intrafi_account_enrollment_w8l97znzreopkwf2tg75'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(IntrafiAccountEnrollment::class, $result);
    }
}
