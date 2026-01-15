<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardTokens\CardToken;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardTokensRawContract;
use Increase\Simulations\CardTokens\CardTokenCreateParams;
use Increase\Simulations\CardTokens\CardTokenCreateParams\Capability;

/**
 * @phpstan-import-type CapabilityShape from \Increase\Simulations\CardTokens\CardTokenCreateParams\Capability
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardTokensRawService implements CardTokensRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates tokenizing a card in the sandbox environment.
     *
     * @param array{
     *   capabilities?: list<Capability|CapabilityShape>,
     *   expiration?: string,
     *   last4?: string,
     *   prefix?: string,
     *   primaryAccountNumberLength?: int,
     * }|CardTokenCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardToken>
     *
     * @throws APIException
     */
    public function create(
        array|CardTokenCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardTokenCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/card_tokens',
            body: (object) $parsed,
            options: $options,
            convert: CardToken::class,
        );
    }
}
