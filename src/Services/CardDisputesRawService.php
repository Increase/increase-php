<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CardDisputes\CardDispute;
use Increase\CardDisputes\CardDisputeCreateParams;
use Increase\CardDisputes\CardDisputeCreateParams\AttachmentFile;
use Increase\CardDisputes\CardDisputeCreateParams\Network;
use Increase\CardDisputes\CardDisputeCreateParams\Visa;
use Increase\CardDisputes\CardDisputeListParams;
use Increase\CardDisputes\CardDisputeListParams\CreatedAt;
use Increase\CardDisputes\CardDisputeListParams\Status;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams;
use Increase\CardDisputes\CardDisputeWithdrawParams;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CardDisputesRawContract;

/**
 * @phpstan-import-type AttachmentFileShape from \Increase\CardDisputes\CardDisputeCreateParams\AttachmentFile
 * @phpstan-import-type VisaShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa
 * @phpstan-import-type CreatedAtShape from \Increase\CardDisputes\CardDisputeListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\CardDisputes\CardDisputeListParams\Status
 * @phpstan-import-type AttachmentFileShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\AttachmentFile as AttachmentFileShape1
 * @phpstan-import-type VisaShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa as VisaShape1
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardDisputesRawService implements CardDisputesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Card Dispute
     *
     * @param array{
     *   disputedTransactionID: string,
     *   network: Network|value-of<Network>,
     *   amount?: int,
     *   attachmentFiles?: list<AttachmentFile|AttachmentFileShape>,
     *   explanation?: string,
     *   visa?: Visa|VisaShape,
     * }|CardDisputeCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardDispute>
     *
     * @throws APIException
     */
    public function create(
        array|CardDisputeCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardDisputeCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'card_disputes',
            body: (object) $parsed,
            options: $options,
            convert: CardDispute::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Card Dispute
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['card_disputes/%1$s', $cardDisputeID],
            options: $requestOptions,
            convert: CardDispute::class,
        );
    }

    /**
     * @api
     *
     * List Card Disputes
     *
     * @param array{
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|CardDisputeListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CardDispute>>
     *
     * @throws APIException
     */
    public function list(
        array|CardDisputeListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardDisputeListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'card_disputes',
            query: Util::array_transform_keys(
                $parsed,
                ['createdAt' => 'created_at', 'idempotencyKey' => 'idempotency_key'],
            ),
            options: $options,
            convert: CardDispute::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Submit a User Submission for a Card Dispute
     *
     * @param string $cardDisputeID the identifier of the Card Dispute to submit a user submission for
     * @param array{
     *   network: CardDisputeSubmitUserSubmissionParams\Network|value-of<CardDisputeSubmitUserSubmissionParams\Network>,
     *   amount?: int,
     *   attachmentFiles?: list<CardDisputeSubmitUserSubmissionParams\AttachmentFile|AttachmentFileShape1>,
     *   explanation?: string,
     *   visa?: CardDisputeSubmitUserSubmissionParams\Visa|VisaShape1,
     * }|CardDisputeSubmitUserSubmissionParams $params
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
    ): BaseResponse {
        [$parsed, $options] = CardDisputeSubmitUserSubmissionParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['card_disputes/%1$s/submit_user_submission', $cardDisputeID],
            body: (object) $parsed,
            options: $options,
            convert: CardDispute::class,
        );
    }

    /**
     * @api
     *
     * Withdraw a Card Dispute
     *
     * @param string $cardDisputeID the identifier of the Card Dispute to withdraw
     * @param array{explanation?: string}|CardDisputeWithdrawParams $params
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
    ): BaseResponse {
        [$parsed, $options] = CardDisputeWithdrawParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['card_disputes/%1$s/withdraw', $cardDisputeID],
            body: (object) $parsed,
            options: $options,
            convert: CardDispute::class,
        );
    }
}
