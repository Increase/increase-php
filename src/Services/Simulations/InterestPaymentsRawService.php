<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\InterestPaymentsRawContract;
use Increase\Simulations\InterestPayments\InterestPaymentCreateParams;
use Increase\Transactions\Transaction;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InterestPaymentsRawService implements InterestPaymentsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates an interest payment to your account. In production, this happens automatically on the first of each month.
     *
     * @param array{
     *   accountID: string,
     *   amount: int,
     *   accruedOnAccountID?: string,
     *   periodEnd?: \DateTimeInterface,
     *   periodStart?: \DateTimeInterface,
     * }|InterestPaymentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Transaction>
     *
     * @throws APIException
     */
    public function create(
        array|InterestPaymentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InterestPaymentCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/interest_payments',
            body: (object) $parsed,
            options: $options,
            convert: Transaction::class,
        );
    }
}
