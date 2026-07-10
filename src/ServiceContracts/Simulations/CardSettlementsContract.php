<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Transactions\Transaction;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardSettlementsContract
{
    /**
     * @api
     *
     * @param string $cardID the identifier of the Card to create a settlement on
     * @param int $amount The amount to be settled. This defaults to the amount of the Pending Transaction being settled, or a random amount if `pending_transaction_id` is not provided.
     * @param string $pendingTransactionID The identifier of the Pending Transaction for the Card Authorization you wish to settle. If not provided, the settlement will be force posted without a Card Authorization.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $cardID,
        ?int $amount = null,
        ?string $pendingTransactionID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Transaction;
}
