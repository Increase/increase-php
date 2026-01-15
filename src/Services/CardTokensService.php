<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CardTokens\CardToken;
use Increase\CardTokens\CardTokenCapabilities;
use Increase\CardTokens\CardTokenListParams\CreatedAt;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CardTokensContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\CardTokens\CardTokenListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardTokensService implements CardTokensContract
{
    /**
     * @api
     */
    public CardTokensRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardTokensRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a Card Token
     *
     * @param string $cardTokenID the identifier of the Card Token
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardTokenID,
        RequestOptions|array|null $requestOptions = null
    ): CardToken {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($cardTokenID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Card Tokens
     *
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<CardToken>
     *
     * @throws APIException
     */
    public function list(
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            ['createdAt' => $createdAt, 'cursor' => $cursor, 'limit' => $limit]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * The capabilities of a Card Token describe whether the card can be used for specific operations, such as Card Push Transfers. The capabilities can change over time based on the issuing bank's configuration of the card range.
     *
     * @param string $cardTokenID the identifier of the Card Token
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function capabilities(
        string $cardTokenID,
        RequestOptions|array|null $requestOptions = null
    ): CardTokenCapabilities {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->capabilities($cardTokenID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
