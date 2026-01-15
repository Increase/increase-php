<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CheckDeposits\CheckDeposit;
use Increase\CheckDeposits\CheckDepositCreateParams;
use Increase\CheckDeposits\CheckDepositListParams;
use Increase\CheckDeposits\CheckDepositListParams\CreatedAt;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CheckDepositsRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\CheckDeposits\CheckDepositListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CheckDepositsRawService implements CheckDepositsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Check Deposit
     *
     * @param array{
     *   accountID: string,
     *   amount: int,
     *   backImageFileID: string,
     *   frontImageFileID: string,
     *   description?: string,
     * }|CheckDepositCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckDeposit>
     *
     * @throws APIException
     */
    public function create(
        array|CheckDepositCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CheckDepositCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'check_deposits',
            body: (object) $parsed,
            options: $options,
            convert: CheckDeposit::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Check Deposit
     *
     * @param string $checkDepositID the identifier of the Check Deposit to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckDeposit>
     *
     * @throws APIException
     */
    public function retrieve(
        string $checkDepositID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['check_deposits/%1$s', $checkDepositID],
            options: $requestOptions,
            convert: CheckDeposit::class,
        );
    }

    /**
     * @api
     *
     * List Check Deposits
     *
     * @param array{
     *   accountID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     * }|CheckDepositListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CheckDeposit>>
     *
     * @throws APIException
     */
    public function list(
        array|CheckDepositListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CheckDepositListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'check_deposits',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'createdAt' => 'created_at',
                    'idempotencyKey' => 'idempotency_key',
                ],
            ),
            options: $options,
            convert: CheckDeposit::class,
            page: Page::class,
        );
    }
}
