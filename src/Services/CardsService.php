<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Cards\Card;
use Increase\Cards\CardCreateParams\BillingAddress;
use Increase\Cards\CardCreateParams\DigitalWallet;
use Increase\Cards\CardDetails;
use Increase\Cards\CardIframeURL;
use Increase\Cards\CardListParams\CreatedAt;
use Increase\Cards\CardUpdateParams\Status;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CardsContract;

/**
 * @phpstan-import-type BillingAddressShape from \Increase\Cards\CardCreateParams\BillingAddress
 * @phpstan-import-type DigitalWalletShape from \Increase\Cards\CardCreateParams\DigitalWallet
 * @phpstan-import-type BillingAddressShape from \Increase\Cards\CardUpdateParams\BillingAddress as BillingAddressShape1
 * @phpstan-import-type DigitalWalletShape from \Increase\Cards\CardUpdateParams\DigitalWallet as DigitalWalletShape1
 * @phpstan-import-type CreatedAtShape from \Increase\Cards\CardListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\Cards\CardListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardsService implements CardsContract
{
    /**
     * @api
     */
    public CardsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardsRawService($client);
    }

    /**
     * @api
     *
     * Create a Card
     *
     * @param string $accountID the Account the card should belong to
     * @param BillingAddress|BillingAddressShape $billingAddress the card's billing address
     * @param string $description the description you choose to give the card
     * @param DigitalWallet|DigitalWalletShape $digitalWallet The contact information used in the two-factor steps for digital wallet card creation. To add the card to a digital wallet, you may supply an email or phone number with this request. Otherwise, subscribe and then action a Real Time Decision with the category `digital_wallet_token_requested` or `digital_wallet_authentication_requested`.
     * @param string $entityID The Entity the card belongs to. You only need to supply this in rare situations when the card is not for the Account holder.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        BillingAddress|array|null $billingAddress = null,
        ?string $description = null,
        DigitalWallet|array|null $digitalWallet = null,
        ?string $entityID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Card {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'billingAddress' => $billingAddress,
                'description' => $description,
                'digitalWallet' => $digitalWallet,
                'entityID' => $entityID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Card
     *
     * @param string $cardID the identifier of the Card
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardID,
        RequestOptions|array|null $requestOptions = null
    ): Card {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($cardID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a Card
     *
     * @param string $cardID the card identifier
     * @param \Increase\Cards\CardUpdateParams\BillingAddress|BillingAddressShape1 $billingAddress the card's updated billing address
     * @param string $description the description you choose to give the card
     * @param \Increase\Cards\CardUpdateParams\DigitalWallet|DigitalWalletShape1 $digitalWallet The contact information used in the two-factor steps for digital wallet card creation. At least one field must be present to complete the digital wallet steps.
     * @param string $entityID The Entity the card belongs to. You only need to supply this in rare situations when the card is not for the Account holder.
     * @param Status|value-of<Status> $status the status to update the Card with
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $cardID,
        \Increase\Cards\CardUpdateParams\BillingAddress|array|null $billingAddress = null,
        ?string $description = null,
        \Increase\Cards\CardUpdateParams\DigitalWallet|array|null $digitalWallet = null,
        ?string $entityID = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Card {
        $params = Util::removeNulls(
            [
                'billingAddress' => $billingAddress,
                'description' => $description,
                'digitalWallet' => $digitalWallet,
                'entityID' => $entityID,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($cardID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Cards
     *
     * @param string $accountID filter Cards to ones belonging to the specified Account
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param \Increase\Cards\CardListParams\Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<Card>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        \Increase\Cards\CardListParams\Status|array|null $status = null,
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
     * Create an iframe URL for a Card to display the card details. More details about styling and usage can be found in the [documentation](/documentation/embedded-card-component).
     *
     * @param string $cardID the identifier of the Card to create an iframe for
     * @param string $physicalCardID The identifier of the Physical Card to create an iframe for. This will inform the appearance of the card rendered in the iframe.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createDetailsIframe(
        string $cardID,
        ?string $physicalCardID = null,
        RequestOptions|array|null $requestOptions = null,
    ): CardIframeURL {
        $params = Util::removeNulls(['physicalCardID' => $physicalCardID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createDetailsIframe($cardID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Sensitive details for a Card include the primary account number, expiry, card verification code, and PIN.
     *
     * @param string $cardID the identifier of the Card to retrieve details for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function details(
        string $cardID,
        RequestOptions|array|null $requestOptions = null
    ): CardDetails {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->details($cardID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a Card's PIN
     *
     * @param string $cardID the identifier of the Card to update the PIN for
     * @param string $pin the 4-digit PIN for the card, for use with ATMs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updatePin(
        string $cardID,
        string $pin,
        RequestOptions|array|null $requestOptions = null,
    ): CardDetails {
        $params = Util::removeNulls(['pin' => $pin]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->updatePin($cardID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
