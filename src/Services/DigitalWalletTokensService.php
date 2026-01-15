<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\DigitalWalletTokens\DigitalWalletToken;
use Increase\DigitalWalletTokens\DigitalWalletTokenListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\DigitalWalletTokensContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\DigitalWalletTokens\DigitalWalletTokenListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class DigitalWalletTokensService implements DigitalWalletTokensContract
{
    /**
     * @api
     */
    public DigitalWalletTokensRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DigitalWalletTokensRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a Digital Wallet Token
     *
     * @param string $digitalWalletTokenID the identifier of the Digital Wallet Token
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $digitalWalletTokenID,
        RequestOptions|array|null $requestOptions = null,
    ): DigitalWalletToken {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($digitalWalletTokenID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Digital Wallet Tokens
     *
     * @param string $cardID filter Digital Wallet Tokens to ones belonging to the specified Card
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<DigitalWalletToken>
     *
     * @throws APIException
     */
    public function list(
        ?string $cardID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
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
