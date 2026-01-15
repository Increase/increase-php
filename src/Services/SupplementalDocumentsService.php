<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\SupplementalDocumentsContract;
use Increase\SupplementalDocuments\EntitySupplementalDocument;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class SupplementalDocumentsService implements SupplementalDocumentsContract
{
    /**
     * @api
     */
    public SupplementalDocumentsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SupplementalDocumentsRawService($client);
    }

    /**
     * @api
     *
     * Create a supplemental document for an Entity
     *
     * @param string $entityID the identifier of the Entity to associate with the supplemental document
     * @param string $fileID the identifier of the File containing the document
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $entityID,
        string $fileID,
        RequestOptions|array|null $requestOptions = null,
    ): EntitySupplementalDocument {
        $params = Util::removeNulls(['entityID' => $entityID, 'fileID' => $fileID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Entity Supplemental Document Submissions
     *
     * @param string $entityID the identifier of the Entity to list supplemental documents for
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<EntitySupplementalDocument>
     *
     * @throws APIException
     */
    public function list(
        string $entityID,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'entityID' => $entityID,
                'cursor' => $cursor,
                'idempotencyKey' => $idempotencyKey,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
