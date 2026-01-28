<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CardDisputes\CardDispute;
use Increase\CardDisputes\CardDisputeCreateParams\AttachmentFile;
use Increase\CardDisputes\CardDisputeCreateParams\Network;
use Increase\CardDisputes\CardDisputeCreateParams\Visa;
use Increase\CardDisputes\CardDisputeListParams\CreatedAt;
use Increase\CardDisputes\CardDisputeListParams\Status;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CardDisputesContract;

/**
 * @phpstan-import-type AttachmentFileShape from \Increase\CardDisputes\CardDisputeCreateParams\AttachmentFile
 * @phpstan-import-type VisaShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa
 * @phpstan-import-type CreatedAtShape from \Increase\CardDisputes\CardDisputeListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\CardDisputes\CardDisputeListParams\Status
 * @phpstan-import-type AttachmentFileShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\AttachmentFile as AttachmentFileShape1
 * @phpstan-import-type VisaShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa as VisaShape1
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardDisputesService implements CardDisputesContract
{
    /**
     * @api
     */
    public CardDisputesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardDisputesRawService($client);
    }

    /**
     * @api
     *
     * Create a Card Dispute
     *
     * @param string $disputedTransactionID The Transaction you wish to dispute. This Transaction must have a `source_type` of `card_settlement`.
     * @param Network|value-of<Network> $network The network of the disputed transaction. Details specific to the network are required under the sub-object with the same identifier as the network.
     * @param int $amount The monetary amount of the part of the transaction that is being disputed. This is optional and will default to the full amount of the transaction if not provided. If provided, the amount must be less than or equal to the amount of the transaction.
     * @param list<AttachmentFile|AttachmentFileShape> $attachmentFiles the files to be attached to the initial dispute submission
     * @param string $explanation The free-form explanation provided to Increase to provide more context for the user submission. This field is not sent directly to the card networks.
     * @param Visa|VisaShape $visa The Visa-specific parameters for the dispute. Required if and only if `network` is `visa`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $disputedTransactionID,
        Network|string $network,
        ?int $amount = null,
        ?array $attachmentFiles = null,
        ?string $explanation = null,
        Visa|array|null $visa = null,
        RequestOptions|array|null $requestOptions = null,
    ): CardDispute {
        $params = Util::removeNulls(
            [
                'disputedTransactionID' => $disputedTransactionID,
                'network' => $network,
                'amount' => $amount,
                'attachmentFiles' => $attachmentFiles,
                'explanation' => $explanation,
                'visa' => $visa,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Card Dispute
     *
     * @param string $cardDisputeID the identifier of the Card Dispute
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardDisputeID,
        RequestOptions|array|null $requestOptions = null
    ): CardDispute {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($cardDisputeID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Card Disputes
     *
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<CardDispute>
     *
     * @throws APIException
     */
    public function list(
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'idempotencyKey' => $idempotencyKey,
                'limit' => $limit,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Submit a User Submission for a Card Dispute
     *
     * @param string $cardDisputeID the identifier of the Card Dispute to submit a user submission for
     * @param \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Network|value-of<\Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Network> $network The network of the Card Dispute. Details specific to the network are required under the sub-object with the same identifier as the network.
     * @param int $amount The adjusted monetary amount of the part of the transaction that is being disputed. This is optional and will default to the most recent amount provided. If provided, the amount must be less than or equal to the amount of the transaction.
     * @param list<\Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\AttachmentFile|AttachmentFileShape1> $attachmentFiles the files to be attached to the user submission
     * @param string $explanation The free-form explanation provided to Increase to provide more context for the user submission. This field is not sent directly to the card networks.
     * @param \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa|VisaShape1 $visa The Visa-specific parameters for the dispute. Required if and only if `network` is `visa`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submitUserSubmission(
        string $cardDisputeID,
        \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Network|string $network,
        ?int $amount = null,
        ?array $attachmentFiles = null,
        ?string $explanation = null,
        \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa|array|null $visa = null,
        RequestOptions|array|null $requestOptions = null,
    ): CardDispute {
        $params = Util::removeNulls(
            [
                'network' => $network,
                'amount' => $amount,
                'attachmentFiles' => $attachmentFiles,
                'explanation' => $explanation,
                'visa' => $visa,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->submitUserSubmission($cardDisputeID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Withdraw a Card Dispute
     *
     * @param string $cardDisputeID the identifier of the Card Dispute to withdraw
     * @param string $explanation the explanation for withdrawing the Card Dispute
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function withdraw(
        string $cardDisputeID,
        ?string $explanation = null,
        RequestOptions|array|null $requestOptions = null,
    ): CardDispute {
        $params = Util::removeNulls(['explanation' => $explanation]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->withdraw($cardDisputeID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
