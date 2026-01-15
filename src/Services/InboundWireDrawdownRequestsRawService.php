<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundWireDrawdownRequests\InboundWireDrawdownRequest;
use Increase\InboundWireDrawdownRequests\InboundWireDrawdownRequestListParams;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundWireDrawdownRequestsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundWireDrawdownRequestsRawService implements InboundWireDrawdownRequestsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve an Inbound Wire Drawdown Request
     *
     * @param string $inboundWireDrawdownRequestID the identifier of the Inbound Wire Drawdown Request to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundWireDrawdownRequest>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundWireDrawdownRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'inbound_wire_drawdown_requests/%1$s', $inboundWireDrawdownRequestID,
            ],
            options: $requestOptions,
            convert: InboundWireDrawdownRequest::class,
        );
    }

    /**
     * @api
     *
     * List Inbound Wire Drawdown Requests
     *
     * @param array{
     *   cursor?: string, limit?: int
     * }|InboundWireDrawdownRequestListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundWireDrawdownRequest>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundWireDrawdownRequestListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundWireDrawdownRequestListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'inbound_wire_drawdown_requests',
            query: $parsed,
            options: $options,
            convert: InboundWireDrawdownRequest::class,
            page: Page::class,
        );
    }
}
