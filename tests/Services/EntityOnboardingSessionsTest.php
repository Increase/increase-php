<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\EntityOnboardingSessions\EntityOnboardingSession;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class EntityOnboardingSessionsTest extends TestCase
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
        $result = $this->client->entityOnboardingSessions->create(
            programID: 'program_i2v2os4mwza1oetokh9i',
            redirectURL: 'https://example.com/onboarding/session',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EntityOnboardingSession::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->entityOnboardingSessions->create(
            programID: 'program_i2v2os4mwza1oetokh9i',
            redirectURL: 'https://example.com/onboarding/session',
            entityID: 'entity_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EntityOnboardingSession::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->entityOnboardingSessions->retrieve(
            'entity_onboarding_session_wid2ug11fsmvh3k9hymd'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EntityOnboardingSession::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->entityOnboardingSessions->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(EntityOnboardingSession::class, $item);
        }
    }

    #[Test]
    public function testExpire(): void
    {
        $result = $this->client->entityOnboardingSessions->expire(
            'entity_onboarding_session_wid2ug11fsmvh3k9hymd'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EntityOnboardingSession::class, $result);
    }
}
