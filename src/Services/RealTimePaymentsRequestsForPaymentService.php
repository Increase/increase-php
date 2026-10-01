<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCancelParams\Reason;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCreateParams\Debtor;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentListParams\CreatedAt;
use Increase\RequestOptions;
use Increase\ServiceContracts\RealTimePaymentsRequestsForPaymentContract;

/**
 * @phpstan-import-type DebtorShape from \Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCreateParams\Debtor
 * @phpstan-import-type CreatedAtShape from \Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class RealTimePaymentsRequestsForPaymentService implements RealTimePaymentsRequestsForPaymentContract
{
    /**
     * @api
     */
    public RealTimePaymentsRequestsForPaymentRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RealTimePaymentsRequestsForPaymentRawService($client);
    }

    /**
     * @api
     *
     * Create a Real-Time Payments Request for Payment
     *
     * @param string $accountNumberID the identifier of the Account Number where the funds will land
     * @param int $amount The requested amount in USD cents. Must be positive.
     * @param Debtor|DebtorShape $debtor details of the person being requested to pay
     * @param string $debtorAccountNumber the debtor's account number, which the funds will be requested from
     * @param string $debtorRoutingNumber the debtor's American Bankers' Association (ABA) Routing Transit Number (RTN)
     * @param \DateTimeInterface $expiresAt The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time after which the request for payment is no longer valid. After this time the debtor's bank should no longer allow the debtor to pay it. Must not be before `requested_execution_at`.
     * @param \DateTimeInterface $requestedExecutionAt The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time by which you are requesting the payment to be made.
     * @param string $unstructuredRemittanceInformation unstructured information that will show on the recipient's bank statement
     * @param string $creditorName The name of the creditor requesting the payment. If not provided, defaults to the name of the account's entity.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountNumberID,
        int $amount,
        Debtor|array $debtor,
        string $debtorAccountNumber,
        string $debtorRoutingNumber,
        \DateTimeInterface $expiresAt,
        \DateTimeInterface $requestedExecutionAt,
        string $unstructuredRemittanceInformation,
        ?string $creditorName = null,
        RequestOptions|array|null $requestOptions = null,
    ): RealTimePaymentsRequestForPayment {
        $params = Util::removeNulls(
            [
                'accountNumberID' => $accountNumberID,
                'amount' => $amount,
                'debtor' => $debtor,
                'debtorAccountNumber' => $debtorAccountNumber,
                'debtorRoutingNumber' => $debtorRoutingNumber,
                'expiresAt' => $expiresAt,
                'requestedExecutionAt' => $requestedExecutionAt,
                'unstructuredRemittanceInformation' => $unstructuredRemittanceInformation,
                'creditorName' => $creditorName,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Real-Time Payments Request for Payment
     *
     * @param string $realTimePaymentsRequestForPaymentID the identifier of the Real-Time Payments Request for Payment
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $realTimePaymentsRequestForPaymentID,
        RequestOptions|array|null $requestOptions = null,
    ): RealTimePaymentsRequestForPayment {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($realTimePaymentsRequestForPaymentID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Real-Time Payments Requests for Payment
     *
     * @param string $accountID filter Real-Time Payments Requests for Payment to those destined to the specified Account
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     *
     * Defaults to `100`.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<RealTimePaymentsRequestForPayment>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        int $limit = 100,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'idempotencyKey' => $idempotencyKey,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancels a Real-Time Payments Request for Payment that is still awaiting payment.
     *
     * @param string $realTimePaymentsRequestForPaymentID the identifier of the Real-Time Payments Request for Payment to cancel
     * @param string $additionalInformation additional information about the cancellation to pass on to the recipient bank
     * @param Reason|value-of<Reason> $reason The reason the request for payment is being canceled. Defaults to `requested_by_customer`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $realTimePaymentsRequestForPaymentID,
        ?string $additionalInformation = null,
        Reason|string|null $reason = null,
        RequestOptions|array|null $requestOptions = null,
    ): RealTimePaymentsRequestForPayment {
        $params = Util::removeNulls(
            ['additionalInformation' => $additionalInformation, 'reason' => $reason]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($realTimePaymentsRequestForPaymentID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
