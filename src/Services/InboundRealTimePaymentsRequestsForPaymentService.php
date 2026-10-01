<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestForPayment;
use Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestsForPaymentListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundRealTimePaymentsRequestsForPaymentContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestsForPaymentListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundRealTimePaymentsRequestsForPaymentService implements InboundRealTimePaymentsRequestsForPaymentContract
{
    /**
     * @api
     */
    public InboundRealTimePaymentsRequestsForPaymentRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboundRealTimePaymentsRequestsForPaymentRawService($client);
    }

    /**
     * @api
     *
     * Retrieve an Inbound Real-Time Payments Request for Payment
     *
     * @param string $inboundRealTimePaymentsRequestForPaymentID the identifier of the Inbound Real-Time Payments Request for Payment to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundRealTimePaymentsRequestForPaymentID,
        RequestOptions|array|null $requestOptions = null,
    ): InboundRealTimePaymentsRequestForPayment {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($inboundRealTimePaymentsRequestForPaymentID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Inbound Real-Time Payments Requests for Payment
     *
     * @param string $accountID filter Inbound Real-Time Payments Requests for Payment to those belonging to the specified Account
     * @param string $accountNumberID filter Inbound Real-Time Payments Requests for Payment to ones belonging to the specified Account Number
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     *
     * Defaults to `100`.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<InboundRealTimePaymentsRequestForPayment>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        ?string $accountNumberID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        int $limit = 100,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'accountNumberID' => $accountNumberID,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
