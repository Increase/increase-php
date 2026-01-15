<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\IntrafiExclusions\IntrafiExclusion;
use Increase\IntrafiExclusions\IntrafiExclusionCreateParams;
use Increase\IntrafiExclusions\IntrafiExclusionListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface IntrafiExclusionsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|IntrafiExclusionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<IntrafiExclusion>
     *
     * @throws APIException
     */
    public function create(
        array|IntrafiExclusionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|IntrafiExclusionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<IntrafiExclusion>>
     *
     * @throws APIException
     */
    public function list(
        array|IntrafiExclusionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
