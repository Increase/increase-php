<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\WireDrawdownRequestsContract;
use Increase\WireDrawdownRequests\WireDrawdownRequest;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class WireDrawdownRequestsService implements WireDrawdownRequestsContract
{
    /**
     * @api
     */
    public WireDrawdownRequestsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WireDrawdownRequestsRawService($client);
    }

    /**
     * @api
     *
     * Simulates a Wire Drawdown Request being refused by the debtor.
     *
     * @param string $wireDrawdownRequestID the identifier of the Wire Drawdown Request you wish to refuse
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function refuse(
        string $wireDrawdownRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): WireDrawdownRequest {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->refuse($wireDrawdownRequestID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Simulates a Wire Drawdown Request being submitted to Fedwire.
     *
     * @param string $wireDrawdownRequestID the identifier of the Wire Drawdown Request you wish to submit
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submit(
        string $wireDrawdownRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): WireDrawdownRequest {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->submit($wireDrawdownRequestID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
