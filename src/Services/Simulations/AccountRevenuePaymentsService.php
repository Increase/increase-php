<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\AccountRevenuePaymentsContract;
use Increase\Transactions\Transaction;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class AccountRevenuePaymentsService implements AccountRevenuePaymentsContract
{
    /**
     * @api
     */
    public AccountRevenuePaymentsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AccountRevenuePaymentsRawService($client);
    }

    /**
     * @api
     *
     * Simulates an account revenue payment to your account. In production, this happens automatically on the first of each month.
     *
     * @param string $accountID the identifier of the Account the Account Revenue Payment should be paid to
     * @param int $amount The account revenue amount in cents. Must be positive.
     * @param string $accruedOnAccountID The identifier of the Account the account revenue accrued on. Defaults to `account_id`.
     * @param \DateTimeInterface $periodEnd The end of the account revenue period. If not provided, defaults to the current time.
     * @param \DateTimeInterface $periodStart The start of the account revenue period. If not provided, defaults to the current time.
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
