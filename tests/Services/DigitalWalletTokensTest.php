<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\DigitalWalletTokens\DigitalWalletToken;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class DigitalWalletTokensTest extends TestCase
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
        $result = $this->client->digitalWalletTokens->retrieve(
            'digital_wallet_token_izi62go3h51p369jrie0'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DigitalWalletToken::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->digitalWalletTokens->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(DigitalWalletToken::class, $item);
        }
    }
}
