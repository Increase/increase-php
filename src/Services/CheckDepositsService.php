<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CheckDeposits\CheckDeposit;
use Increase\CheckDeposits\CheckDepositListParams\CreatedAt;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CheckDepositsContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\CheckDeposits\CheckDepositListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CheckDepositsService implements CheckDepositsContract
{
    /**
     * @api
     */
    public CheckDepositsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CheckDepositsRawService($client);
    }

    /**
     * @api
     *
     * Create a Check Deposit
     *
     * @param string $accountID the identifier for the Account to deposit the check in
     * @param int $amount the deposit amount in USD cents
     * @param string $backImageFileID the File containing the check's back image
     * @param string $frontImageFileID the File containing the check's front image
     * @param string $description the description you choose to give the Check Deposit, for display purposes only
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        int $amount,
        string $backImageFileID,
        string $frontImageFileID,
        ?string $description = null,
        RequestOptions|array|null $requestOptions = null,
    ): CheckDeposit {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'amount' => $amount,
                'backImageFileID' => $backImageFileID,
                'frontImageFileID' => $frontImageFileID,
                'description' => $description,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Check Deposit
     *
     * @param string $checkDepositID the identifier of the Check Deposit to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $checkDepositID,
        RequestOptions|array|null $requestOptions = null
    ): CheckDeposit {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($checkDepositID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Check Deposits
     *
     * @param string $accountID filter Check Deposits to those belonging to the specified Account
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<CheckDeposit>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
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
}
