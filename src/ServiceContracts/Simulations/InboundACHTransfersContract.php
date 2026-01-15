<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\InboundACHTransfers\InboundACHTransfer;
use Increase\RequestOptions;
use Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\Addenda;
use Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\StandardEntryClassCode;

/**
 * @phpstan-import-type AddendaShape from \Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams\Addenda
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundACHTransfersContract
{
    /**
     * @api
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
    ): InboundACHTransfer;
}
