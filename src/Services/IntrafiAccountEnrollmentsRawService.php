<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollment;
use Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollmentCreateParams;
use Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollmentListParams;
use Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollmentListParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\IntrafiAccountEnrollmentsRawContract;

/**
 * @phpstan-import-type StatusShape from \Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollmentListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class IntrafiAccountEnrollmentsRawService implements IntrafiAccountEnrollmentsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Enroll an account in the IntraFi deposit sweep network
     *
     * @param array{
     *   accountID: string, emailAddress: string
     * }|IntrafiAccountEnrollmentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<IntrafiAccountEnrollment>
     *
     * @throws APIException
     */
    public function create(
        array|IntrafiAccountEnrollmentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = IntrafiAccountEnrollmentCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'intrafi_account_enrollments',
            body: (object) $parsed,
            options: $options,
            convert: IntrafiAccountEnrollment::class,
        );
    }

    /**
     * @api
     *
     * Get an IntraFi Account Enrollment
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['intrafi_account_enrollments/%1$s', $intrafiAccountEnrollmentID],
            options: $requestOptions,
            convert: IntrafiAccountEnrollment::class,
        );
    }

    /**
     * @api
     *
     * List IntraFi Account Enrollments
     *
     * @param array{
     *   accountID?: string,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|IntrafiAccountEnrollmentListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<IntrafiAccountEnrollment>>
     *
     * @throws APIException
     */
    public function list(
        array|IntrafiAccountEnrollmentListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = IntrafiAccountEnrollmentListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'intrafi_account_enrollments',
            query: Util::array_transform_keys(
                $parsed,
                ['accountID' => 'account_id', 'idempotencyKey' => 'idempotency_key'],
            ),
            options: $options,
            convert: IntrafiAccountEnrollment::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Unenroll an account from IntraFi
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'intrafi_account_enrollments/%1$s/unenroll', $intrafiAccountEnrollmentID,
            ],
            options: $requestOptions,
            convert: IntrafiAccountEnrollment::class,
        );
    }
}
