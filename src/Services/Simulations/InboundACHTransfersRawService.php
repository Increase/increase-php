<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundACHTransfers\InboundACHTransfer;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\InboundACHTransfersRawContract;
use Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams;
use Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\Addenda;
use Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\StandardEntryClassCode;

/**
 * @phpstan-import-type AddendaShape from \Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\Addenda
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundACHTransfersRawService implements InboundACHTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates an inbound ACH transfer to your account. This imitates initiating a transfer to an Increase account from a different financial institution. The transfer may be either a credit or a debit depending on if the `amount` is positive or negative. The result of calling this API will contain the created transfer. You can pass a `resolve_at` parameter to allow for a window to [action on the Inbound ACH Transfer](https://increase.com/documentation/receiving-ach-transfers). Alternatively, if you don't pass the `resolve_at` parameter the result will contain either a [Transaction](#transactions) or a [Declined Transaction](#declined-transactions) depending on whether or not the transfer is allowed.
     *
     * @param array{
     *   accountNumberID: string,
     *   amount: int,
     *   addenda?: Addenda|AddendaShape,
     *   companyDescriptiveDate?: string,
     *   companyDiscretionaryData?: string,
     *   companyEntryDescription?: string,
     *   companyID?: string,
     *   companyName?: string,
     *   receiverIDNumber?: string,
     *   receiverName?: string,
     *   resolveAt?: \DateTimeInterface,
     *   standardEntryClassCode?: value-of<StandardEntryClassCode>,
     * }|InboundACHTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundACHTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|InboundACHTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundACHTransferCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/inbound_ach_transfers',
            body: (object) $parsed,
            options: $options,
            convert: InboundACHTransfer::class,
        );
    }
}
