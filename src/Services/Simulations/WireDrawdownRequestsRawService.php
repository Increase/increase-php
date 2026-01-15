<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\WireDrawdownRequestsRawContract;
use Increase\WireDrawdownRequests\WireDrawdownRequest;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class WireDrawdownRequestsRawService implements WireDrawdownRequestsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates a Wire Drawdown Request being refused by the debtor.
     *
     * @param string $wireDrawdownRequestID the identifier of the Wire Drawdown Request you wish to refuse
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireDrawdownRequest>
     *
     * @throws APIException
     */
    public function refuse(
        string $wireDrawdownRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'simulations/wire_drawdown_requests/%1$s/refuse', $wireDrawdownRequestID,
            ],
            options: $requestOptions,
            convert: WireDrawdownRequest::class,
        );
    }

    /**
     * @api
     *
     * Simulates a Wire Drawdown Request being submitted to Fedwire.
     *
     * @param string $wireDrawdownRequestID the identifier of the Wire Drawdown Request you wish to submit
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireDrawdownRequest>
     *
     * @throws APIException
     */
    public function submit(
        string $wireDrawdownRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'simulations/wire_drawdown_requests/%1$s/submit', $wireDrawdownRequestID,
            ],
            options: $requestOptions,
            convert: WireDrawdownRequest::class,
        );
    }
}
