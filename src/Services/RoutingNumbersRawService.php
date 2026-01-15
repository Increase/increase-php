<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\RoutingNumbers\RoutingNumberListParams;
use Increase\RoutingNumbers\RoutingNumberListResponse;
use Increase\ServiceContracts\RoutingNumbersRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class RoutingNumbersRawService implements RoutingNumbersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * You can use this API to confirm if a routing number is valid, such as when a user is providing you with bank account details. Since routing numbers uniquely identify a bank, this will always return 0 or 1 entry. In Sandbox, the only valid routing number for this method is 110000000.
     *
     * @param array{
     *   routingNumber: string, cursor?: string, limit?: int
     * }|RoutingNumberListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<RoutingNumberListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|RoutingNumberListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RoutingNumberListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'routing_numbers',
            query: Util::array_transform_keys(
                $parsed,
                ['routingNumber' => 'routing_number']
            ),
            options: $options,
            convert: RoutingNumberListResponse::class,
            page: Page::class,
        );
    }
}
