<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\RoutingNumbers\RoutingNumberListResponse;
use Increase\ServiceContracts\RoutingNumbersContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class RoutingNumbersService implements RoutingNumbersContract
{
    /**
     * @api
     */
    public RoutingNumbersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RoutingNumbersRawService($client);
    }

    /**
     * @api
     *
     * You can use this API to confirm if a routing number is valid, such as when a user is providing you with bank account details. Since routing numbers uniquely identify a bank, this will always return 0 or 1 entry. In Sandbox, the only valid routing number for this method is 110000000.
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
    ): Page {
        $params = Util::removeNulls(
            [
                'routingNumber' => $routingNumber,
                'cursor' => $cursor,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
