<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\ServiceContracts\SimulationsRawContract;

final class SimulationsRawService implements SimulationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
