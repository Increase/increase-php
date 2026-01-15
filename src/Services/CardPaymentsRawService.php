<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CardPayments\CardPayment;
use Increase\CardPayments\CardPaymentListParams;
use Increase\CardPayments\CardPaymentListParams\CreatedAt;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CardPaymentsRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\CardPayments\CardPaymentListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardPaymentsRawService implements CardPaymentsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a Card Payment
     *
     * @param string $cardPaymentID the identifier of the Card Payment
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPayment>
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardPaymentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['card_payments/%1$s', $cardPaymentID],
            options: $requestOptions,
            convert: CardPayment::class,
        );
    }

    /**
     * @api
     *
     * List Card Payments
     *
     * @param array{
     *   accountID?: string,
     *   cardID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     * }|CardPaymentListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CardPayment>>
     *
     * @throws APIException
     */
    public function list(
        array|CardPaymentListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardPaymentListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'card_payments',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'cardID' => 'card_id',
                    'createdAt' => 'created_at',
                ],
            ),
            options: $options,
            convert: CardPayment::class,
            page: Page::class,
        );
    }
}
