<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\CardValidations\CardValidation;
use Increase\CardValidations\CardValidationListParams\CreatedAt;
use Increase\CardValidations\CardValidationListParams\Status;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\CardValidations\CardValidationListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\CardValidations\CardValidationListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardValidationsContract
{
    /**
     * @api
     *
     * @param string $accountID the identifier of the Account from which to send the validation
     * @param string $cardTokenID the Increase identifier for the Card Token that represents the card number you're validating
     * @param string $merchantCategoryCode a four-digit code (MCC) identifying the type of business or service provided by the merchant
     * @param string $merchantCityName the city where the merchant (typically your business) is located
     * @param string $merchantName The merchant name that will appear in the cardholder’s statement descriptor. Typically your business name.
     * @param string $merchantPostalCode the postal code for the merchant’s (typically your business’s) location
     * @param string $merchantState The U.S. state where the merchant (typically your business) is located.
     * @param string $cardholderFirstName the cardholder's first name
     * @param string $cardholderLastName the cardholder's last name
     * @param string $cardholderMiddleName the cardholder's middle name
     * @param string $cardholderPostalCode the postal code of the cardholder's address
     * @param string $cardholderStreetAddress the cardholder's street address
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        string $cardTokenID,
        string $merchantCategoryCode,
        string $merchantCityName,
        string $merchantName,
        string $merchantPostalCode,
        string $merchantState,
        ?string $cardholderFirstName = null,
        ?string $cardholderLastName = null,
        ?string $cardholderMiddleName = null,
        ?string $cardholderPostalCode = null,
        ?string $cardholderStreetAddress = null,
        RequestOptions|array|null $requestOptions = null,
    ): CardValidation;

    /**
     * @api
     *
     * @param string $cardValidationID the identifier of the Card Validation
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardValidationID,
        RequestOptions|array|null $requestOptions = null
    ): CardValidation;

    /**
     * @api
     *
     * @param string $accountID filter Card Validations to ones belonging to the specified Account
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<CardValidation>
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
    ): Page;
}
