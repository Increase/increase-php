<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\DigitalWalletTokens\DigitalWalletToken;
use Increase\DigitalWalletTokens\DigitalWalletTokenListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\DigitalWalletTokens\DigitalWalletTokenListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface DigitalWalletTokensContract
{
    /**
     * @api
     *
     * @param string $digitalWalletTokenID the identifier of the Digital Wallet Token
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $digitalWalletTokenID,
        RequestOptions|array|null $requestOptions = null,
    ): DigitalWalletToken;

    /**
     * @api
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
    ): Page;
}
