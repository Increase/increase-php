<?php

declare(strict_types=1);

namespace Increase\Entities\EntityUpdateParams\SoleProprietorship;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityUpdateParams\SoleProprietorship\SoleProprietor\Address;
use Increase\Entities\EntityUpdateParams\SoleProprietorship\SoleProprietor\Identification;

/**
 * Details of the individual who operates the sole proprietorship.
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\EntityUpdateParams\SoleProprietorship\SoleProprietor\Address
 * @phpstan-import-type IdentificationShape from \Increase\Entities\EntityUpdateParams\SoleProprietorship\SoleProprietor\Identification
 *
 * @phpstan-type SoleProprietorShape = array{
 *   address?: null|\Increase\Entities\EntityUpdateParams\SoleProprietorship\SoleProprietor\Address|AddressShape,
 *   identification?: null|Identification|IdentificationShape,
 *   name?: string|null,
 * }
 */
final class SoleProprietor implements BaseModel
{
    /** @use SdkModel<SoleProprietorShape> */
    use SdkModel;

    /**
     * The sole proprietor's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     */
    #[Optional]
    public ?Address $address;

    /**
     * A means of verifying the sole proprietor's identity. Unlike at creation, an identity document is accepted here.
     */
    #[Optional]
    public ?Identification $identification;

    /**
     * The sole proprietor's legal name.
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
     * @param Identification|IdentificationShape|null $identification
     */
    public static function with(
        Address|array|null $address = null,
        Identification|array|null $identification = null,
        ?string $name = null,
    ): self {
        $self = new self;

        null !== $address && $self['address'] = $address;
        null !== $identification && $self['identification'] = $identification;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * The sole proprietor's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     *
     * @param Address|AddressShape $address
     */
    public function withAddress(
        Address|array $address,
    ): self {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    /**
     * A means of verifying the sole proprietor's identity. Unlike at creation, an identity document is accepted here.
     *
     * @param Identification|IdentificationShape $identification
     */
    public function withIdentification(
        Identification|array $identification
    ): self {
        $self = clone $this;
        $self['identification'] = $identification;

        return $self;
    }

    /**
     * The sole proprietor's legal name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
