<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CardTokens\CardToken;
use Increase\CardTokens\CardTokenCapabilities;
use Increase\CardTokens\CardTokenListParams;
use Increase\CardTokens\CardTokenListParams\CreatedAt;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CardTokensRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\CardTokens\CardTokenListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardTokensRawService implements CardTokensRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a Card Token
     *
     * @param string $cardTokenID the identifier of the Card Token
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardToken>
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardTokenID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['card_tokens/%1$s', $cardTokenID],
            options: $requestOptions,
            convert: CardToken::class,
        );
    }

    /**
     * @api
     *
     * List Card Tokens
     *
     * @param array{
     *   createdAt?: CreatedAt|CreatedAtShape, cursor?: string, limit?: int
     * }|CardTokenListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CardToken>>
     *
     * @throws APIException
     */
    public function list(
        array|CardTokenListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardTokenListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'card_tokens',
            query: Util::array_transform_keys($parsed, ['createdAt' => 'created_at']),
            options: $options,
            convert: CardToken::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * The capabilities of a Card Token describe whether the card can be used for specific operations, such as Card Push Transfers. The capabilities can change over time based on the issuing bank's configuration of the card range.
     *
     * @param string $cardTokenID the identifier of the Card Token
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardTokenCapabilities>
     *
     * @throws APIException
     */
    public function capabilities(
        string $cardTokenID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['card_tokens/%1$s/capabilities', $cardTokenID],
            options: $requestOptions,
            convert: CardTokenCapabilities::class,
        );
    }
}
