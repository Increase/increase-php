<?php

declare(strict_types=1);

namespace Increase\BeneficialOwners;

use Increase\BeneficialOwners\BeneficialOwnerUpdateParams\Address;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Update a Beneficial Owner.
 *
 * @see Increase\Services\BeneficialOwnersService::update()
 *
 * @phpstan-import-type AddressShape from \Increase\BeneficialOwners\BeneficialOwnerUpdateParams\Address
 *
 * @phpstan-type BeneficialOwnerUpdateParamsShape = array{
 *   address?: null|Address|AddressShape
 * }
 */
final class BeneficialOwnerUpdateParams implements BaseModel
{
    /** @use SdkModel<BeneficialOwnerUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The individual's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     */
    #[Optional]
    public ?Address $address;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Address|AddressShape|null $address
     */
    public static function with(Address|array|null $address = null): self
    {
        $self = new self;

        null !== $address && $self['address'] = $address;

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
}
