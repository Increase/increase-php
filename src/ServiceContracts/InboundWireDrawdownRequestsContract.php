<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\InboundWireDrawdownRequests\InboundWireDrawdownRequest;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundWireDrawdownRequestsContract
{
    /**
     * @api
     *
     * @param string $inboundWireDrawdownRequestID the identifier of the Inbound Wire Drawdown Request to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundWireDrawdownRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): InboundWireDrawdownRequest;

    /**
     * @api
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
    ): Page;
}
