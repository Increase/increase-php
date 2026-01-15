<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\CardTokens\CardToken;
use Increase\CardTokens\CardTokenCapabilities;
use Increase\CardTokens\CardTokenListParams\CreatedAt;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\CardTokens\CardTokenListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardTokensContract
{
    /**
     * @api
     *
     * @param string $cardTokenID the identifier of the Card Token
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardTokenID,
        RequestOptions|array|null $requestOptions = null
    ): CardToken;

    /**
     * @api
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
    ): Page;

    /**
     * @api
     *
     * @param string $cardTokenID the identifier of the Card Token
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function capabilities(
        string $cardTokenID,
        RequestOptions|array|null $requestOptions = null
    ): CardTokenCapabilities;
}
