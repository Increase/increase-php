<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\BeneficialOwners\EntityBeneficialOwner;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\BeneficialOwnersContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class BeneficialOwnersService implements BeneficialOwnersContract
{
    /**
     * @api
     */
    public BeneficialOwnersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BeneficialOwnersRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a Beneficial Owner
     *
     * @param string $entityBeneficialOwnerID the identifier of the Beneficial Owner to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $entityBeneficialOwnerID,
        RequestOptions|array|null $requestOptions = null,
    ): EntityBeneficialOwner {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($entityBeneficialOwnerID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Beneficial Owners
     *
     * @param string $entityID The identifier of the Entity to list beneficial owners for. Only `corporation` entities have beneficial owners.
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<EntityBeneficialOwner>
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
