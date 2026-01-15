<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CardPushTransfers\CardPushTransfer;
use Increase\CardPushTransfers\CardPushTransferCreateParams\BusinessApplicationIdentifier;
use Increase\CardPushTransfers\CardPushTransferCreateParams\PresentmentAmount;
use Increase\CardPushTransfers\CardPushTransferListParams\CreatedAt;
use Increase\CardPushTransfers\CardPushTransferListParams\Status;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CardPushTransfersContract;

/**
 * @phpstan-import-type PresentmentAmountShape from \Increase\CardPushTransfers\CardPushTransferCreateParams\PresentmentAmount
 * @phpstan-import-type CreatedAtShape from \Increase\CardPushTransfers\CardPushTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\CardPushTransfers\CardPushTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardPushTransfersService implements CardPushTransfersContract
{
    /**
     * @api
     */
    public CardPushTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardPushTransfersRawService($client);
    }

    /**
     * @api
     *
     * Create a Card Push Transfer
     *
     * @param BusinessApplicationIdentifier|value-of<BusinessApplicationIdentifier> $businessApplicationIdentifier The Business Application Identifier describes the type of transaction being performed. Your program must be approved for the specified Business Application Identifier in order to use it.
     * @param string $cardTokenID the Increase identifier for the Card Token that represents the card number you're pushing funds to
     * @param string $merchantCategoryCode The merchant category code (MCC) of the merchant (generally your business) sending the transfer. This is a four-digit code that describes the type of business or service provided by the merchant. Your program must be approved for the specified MCC in order to use it.
     * @param string $merchantCityName the city name of the merchant (generally your business) sending the transfer
     * @param string $merchantName The merchant name shows up as the statement descriptor for the transfer. This is typically the name of your business or organization.
     * @param string $merchantNamePrefix for certain Business Application Identifiers, the statement descriptor is `merchant_name_prefix*sender_name`, where the `merchant_name_prefix` is a one to four character prefix that identifies the merchant
     * @param string $merchantPostalCode the postal code of the merchant (generally your business) sending the transfer
     * @param string $merchantState the state of the merchant (generally your business) sending the transfer
     * @param PresentmentAmount|PresentmentAmountShape $presentmentAmount The amount to transfer. The receiving bank will convert this to the cardholder's currency. The amount that is applied to your Increase account matches the currency of your account.
     * @param string $recipientName the name of the funds recipient
     * @param string $senderAddressCity the city of the sender
     * @param string $senderAddressLine1 the address line 1 of the sender
     * @param string $senderAddressPostalCode the postal code of the sender
     * @param string $senderAddressState the state of the sender
     * @param string $senderName the name of the funds originator
     * @param string $sourceAccountNumberID the identifier of the Account Number from which to send the transfer
     * @param bool $requireApproval whether the transfer requires explicit approval via the dashboard or API
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        BusinessApplicationIdentifier|string $businessApplicationIdentifier,
        string $cardTokenID,
        string $merchantCategoryCode,
        string $merchantCityName,
        string $merchantName,
        string $merchantNamePrefix,
        string $merchantPostalCode,
        string $merchantState,
        PresentmentAmount|array $presentmentAmount,
        string $recipientName,
        string $senderAddressCity,
        string $senderAddressLine1,
        string $senderAddressPostalCode,
        string $senderAddressState,
        string $senderName,
        string $sourceAccountNumberID,
        ?bool $requireApproval = null,
        RequestOptions|array|null $requestOptions = null,
    ): CardPushTransfer {
        $params = Util::removeNulls(
            [
                'businessApplicationIdentifier' => $businessApplicationIdentifier,
                'cardTokenID' => $cardTokenID,
                'merchantCategoryCode' => $merchantCategoryCode,
                'merchantCityName' => $merchantCityName,
                'merchantName' => $merchantName,
                'merchantNamePrefix' => $merchantNamePrefix,
                'merchantPostalCode' => $merchantPostalCode,
                'merchantState' => $merchantState,
                'presentmentAmount' => $presentmentAmount,
                'recipientName' => $recipientName,
                'senderAddressCity' => $senderAddressCity,
                'senderAddressLine1' => $senderAddressLine1,
                'senderAddressPostalCode' => $senderAddressPostalCode,
                'senderAddressState' => $senderAddressState,
                'senderName' => $senderName,
                'sourceAccountNumberID' => $sourceAccountNumberID,
                'requireApproval' => $requireApproval,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Card Push Transfer
     *
     * @param string $cardPushTransferID the identifier of the Card Push Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardPushTransferID,
        RequestOptions|array|null $requestOptions = null
    ): CardPushTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($cardPushTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Card Push Transfers
     *
     * @param string $accountID filter Card Push Transfers to ones belonging to the specified Account
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<CardPushTransfer>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
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
     * Approves a Card Push Transfer in a pending_approval state.
     *
     * @param string $cardPushTransferID the identifier of the Card Push Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $cardPushTransferID,
        RequestOptions|array|null $requestOptions = null
    ): CardPushTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->approve($cardPushTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancels a Card Push Transfer in a pending_approval state.
     *
     * @param string $cardPushTransferID the identifier of the pending Card Push Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $cardPushTransferID,
        RequestOptions|array|null $requestOptions = null
    ): CardPushTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($cardPushTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
