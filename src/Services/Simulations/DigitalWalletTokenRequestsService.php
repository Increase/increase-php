<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\DigitalWalletTokenRequestsContract;
use Increase\Simulations\DigitalWalletTokenRequests\DigitalWalletTokenRequestNewResponse;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class DigitalWalletTokenRequestsService implements DigitalWalletTokenRequestsContract
{
    /**
     * @api
     */
    public DigitalWalletTokenRequestsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DigitalWalletTokenRequestsRawService($client);
    }

    /**
     * @api
     *
     * Simulates a user attempting to add a [Card](#cards) to a digital wallet such as Apple Pay.
     *
     * @param string $cardID the identifier of the Card to be authorized
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $cardID,
        RequestOptions|array|null $requestOptions = null
    ): DigitalWalletTokenRequestNewResponse {
        $params = Util::removeNulls(['cardID' => $cardID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
