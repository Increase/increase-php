<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\IntrafiExclusions\IntrafiExclusion;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface IntrafiExclusionsContract
{
    /**
     * @api
     *
     * @param string $bankName the name of the financial institution to be excluded
     * @param string $entityID the identifier of the Entity whose deposits will be excluded
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $bankName,
        string $entityID,
        RequestOptions|array|null $requestOptions = null,
    ): IntrafiExclusion;

    /**
     * @api
     *
     * @param string $intrafiExclusionID the identifier of the IntraFi Exclusion to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $intrafiExclusionID,
        RequestOptions|array|null $requestOptions = null,
    ): IntrafiExclusion;

    /**
     * @api
     *
     * @param string $cursor return the page of entries after this one
     * @param string $entityID filter IntraFi Exclusions for those belonging to the specified Entity
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<IntrafiExclusion>
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?string $entityID = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;

    /**
     * @api
     *
     * @param string $intrafiExclusionID The identifier of the IntraFi Exclusion request to archive. It may take 5 business days for an exclusion removal to be processed. Removing an exclusion does not guarantee that funds will be swept to the previously-excluded bank.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $intrafiExclusionID,
        RequestOptions|array|null $requestOptions = null,
    ): IntrafiExclusion;
}
