<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequestListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\DigitalWalletTokenRequestsContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequestListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class DigitalWalletTokenRequestsService implements DigitalWalletTokenRequestsContract
{
    /**
     * @api
     */
    public DigitalWalletTokenRequestsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DigitalWalletTokenRequestsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a Digital Wallet Token Request
     *
     * @param string $digitalWalletTokenRequestID the identifier of the Digital Wallet Token Request
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $digitalWalletTokenRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): DigitalWalletTokenRequest {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($digitalWalletTokenRequestID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Digital Wallet Token Requests
     *
     * @param string $cardID filter Digital Wallet Token Requests to ones for the specified Card
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     *
     * Defaults to `100`.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<DigitalWalletTokenRequest>
     *
     * @throws APIException
     */
    public function list(
        ?string $cardID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        int $limit = 100,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'cardID' => $cardID,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
