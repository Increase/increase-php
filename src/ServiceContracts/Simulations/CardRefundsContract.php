<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Transactions\Transaction;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardRefundsContract
{
    /**
     * @api
     *
     * @param int $amount The refund amount in cents. Pulled off the `pending_transaction` or the `transaction` if not provided.
     * @param string $pendingTransactionID The identifier of the Pending Transaction for the refund authorization. If this is provided, `transaction` must not be provided as a refund with a refund authorized can not be linked to a regular transaction.
     * @param string $transactionID The identifier for the Transaction to refund. The Transaction's source must have a category of card_settlement.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?int $amount = null,
        ?string $pendingTransactionID = null,
        ?string $transactionID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Transaction;
}
