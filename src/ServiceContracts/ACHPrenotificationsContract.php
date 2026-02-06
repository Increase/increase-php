<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\ACHPrenotifications\ACHPrenotification;
use Increase\ACHPrenotifications\ACHPrenotificationCreateParams\CreditDebitIndicator;
use Increase\ACHPrenotifications\ACHPrenotificationCreateParams\StandardEntryClassCode;
use Increase\ACHPrenotifications\ACHPrenotificationListParams\CreatedAt;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\ACHPrenotifications\ACHPrenotificationListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface ACHPrenotificationsContract
{
    /**
     * @api
     *
     * @param string $accountID the Increase identifier for the account that will send the ACH Prenotification
     * @param string $accountNumber the account number for the destination account
     * @param string $routingNumber the American Bankers' Association (ABA) Routing Transit Number (RTN) for the destination account
     * @param string $addendum additional information that will be sent to the recipient
     * @param string $companyDescriptiveDate the description of the date of the ACH Prenotification
     * @param string $companyDiscretionaryData the data you choose to associate with the ACH Prenotification
     * @param string $companyEntryDescription the description you wish to be shown to the recipient
     * @param string $companyName the name by which the recipient knows you
     * @param CreditDebitIndicator|value-of<CreditDebitIndicator> $creditDebitIndicator whether the Prenotification is for a future debit or credit
     * @param string $effectiveDate The ACH Prenotification effective date in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format.
     * @param string $individualID your identifier for the recipient
     * @param string $individualName The name of therecipient. This value is informational and not verified by the recipient's bank.
     * @param StandardEntryClassCode|value-of<StandardEntryClassCode> $standardEntryClassCode the [Standard Entry Class (SEC) code](/documentation/ach-standard-entry-class-codes) to use for the ACH Prenotification
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        string $accountNumber,
        string $routingNumber,
        ?string $addendum = null,
        ?string $companyDescriptiveDate = null,
        ?string $companyDiscretionaryData = null,
        ?string $companyEntryDescription = null,
        ?string $companyName = null,
        CreditDebitIndicator|string|null $creditDebitIndicator = null,
        ?string $effectiveDate = null,
        ?string $individualID = null,
        ?string $individualName = null,
        StandardEntryClassCode|string|null $standardEntryClassCode = null,
        RequestOptions|array|null $requestOptions = null,
    ): ACHPrenotification;

    /**
     * @api
     *
     * @param string $achPrenotificationID the identifier of the ACH Prenotification to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $achPrenotificationID,
        RequestOptions|array|null $requestOptions = null,
    ): ACHPrenotification;

    /**
     * @api
     *
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<ACHPrenotification>
     *
     * @throws APIException
     */
    public function list(
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;
}
