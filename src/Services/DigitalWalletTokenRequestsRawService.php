<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequestListParams;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequestListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\DigitalWalletTokenRequestsRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequestListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class DigitalWalletTokenRequestsRawService implements DigitalWalletTokenRequestsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a Digital Wallet Token Request
     *
     * @param string $digitalWalletTokenRequestID the identifier of the Digital Wallet Token Request
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DigitalWalletTokenRequest>
     *
     * @throws APIException
     */
    public function retrieve(
        string $digitalWalletTokenRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'digital_wallet_token_requests/%1$s', $digitalWalletTokenRequestID,
            ],
            options: $requestOptions,
            convert: DigitalWalletTokenRequest::class,
        );
    }

    /**
     * @api
     *
     * List Digital Wallet Token Requests
     *
     * @param array{
     *   cardID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     * }|DigitalWalletTokenRequestListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<DigitalWalletTokenRequest>>
     *
     * @throws APIException
     */
    public function list(
        array|DigitalWalletTokenRequestListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DigitalWalletTokenRequestListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'digital_wallet_token_requests',
            query: Util::array_transform_keys(
                $parsed,
                ['cardID' => 'card_id', 'createdAt' => 'created_at']
            ),
            options: $options,
            convert: DigitalWalletTokenRequest::class,
            page: Page::class,
        );
    }
}
