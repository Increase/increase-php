<?php

namespace Tests\Services;

use Increase\CardTokens\CardToken;
use Increase\CardTokens\CardTokenCapabilities;
use Increase\Client;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class CardTokensTest extends TestCase
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
    public function testRetrieve(): void
    {
        $result = $this->client->cardTokens->retrieve(
            'outbound_card_token_zlt0ml6youq3q7vcdlg0'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardToken::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->cardTokens->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(CardToken::class, $item);
        }
    }

    #[Test]
    public function testCapabilities(): void
    {
        $result = $this->client->cardTokens->capabilities(
            'outbound_card_token_zlt0ml6youq3q7vcdlg0'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardTokenCapabilities::class, $result);
    }
}
