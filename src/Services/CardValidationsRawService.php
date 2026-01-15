<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CardValidations\CardValidation;
use Increase\CardValidations\CardValidationCreateParams;
use Increase\CardValidations\CardValidationListParams;
use Increase\CardValidations\CardValidationListParams\CreatedAt;
use Increase\CardValidations\CardValidationListParams\Status;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CardValidationsRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\CardValidations\CardValidationListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\CardValidations\CardValidationListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardValidationsRawService implements CardValidationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Card Validation
     *
     * @param array{
     *   accountID: string,
     *   cardTokenID: string,
     *   merchantCategoryCode: string,
     *   merchantCityName: string,
     *   merchantName: string,
     *   merchantPostalCode: string,
     *   merchantState: string,
     *   cardholderFirstName?: string,
     *   cardholderLastName?: string,
     *   cardholderMiddleName?: string,
     *   cardholderPostalCode?: string,
     *   cardholderStreetAddress?: string,
     * }|CardValidationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardValidation>
     *
     * @throws APIException
     */
    public function create(
        array|CardValidationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardValidationCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'card_validations',
            body: (object) $parsed,
            options: $options,
            convert: CardValidation::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Card Validation
     *
     * @param string $cardValidationID the identifier of the Card Validation
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardValidation>
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardValidationID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['card_validations/%1$s', $cardValidationID],
            options: $requestOptions,
            convert: CardValidation::class,
        );
    }

    /**
     * @api
     *
     * List Card Validations
     *
     * @param array{
     *   accountID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|CardValidationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CardValidation>>
     *
     * @throws APIException
     */
    public function list(
        array|CardValidationListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardValidationListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'card_validations',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'createdAt' => 'created_at',
                    'idempotencyKey' => 'idempotency_key',
                ],
            ),
            options: $options,
            convert: CardValidation::class,
            page: Page::class,
        );
    }
}
