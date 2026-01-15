<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CardTokens\CardToken;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\CardTokens\CardTokenCreateParams\Capability;

/**
 * @phpstan-import-type CapabilityShape from \Increase\Simulations\CardTokens\CardTokenCreateParams\Capability
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardTokensContract
{
    /**
     * @api
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
    ): CardToken;
}
