<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollment;
use Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollmentCreateParams;
use Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollmentListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface IntrafiAccountEnrollmentsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|IntrafiAccountEnrollmentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<IntrafiAccountEnrollment>
     *
     * @throws APIException
     */
    public function create(
        array|IntrafiAccountEnrollmentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $intrafiAccountEnrollmentID the identifier of the IntraFi Account Enrollment to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<IntrafiAccountEnrollment>
     *
     * @throws APIException
     */
    public function retrieve(
        string $intrafiAccountEnrollmentID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|IntrafiAccountEnrollmentListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<IntrafiAccountEnrollment>>
     *
     * @throws APIException
     */
    public function list(
        array|IntrafiAccountEnrollmentListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $intrafiAccountEnrollmentID the Identifier of the IntraFi Account Enrollment to remove from IntraFi
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<IntrafiAccountEnrollment>
     *
     * @throws APIException
     */
    public function unenroll(
        string $intrafiAccountEnrollmentID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
