<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\InterestPaymentsContract;
use Increase\Transactions\Transaction;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InterestPaymentsService implements InterestPaymentsContract
{
    /**
     * @api
     */
    public InterestPaymentsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InterestPaymentsRawService($client);
    }

    /**
     * @api
     *
     * Simulates an interest payment to your account. In production, this happens automatically on the first of each month.
     *
     * @param string $accountID the identifier of the Account the Interest Payment should be paid to is for
     * @param int $amount The interest amount in cents. Must be positive.
     * @param string $accruedOnAccountID The identifier of the Account the Interest accrued on. Defaults to `account_id`.
     * @param \DateTimeInterface $periodEnd The end of the interest period. If not provided, defaults to the current time.
     * @param \DateTimeInterface $periodStart The start of the interest period. If not provided, defaults to the current time.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        int $amount,
        ?string $accruedOnAccountID = null,
        ?\DateTimeInterface $periodEnd = null,
        ?\DateTimeInterface $periodStart = null,
        RequestOptions|array|null $requestOptions = null,
    ): Transaction {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'amount' => $amount,
                'accruedOnAccountID' => $accruedOnAccountID,
                'periodEnd' => $periodEnd,
                'periodStart' => $periodStart,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
