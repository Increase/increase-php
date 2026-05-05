<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Transactions\Transaction;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface AccountRevenuePaymentsContract
{
    /**
     * @api
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
    ): Transaction;
}
