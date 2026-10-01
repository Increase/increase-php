<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequestListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequestListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface DigitalWalletTokenRequestsContract
{
    /**
     * @api
     *
     * @param string $digitalWalletTokenRequestID the identifier of the Digital Wallet Token Request
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $digitalWalletTokenRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): DigitalWalletTokenRequest;

    /**
     * @api
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
    ): Page;
}
