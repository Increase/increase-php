<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Checkbooks\Checkbook;
use Increase\Checkbooks\CheckbookCreateParams\MailingAddress;
use Increase\Checkbooks\CheckbookCreateParams\Payer;
use Increase\Checkbooks\CheckbookListParams\Status;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type MailingAddressShape from \Increase\Checkbooks\CheckbookCreateParams\MailingAddress
 * @phpstan-import-type PayerShape from \Increase\Checkbooks\CheckbookCreateParams\Payer
 * @phpstan-import-type StatusShape from \Increase\Checkbooks\CheckbookListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CheckbooksContract
{
    /**
     * @api
     *
     * @param string $accountNumberID The identifier of the Account Number that the checks will draw from. The Account Number must be active.
     * @param MailingAddress|MailingAddressShape $mailingAddress the destination address that the Checkbook will be mailed to
     * @param list<Payer|PayerShape> $payer The payer of the checks. This will be printed on the top-left corner of each check. This should be an array of up to 4 elements, each of which represents a line of the payer.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountNumberID,
        MailingAddress|array $mailingAddress,
        array $payer,
        RequestOptions|array|null $requestOptions = null,
    ): Checkbook;

    /**
     * @api
     *
     * @param string $checkbookID the identifier of the Checkbook
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $checkbookID,
        RequestOptions|array|null $requestOptions = null
    ): Checkbook;

    /**
     * @api
     *
     * @param string $accountNumberID filter Checkbooks to those attached to the specified Account Number
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     *
     * Defaults to `100`.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<Checkbook>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountNumberID = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        int $limit = 100,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;

    /**
     * @api
     *
     * @param string $checkbookID the identifier of the Checkbook to stop
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function stop(
        string $checkbookID,
        RequestOptions|array|null $requestOptions = null
    ): Checkbook;
}
