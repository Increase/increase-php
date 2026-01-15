<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\WireDrawdownRequestsRawContract;
use Increase\WireDrawdownRequests\WireDrawdownRequest;
use Increase\WireDrawdownRequests\WireDrawdownRequestCreateParams;
use Increase\WireDrawdownRequests\WireDrawdownRequestCreateParams\CreditorAddress;
use Increase\WireDrawdownRequests\WireDrawdownRequestCreateParams\DebtorAddress;
use Increase\WireDrawdownRequests\WireDrawdownRequestListParams;
use Increase\WireDrawdownRequests\WireDrawdownRequestListParams\Status;

/**
 * @phpstan-import-type CreditorAddressShape from \Increase\WireDrawdownRequests\WireDrawdownRequestCreateParams\CreditorAddress
 * @phpstan-import-type DebtorAddressShape from \Increase\WireDrawdownRequests\WireDrawdownRequestCreateParams\DebtorAddress
 * @phpstan-import-type StatusShape from \Increase\WireDrawdownRequests\WireDrawdownRequestListParams\Status
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
     * Create a Wire Drawdown Request
     *
     * @param array{
     *   accountNumberID: string,
     *   amount: int,
     *   creditorAddress: CreditorAddress|CreditorAddressShape,
     *   creditorName: string,
     *   debtorAddress: DebtorAddress|DebtorAddressShape,
     *   debtorName: string,
     *   unstructuredRemittanceInformation: string,
     *   debtorAccountNumber?: string,
     *   debtorExternalAccountID?: string,
     *   debtorRoutingNumber?: string,
     * }|WireDrawdownRequestCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireDrawdownRequest>
     *
     * @throws APIException
     */
    public function create(
        array|WireDrawdownRequestCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WireDrawdownRequestCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'wire_drawdown_requests',
            body: (object) $parsed,
            options: $options,
            convert: WireDrawdownRequest::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Wire Drawdown Request
     *
     * @param string $wireDrawdownRequestID the identifier of the Wire Drawdown Request to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireDrawdownRequest>
     *
     * @throws APIException
     */
    public function retrieve(
        string $wireDrawdownRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['wire_drawdown_requests/%1$s', $wireDrawdownRequestID],
            options: $requestOptions,
            convert: WireDrawdownRequest::class,
        );
    }

    /**
     * @api
     *
     * List Wire Drawdown Requests
     *
     * @param array{
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|WireDrawdownRequestListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<WireDrawdownRequest>>
     *
     * @throws APIException
     */
    public function list(
        array|WireDrawdownRequestListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WireDrawdownRequestListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'wire_drawdown_requests',
            query: Util::array_transform_keys(
                $parsed,
                ['idempotencyKey' => 'idempotency_key']
            ),
            options: $options,
            convert: WireDrawdownRequest::class,
            page: Page::class,
        );
    }
}
