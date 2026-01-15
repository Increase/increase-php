<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundWireDrawdownRequests\InboundWireDrawdownRequest;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundWireDrawdownRequestsContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundWireDrawdownRequestsService implements InboundWireDrawdownRequestsContract
{
    /**
     * @api
     */
    public InboundWireDrawdownRequestsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboundWireDrawdownRequestsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve an Inbound Wire Drawdown Request
     *
     * @param string $inboundWireDrawdownRequestID the identifier of the Inbound Wire Drawdown Request to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundWireDrawdownRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): InboundWireDrawdownRequest {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($inboundWireDrawdownRequestID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Inbound Wire Drawdown Requests
     *
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<InboundWireDrawdownRequest>
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
