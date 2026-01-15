<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundACHTransfers\InboundACHTransfer;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\InboundACHTransfersContract;
use Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\Addenda;
use Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\StandardEntryClassCode;

/**
 * @phpstan-import-type AddendaShape from \Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\Addenda
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundACHTransfersService implements InboundACHTransfersContract
{
    /**
     * @api
     */
    public InboundACHTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboundACHTransfersRawService($client);
    }

    /**
     * @api
     *
     * Simulates an inbound ACH transfer to your account. This imitates initiating a transfer to an Increase account from a different financial institution. The transfer may be either a credit or a debit depending on if the `amount` is positive or negative. The result of calling this API will contain the created transfer. You can pass a `resolve_at` parameter to allow for a window to [action on the Inbound ACH Transfer](https://increase.com/documentation/receiving-ach-transfers). Alternatively, if you don't pass the `resolve_at` parameter the result will contain either a [Transaction](#transactions) or a [Declined Transaction](#declined-transactions) depending on whether or not the transfer is allowed.
     *
     * @param string $accountNumberID the identifier of the Account Number the inbound ACH Transfer is for
     * @param int $amount The transfer amount in cents. A positive amount originates a credit transfer pushing funds to the receiving account. A negative amount originates a debit transfer pulling funds from the receiving account.
     * @param Addenda|AddendaShape $addenda additional information to include in the transfer
     * @param string $companyDescriptiveDate the description of the date of the transfer
     * @param string $companyDiscretionaryData data associated with the transfer set by the sender
     * @param string $companyEntryDescription the description of the transfer set by the sender
     * @param string $companyID the sender's company ID
     * @param string $companyName the name of the sender
     * @param string $receiverIDNumber the ID of the receiver of the transfer
     * @param string $receiverName the name of the receiver of the transfer
     * @param \DateTimeInterface $resolveAt The time at which the transfer should be resolved. If not provided will resolve immediately.
     * @param StandardEntryClassCode|value-of<StandardEntryClassCode> $standardEntryClassCode the standard entry class code for the transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountNumberID,
        int $amount,
        Addenda|array|null $addenda = null,
        ?string $companyDescriptiveDate = null,
        ?string $companyDiscretionaryData = null,
        ?string $companyEntryDescription = null,
        ?string $companyID = null,
        ?string $companyName = null,
        ?string $receiverIDNumber = null,
        ?string $receiverName = null,
        ?\DateTimeInterface $resolveAt = null,
        StandardEntryClassCode|string|null $standardEntryClassCode = null,
        RequestOptions|array|null $requestOptions = null,
    ): InboundACHTransfer {
        $params = Util::removeNulls(
            [
                'accountNumberID' => $accountNumberID,
                'amount' => $amount,
                'addenda' => $addenda,
                'companyDescriptiveDate' => $companyDescriptiveDate,
                'companyDiscretionaryData' => $companyDiscretionaryData,
                'companyEntryDescription' => $companyEntryDescription,
                'companyID' => $companyID,
                'companyName' => $companyName,
                'receiverIDNumber' => $receiverIDNumber,
                'receiverName' => $receiverName,
                'resolveAt' => $resolveAt,
                'standardEntryClassCode' => $standardEntryClassCode,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
