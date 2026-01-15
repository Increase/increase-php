<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;
use Increase\RoutingNumbers\RoutingNumberListResponse;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface RoutingNumbersContract
{
    /**
     * @api
     *
     * @param string $routingNumber filter financial institutions by routing number
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<RoutingNumberListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $routingNumber,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;
}
