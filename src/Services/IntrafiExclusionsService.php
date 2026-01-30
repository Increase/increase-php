<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\IntrafiExclusions\IntrafiExclusion;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\IntrafiExclusionsContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class IntrafiExclusionsService implements IntrafiExclusionsContract
{
    /**
     * @api
     */
    public IntrafiExclusionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new IntrafiExclusionsRawService($client);
    }

    /**
     * @api
     *
     * Create an IntraFi Exclusion
     *
     * @param string $entityID the identifier of the Entity whose deposits will be excluded
     * @param string $fdicCertificateNumber The FDIC certificate number of the financial institution to be excluded. An FDIC certificate number uniquely identifies a financial institution, and is different than a routing number. To find one, we recommend searching by Bank Name using the [FDIC's bankfind tool](https://banks.data.fdic.gov/bankfind-suite/bankfind).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $entityID,
        string $fdicCertificateNumber,
        RequestOptions|array|null $requestOptions = null,
    ): IntrafiExclusion {
        $params = Util::removeNulls(
            [
                'entityID' => $entityID,
                'fdicCertificateNumber' => $fdicCertificateNumber,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get an IntraFi Exclusion
     *
     * @param string $intrafiExclusionID the identifier of the IntraFi Exclusion to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $intrafiExclusionID,
        RequestOptions|array|null $requestOptions = null
    ): IntrafiExclusion {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($intrafiExclusionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List IntraFi Exclusions
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
    ): Page {
        $params = Util::removeNulls(
            [
                'cursor' => $cursor,
                'entityID' => $entityID,
                'idempotencyKey' => $idempotencyKey,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Archive an IntraFi Exclusion
     *
     * @param string $intrafiExclusionID The identifier of the IntraFi Exclusion request to archive. It may take 5 business days for an exclusion removal to be processed. Removing an exclusion does not guarantee that funds will be swept to the previously-excluded bank.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $intrafiExclusionID,
        RequestOptions|array|null $requestOptions = null
    ): IntrafiExclusion {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($intrafiExclusionID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
