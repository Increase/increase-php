<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Cards\Card;
use Increase\Cards\CardCreateDetailsIframeParams;
use Increase\Cards\CardCreateParams;
use Increase\Cards\CardCreateParams\BillingAddress;
use Increase\Cards\CardCreateParams\DigitalWallet;
use Increase\Cards\CardDetails;
use Increase\Cards\CardIframeURL;
use Increase\Cards\CardListParams;
use Increase\Cards\CardListParams\CreatedAt;
use Increase\Cards\CardListParams\Status;
use Increase\Cards\CardUpdateParams;
use Increase\Cards\CardUpdatePinParams;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CardsRawContract;

/**
 * @phpstan-import-type BillingAddressShape from \Increase\Cards\CardCreateParams\BillingAddress
 * @phpstan-import-type DigitalWalletShape from \Increase\Cards\CardCreateParams\DigitalWallet
 * @phpstan-import-type BillingAddressShape from \Increase\Cards\CardUpdateParams\BillingAddress as BillingAddressShape1
 * @phpstan-import-type DigitalWalletShape from \Increase\Cards\CardUpdateParams\DigitalWallet as DigitalWalletShape1
 * @phpstan-import-type CreatedAtShape from \Increase\Cards\CardListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\Cards\CardListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardsRawService implements CardsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Card
     *
     * @param array{
     *   accountID: string,
     *   billingAddress?: BillingAddress|BillingAddressShape,
     *   description?: string,
     *   digitalWallet?: DigitalWallet|DigitalWalletShape,
     *   entityID?: string,
     * }|CardCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Card>
     *
     * @throws APIException
     */
    public function create(
        array|CardCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'cards',
            body: (object) $parsed,
            options: $options,
            convert: Card::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Card
     *
     * @param string $cardID the identifier of the Card
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Card>
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['cards/%1$s', $cardID],
            options: $requestOptions,
            convert: Card::class,
        );
    }

    /**
     * @api
     *
     * Update a Card
     *
     * @param string $cardID the card identifier
     * @param array{
     *   billingAddress?: CardUpdateParams\BillingAddress|BillingAddressShape1,
     *   description?: string,
     *   digitalWallet?: CardUpdateParams\DigitalWallet|DigitalWalletShape1,
     *   entityID?: string,
     *   status?: CardUpdateParams\Status|value-of<CardUpdateParams\Status>,
     * }|CardUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Card>
     *
     * @throws APIException
     */
    public function update(
        string $cardID,
        array|CardUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['cards/%1$s', $cardID],
            body: (object) $parsed,
            options: $options,
            convert: Card::class,
        );
    }

    /**
     * @api
     *
     * List Cards
     *
     * @param array{
     *   accountID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|CardListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Card>>
     *
     * @throws APIException
     */
    public function list(
        array|CardListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'cards',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'createdAt' => 'created_at',
                    'idempotencyKey' => 'idempotency_key',
                ],
            ),
            options: $options,
            convert: Card::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Create an iframe URL for a Card to display the card details. More details about styling and usage can be found in the [documentation](/documentation/embedded-card-component).
     *
     * @param string $cardID the identifier of the Card to create an iframe for
     * @param array{physicalCardID?: string}|CardCreateDetailsIframeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardIframeURL>
     *
     * @throws APIException
     */
    public function createDetailsIframe(
        string $cardID,
        array|CardCreateDetailsIframeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardCreateDetailsIframeParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['cards/%1$s/create_details_iframe', $cardID],
            body: (object) $parsed,
            options: $options,
            convert: CardIframeURL::class,
        );
    }

    /**
     * @api
     *
     * Sensitive details for a Card include the primary account number, expiry, card verification code, and PIN.
     *
     * @param string $cardID the identifier of the Card to retrieve details for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardDetails>
     *
     * @throws APIException
     */
    public function details(
        string $cardID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['cards/%1$s/details', $cardID],
            options: $requestOptions,
            convert: CardDetails::class,
        );
    }

    /**
     * @api
     *
     * Update a Card's PIN
     *
     * @param string $cardID the identifier of the Card to update the PIN for
     * @param array{pin: string}|CardUpdatePinParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardDetails>
     *
     * @throws APIException
     */
    public function updatePin(
        string $cardID,
        array|CardUpdatePinParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardUpdatePinParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['cards/%1$s/update_pin', $cardID],
            body: (object) $parsed,
            options: $options,
            convert: CardDetails::class,
        );
    }
}
