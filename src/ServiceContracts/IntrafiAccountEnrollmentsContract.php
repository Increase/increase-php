<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollment;
use Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollmentListParams\Status;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type StatusShape from \Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollmentListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface IntrafiAccountEnrollmentsContract
{
    /**
     * @api
     *
     * @param string $accountID the identifier for the account to be added to IntraFi
     * @param string $emailAddress the contact email for the account owner, to be shared with IntraFi
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        string $emailAddress,
        RequestOptions|array|null $requestOptions = null,
    ): IntrafiAccountEnrollment;

    /**
     * @api
     *
     * @param string $intrafiAccountEnrollmentID the identifier of the IntraFi Account Enrollment to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $intrafiAccountEnrollmentID,
        RequestOptions|array|null $requestOptions = null,
    ): IntrafiAccountEnrollment;

    /**
     * @api
     *
     * @param string $accountID filter IntraFi Account Enrollments to the one belonging to an account
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<IntrafiAccountEnrollment>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;

    /**
     * @api
     *
     * @param string $intrafiAccountEnrollmentID the Identifier of the IntraFi Account Enrollment to remove from IntraFi
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function unenroll(
        string $intrafiAccountEnrollmentID,
        RequestOptions|array|null $requestOptions = null,
    ): IntrafiAccountEnrollment;
}
