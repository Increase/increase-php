<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\ACHPrenotifications\ACHPrenotification;
use Increase\ACHPrenotifications\ACHPrenotificationCreateParams;
use Increase\ACHPrenotifications\ACHPrenotificationCreateParams\CreditDebitIndicator;
use Increase\ACHPrenotifications\ACHPrenotificationCreateParams\StandardEntryClassCode;
use Increase\ACHPrenotifications\ACHPrenotificationListParams;
use Increase\ACHPrenotifications\ACHPrenotificationListParams\CreatedAt;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\ACHPrenotificationsRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\ACHPrenotifications\ACHPrenotificationListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class ACHPrenotificationsRawService implements ACHPrenotificationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create an ACH Prenotification
     *
     * @param array{
     *   accountID: string,
     *   accountNumber: string,
     *   routingNumber: string,
     *   addendum?: string,
     *   companyDescriptiveDate?: string,
     *   companyDiscretionaryData?: string,
     *   companyEntryDescription?: string,
     *   companyName?: string,
     *   creditDebitIndicator?: CreditDebitIndicator|value-of<CreditDebitIndicator>,
     *   effectiveDate?: string,
     *   individualID?: string,
     *   individualName?: string,
     *   standardEntryClassCode?: value-of<StandardEntryClassCode>,
     * }|ACHPrenotificationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHPrenotification>
     *
     * @throws APIException
     */
    public function create(
        array|ACHPrenotificationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ACHPrenotificationCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'ach_prenotifications',
            body: (object) $parsed,
            options: $options,
            convert: ACHPrenotification::class,
        );
    }

    /**
     * @api
     *
     * Retrieve an ACH Prenotification
     *
     * @param string $achPrenotificationID the identifier of the ACH Prenotification to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHPrenotification>
     *
     * @throws APIException
     */
    public function retrieve(
        string $achPrenotificationID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ach_prenotifications/%1$s', $achPrenotificationID],
            options: $requestOptions,
            convert: ACHPrenotification::class,
        );
    }

    /**
     * @api
     *
     * List ACH Prenotifications
     *
     * @param array{
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     * }|ACHPrenotificationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<ACHPrenotification>>
     *
     * @throws APIException
     */
    public function list(
        array|ACHPrenotificationListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ACHPrenotificationListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'ach_prenotifications',
            query: Util::array_transform_keys(
                $parsed,
                ['createdAt' => 'created_at', 'idempotencyKey' => 'idempotency_key'],
            ),
            options: $options,
            convert: ACHPrenotification::class,
            page: Page::class,
        );
    }
}
