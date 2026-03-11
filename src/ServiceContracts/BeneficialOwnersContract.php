<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\BeneficialOwners\BeneficialOwnerUpdateParams\Address;
use Increase\BeneficialOwners\BeneficialOwnerUpdateParams\Identification;
use Increase\BeneficialOwners\EntityBeneficialOwner;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type AddressShape from \Increase\BeneficialOwners\BeneficialOwnerUpdateParams\Address
 * @phpstan-import-type IdentificationShape from \Increase\BeneficialOwners\BeneficialOwnerUpdateParams\Identification
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface BeneficialOwnersContract
{
    /**
     * @api
     *
     * @param string $entityBeneficialOwnerID the identifier of the Beneficial Owner to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $entityBeneficialOwnerID,
        RequestOptions|array|null $requestOptions = null,
    ): EntityBeneficialOwner;

    /**
     * @api
     *
     * @param string $entityBeneficialOwnerID the identifier of the Beneficial Owner to update
     * @param Address|AddressShape $address The individual's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     * @param bool $confirmedNoUsTaxID the identification method for an individual can only be a passport, driver's license, or other document if you've confirmed the individual does not have a US tax id (either a Social Security Number or Individual Taxpayer Identification Number)
     * @param Identification|IdentificationShape $identification a means of verifying the person's identity
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $entityBeneficialOwnerID,
        Address|array|null $address = null,
        ?bool $confirmedNoUsTaxID = null,
        Identification|array|null $identification = null,
        RequestOptions|array|null $requestOptions = null,
    ): EntityBeneficialOwner;

    /**
     * @api
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
    ): Page;
}
