<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\IntrafiExclusions\IntrafiExclusion;
use Increase\IntrafiExclusions\IntrafiExclusionCreateParams;
use Increase\IntrafiExclusions\IntrafiExclusionListParams;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\IntrafiExclusionsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class IntrafiExclusionsRawService implements IntrafiExclusionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create an IntraFi Exclusion
     *
     * @param array{
     *   entityID: string, fdicCertificateNumber: string
     * }|IntrafiExclusionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<IntrafiExclusion>
     *
     * @throws APIException
     */
    public function create(
        array|IntrafiExclusionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = IntrafiExclusionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'intrafi_exclusions',
            body: (object) $parsed,
            options: $options,
            convert: IntrafiExclusion::class,
        );
    }

    /**
     * @api
     *
     * Get an IntraFi Exclusion
     *
     * @param string $intrafiExclusionID the identifier of the IntraFi Exclusion to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<IntrafiExclusion>
     *
     * @throws APIException
     */
    public function retrieve(
        string $intrafiExclusionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['intrafi_exclusions/%1$s', $intrafiExclusionID],
            options: $requestOptions,
            convert: IntrafiExclusion::class,
        );
    }

    /**
     * @api
     *
     * List IntraFi Exclusions
     *
     * @param array{
     *   cursor?: string, entityID?: string, idempotencyKey?: string, limit?: int
     * }|IntrafiExclusionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<IntrafiExclusion>>
     *
     * @throws APIException
     */
    public function list(
        array|IntrafiExclusionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = IntrafiExclusionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'intrafi_exclusions',
            query: Util::array_transform_keys(
                $parsed,
                ['entityID' => 'entity_id', 'idempotencyKey' => 'idempotency_key'],
            ),
            options: $options,
            convert: IntrafiExclusion::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Archive an IntraFi Exclusion
     *
     * @param string $intrafiExclusionID The identifier of the IntraFi Exclusion request to archive. It may take 5 business days for an exclusion removal to be processed. Removing an exclusion does not guarantee that funds will be swept to the previously-excluded bank.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<IntrafiExclusion>
     *
     * @throws APIException
     */
    public function archive(
        string $intrafiExclusionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['intrafi_exclusions/%1$s/archive', $intrafiExclusionID],
            options: $requestOptions,
            convert: IntrafiExclusion::class,
        );
    }
}
