<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\ACHTransfers\ACHTransfer;
use Increase\ACHTransfers\ACHTransferCreateParams;
use Increase\ACHTransfers\ACHTransferCreateParams\Addenda;
use Increase\ACHTransfers\ACHTransferCreateParams\DestinationAccountHolder;
use Increase\ACHTransfers\ACHTransferCreateParams\Funding;
use Increase\ACHTransfers\ACHTransferCreateParams\PreferredEffectiveDate;
use Increase\ACHTransfers\ACHTransferCreateParams\StandardEntryClassCode;
use Increase\ACHTransfers\ACHTransferCreateParams\TransactionTiming;
use Increase\ACHTransfers\ACHTransferListParams;
use Increase\ACHTransfers\ACHTransferListParams\CreatedAt;
use Increase\ACHTransfers\ACHTransferListParams\Status;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\ACHTransfersRawContract;

/**
 * @phpstan-import-type AddendaShape from \Increase\ACHTransfers\ACHTransferCreateParams\Addenda
 * @phpstan-import-type PreferredEffectiveDateShape from \Increase\ACHTransfers\ACHTransferCreateParams\PreferredEffectiveDate
 * @phpstan-import-type CreatedAtShape from \Increase\ACHTransfers\ACHTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\ACHTransfers\ACHTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class ACHTransfersRawService implements ACHTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create an ACH Transfer
     *
     * @param array{
     *   accountID: string,
     *   amount: int,
     *   statementDescriptor: string,
     *   accountNumber?: string,
     *   addenda?: Addenda|AddendaShape,
     *   companyDescriptiveDate?: string,
     *   companyDiscretionaryData?: string,
     *   companyEntryDescription?: string,
     *   companyName?: string,
     *   destinationAccountHolder?: DestinationAccountHolder|value-of<DestinationAccountHolder>,
     *   externalAccountID?: string,
     *   funding?: Funding|value-of<Funding>,
     *   individualID?: string,
     *   individualName?: string,
     *   preferredEffectiveDate?: PreferredEffectiveDate|PreferredEffectiveDateShape,
     *   requireApproval?: bool,
     *   routingNumber?: string,
     *   standardEntryClassCode?: value-of<StandardEntryClassCode>,
     *   transactionTiming?: TransactionTiming|value-of<TransactionTiming>,
     * }|ACHTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|ACHTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ACHTransferCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'ach_transfers',
            body: (object) $parsed,
            options: $options,
            convert: ACHTransfer::class,
        );
    }

    /**
     * @api
     *
     * Retrieve an ACH Transfer
     *
     * @param string $achTransferID the identifier of the ACH Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ach_transfers/%1$s', $achTransferID],
            options: $requestOptions,
            convert: ACHTransfer::class,
        );
    }

    /**
     * @api
     *
     * List ACH Transfers
     *
     * @param array{
     *   accountID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   externalAccountID?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|ACHTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<ACHTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|ACHTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ACHTransferListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'ach_transfers',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'createdAt' => 'created_at',
                    'externalAccountID' => 'external_account_id',
                    'idempotencyKey' => 'idempotency_key',
                ],
            ),
            options: $options,
            convert: ACHTransfer::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Approves an ACH Transfer in a pending_approval state.
     *
     * @param string $achTransferID the identifier of the ACH Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['ach_transfers/%1$s/approve', $achTransferID],
            options: $requestOptions,
            convert: ACHTransfer::class,
        );
    }

    /**
     * @api
     *
     * Cancels an ACH Transfer in a pending_approval state.
     *
     * @param string $achTransferID the identifier of the pending ACH Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['ach_transfers/%1$s/cancel', $achTransferID],
            options: $requestOptions,
            convert: ACHTransfer::class,
        );
    }
}
