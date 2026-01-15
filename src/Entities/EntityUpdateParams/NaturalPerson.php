<?php

declare(strict_types=1);

namespace Increase\Entities\EntityUpdateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityUpdateParams\NaturalPerson\Address;

/**
 * Details of the natural person entity to update. If you specify this parameter and the entity is not a natural person, the request will fail.
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\EntityUpdateParams\NaturalPerson\Address
 *
 * @phpstan-type NaturalPersonShape = array{
 *   address?: null|Address|AddressShape, name?: string|null
 * }
 */
final class NaturalPerson implements BaseModel
{
    /** @use SdkModel<NaturalPersonShape> */
    use SdkModel;

    /**
     * The entity's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     */
    #[Optional]
    public ?Address $address;

    /**
     * The legal name of the natural person.
     */
    #[Optional]
    public ?string $name;

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
    public static function with(
        Address|array|null $address = null,
        ?string $name = null
    ): self {
        $self = new self;

        null !== $address && $self['address'] = $address;
        null !== $name && $self['name'] = $name;

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

    /**
     * The legal name of the natural person.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
