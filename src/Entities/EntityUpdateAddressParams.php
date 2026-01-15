<?php

declare(strict_types=1);

namespace Increase\Entities;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityUpdateAddressParams\Address;

/**
 * Update a Natural Person or Corporation's address.
 *
 * @see Increase\Services\EntitiesService::updateAddress()
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\EntityUpdateAddressParams\Address
 *
 * @phpstan-type EntityUpdateAddressParamsShape = array{
 *   address: Address|AddressShape
 * }
 */
final class EntityUpdateAddressParams implements BaseModel
{
    /** @use SdkModel<EntityUpdateAddressParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The entity's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     */
    #[Required]
    public Address $address;

    /**
     * `new EntityUpdateAddressParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntityUpdateAddressParams::with(address: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntityUpdateAddressParams)->withAddress(...)
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
    public static function with(Address|array $address): self
    {
        $self = new self;

        $self['address'] = $address;

        return $self;
    }

    /**
     * The entity's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     *
     * @param Address|AddressShape $address
     */
    public function withAddress(Address|array $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }
}
