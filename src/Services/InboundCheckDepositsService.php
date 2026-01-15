<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundCheckDeposits\InboundCheckDeposit;
use Increase\InboundCheckDeposits\InboundCheckDepositListParams\CreatedAt;
use Increase\InboundCheckDeposits\InboundCheckDepositReturnParams\Reason;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundCheckDepositsContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundCheckDeposits\InboundCheckDepositListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundCheckDepositsService implements InboundCheckDepositsContract
{
    /**
     * @api
     */
    public InboundCheckDepositsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboundCheckDepositsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve an Inbound Check Deposit
     *
     * @param string $inboundCheckDepositID the identifier of the Inbound Check Deposit to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundCheckDepositID,
        RequestOptions|array|null $requestOptions = null,
    ): InboundCheckDeposit {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($inboundCheckDepositID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Inbound Check Deposits
     *
     * @param string $accountID filter Inbound Check Deposits to those belonging to the specified Account
     * @param string $checkTransferID filter Inbound Check Deposits to those belonging to the specified Check Transfer
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<InboundCheckDeposit>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        ?string $checkTransferID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'checkTransferID' => $checkTransferID,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
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
     * Decline an Inbound Check Deposit
     *
     * @param string $inboundCheckDepositID the identifier of the Inbound Check Deposit to decline
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function decline(
        string $inboundCheckDepositID,
        RequestOptions|array|null $requestOptions = null,
    ): InboundCheckDeposit {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->decline($inboundCheckDepositID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Return an Inbound Check Deposit
     *
     * @param string $inboundCheckDepositID the identifier of the Inbound Check Deposit to return
     * @param Reason|value-of<Reason> $reason the reason to return the Inbound Check Deposit
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function return(
        string $inboundCheckDepositID,
        Reason|string $reason,
        RequestOptions|array|null $requestOptions = null,
    ): InboundCheckDeposit {
        $params = Util::removeNulls(['reason' => $reason]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->return($inboundCheckDepositID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
