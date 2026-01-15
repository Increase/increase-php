<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardTokens\CardToken;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardTokensContract;
use Increase\Simulations\CardTokens\CardTokenCreateParams\Capability;

/**
 * @phpstan-import-type CapabilityShape from \Increase\Simulations\CardTokens\CardTokenCreateParams\Capability
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardTokensService implements CardTokensContract
{
    /**
     * @api
     */
    public CardTokensRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardTokensRawService($client);
    }

    /**
     * @api
     *
     * Simulates tokenizing a card in the sandbox environment.
     *
     * @param list<Capability|CapabilityShape> $capabilities the capabilities of the outbound card token
     * @param string $expiration the expiration date of the card
     * @param string $last4 the last 4 digits of the card number
     * @param string $prefix the prefix of the card number, usually the first 8 digits
     * @param int $primaryAccountNumberLength the total length of the card number, including prefix and last4
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?array $capabilities = null,
        ?string $expiration = null,
        ?string $last4 = null,
        ?string $prefix = null,
        ?int $primaryAccountNumberLength = null,
        RequestOptions|array|null $requestOptions = null,
    ): CardToken {
        $params = Util::removeNulls(
            [
                'capabilities' => $capabilities,
                'expiration' => $expiration,
                'last4' => $last4,
                'prefix' => $prefix,
                'primaryAccountNumberLength' => $primaryAccountNumberLength,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
