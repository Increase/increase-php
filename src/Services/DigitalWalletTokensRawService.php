<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\DigitalWalletTokens\DigitalWalletToken;
use Increase\DigitalWalletTokens\DigitalWalletTokenListParams;
use Increase\DigitalWalletTokens\DigitalWalletTokenListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\DigitalWalletTokensRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\DigitalWalletTokens\DigitalWalletTokenListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class DigitalWalletTokensRawService implements DigitalWalletTokensRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a Digital Wallet Token
     *
     * @param string $digitalWalletTokenID the identifier of the Digital Wallet Token
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DigitalWalletToken>
     *
     * @throws APIException
     */
    public function retrieve(
        string $digitalWalletTokenID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['digital_wallet_tokens/%1$s', $digitalWalletTokenID],
            options: $requestOptions,
            convert: DigitalWalletToken::class,
        );
    }

    /**
     * @api
     *
     * List Digital Wallet Tokens
     *
     * @param array{
     *   cardID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     * }|DigitalWalletTokenListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<DigitalWalletToken>>
     *
     * @throws APIException
     */
    public function list(
        array|DigitalWalletTokenListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DigitalWalletTokenListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'digital_wallet_tokens',
            query: Util::array_transform_keys(
                $parsed,
                ['cardID' => 'card_id', 'createdAt' => 'created_at']
            ),
            options: $options,
            convert: DigitalWalletToken::class,
            page: Page::class,
        );
    }
}
