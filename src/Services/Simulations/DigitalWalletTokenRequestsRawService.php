<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\DigitalWalletTokenRequestsRawContract;
use Increase\Simulations\DigitalWalletTokenRequests\DigitalWalletTokenRequestCreateParams;
use Increase\Simulations\DigitalWalletTokenRequests\DigitalWalletTokenRequestNewResponse;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class DigitalWalletTokenRequestsRawService implements DigitalWalletTokenRequestsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates a user attempting to add a [Card](#cards) to a digital wallet such as Apple Pay.
     *
     * @param array{cardID: string}|DigitalWalletTokenRequestCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DigitalWalletTokenRequestNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|DigitalWalletTokenRequestCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DigitalWalletTokenRequestCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/digital_wallet_token_requests',
            body: (object) $parsed,
            options: $options,
            convert: DigitalWalletTokenRequestNewResponse::class,
        );
    }
}
