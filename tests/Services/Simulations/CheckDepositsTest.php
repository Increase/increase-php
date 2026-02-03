<?php

namespace Tests\Services\Simulations;

use Increase\CheckDeposits\CheckDeposit;
use Increase\Client;
use Increase\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class CheckDepositsTest extends TestCase
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
    public function testReject(): void
    {
        $result = $this->client->simulations->checkDeposits->reject(
            'check_deposit_f06n9gpg7sxn8t19lfc1'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckDeposit::class, $result);
    }

    #[Test]
    public function testReturn(): void
    {
        $result = $this->client->simulations->checkDeposits->return(
            'check_deposit_f06n9gpg7sxn8t19lfc1'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckDeposit::class, $result);
    }

    #[Test]
    public function testSubmit(): void
    {
        $result = $this->client->simulations->checkDeposits->submit(
            'check_deposit_f06n9gpg7sxn8t19lfc1'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckDeposit::class, $result);
    }
}
