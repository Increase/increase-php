<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\CardDisputes\CardDispute;
use Increase\CardDisputes\CardDisputeCreateParams;
use Increase\CardDisputes\CardDisputeListParams;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams;
use Increase\CardDisputes\CardDisputeWithdrawParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardDisputesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CardDisputeCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardDispute>
     *
     * @throws APIException
     */
    public function create(
        array|CardDisputeCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $cardDisputeID the identifier of the Card Dispute
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardDispute>
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardDisputeID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CardDisputeListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CardDispute>>
     *
     * @throws APIException
     */
    public function list(
        array|CardDisputeListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $cardDisputeID the identifier of the Card Dispute to submit a user submission for
     * @param array<string,mixed>|CardDisputeSubmitUserSubmissionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardDispute>
     *
     * @throws APIException
     */
    public function submitUserSubmission(
        string $cardDisputeID,
        array|CardDisputeSubmitUserSubmissionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $cardDisputeID the identifier of the Card Dispute to withdraw
     * @param array<string,mixed>|CardDisputeWithdrawParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardDispute>
     *
     * @throws APIException
     */
    public function withdraw(
        string $cardDisputeID,
        array|CardDisputeWithdrawParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
