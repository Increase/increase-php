<?php

declare(strict_types=1);

namespace Increase\Entities;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityUpdateBeneficialOwnerAddressParams\Address;

/**
 * Update the address for a beneficial owner belonging to a corporate Entity.
 *
 * @see Increase\Services\EntitiesService::updateBeneficialOwnerAddress()
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\EntityUpdateBeneficialOwnerAddressParams\Address
 *
 * @phpstan-type EntityUpdateBeneficialOwnerAddressParamsShape = array{
 *   address: Address|AddressShape, beneficialOwnerID: string
 * }
 */
final class EntityUpdateBeneficialOwnerAddressParams implements BaseModel
{
    /** @use SdkModel<EntityUpdateBeneficialOwnerAddressParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The individual's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     */
    #[Required]
    public Address $address;

    /**
     * The identifying details of anyone controlling or owning 25% or more of the corporation.
     */
    #[Required('beneficial_owner_id')]
    public string $beneficialOwnerID;

    /**
     * `new EntityUpdateBeneficialOwnerAddressParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntityUpdateBeneficialOwnerAddressParams::with(
     *   address: ..., beneficialOwnerID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntityUpdateBeneficialOwnerAddressParams)
     *   ->withAddress(...)
     *   ->withBeneficialOwnerID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Address|AddressShape $address
     */
    public static function with(
        Address|array $address,
        string $beneficialOwnerID
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['beneficialOwnerID'] = $beneficialOwnerID;

        return $self;
    }

    /**
     * The individual's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     *
     * @param Address|AddressShape $address
     */
    public function withAddress(Address|array $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    /**
     * The identifying details of anyone controlling or owning 25% or more of the corporation.
     */
    public function withBeneficialOwnerID(string $beneficialOwnerID): self
    {
        $self = clone $this;
        $self['beneficialOwnerID'] = $beneficialOwnerID;

        return $self;
    }
}
