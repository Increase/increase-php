<?php

declare(strict_types=1);

namespace Increase\Entities\EntityUpdateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityUpdateParams\Trust\Address;
use Increase\Entities\EntityUpdateParams\Trust\Trustee;

/**
 * Details of the trust entity to update. If you specify this parameter and the entity is not a trust, the request will fail.
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\EntityUpdateParams\Trust\Address
 * @phpstan-import-type TrusteeShape from \Increase\Entities\EntityUpdateParams\Trust\Trustee
 *
 * @phpstan-type TrustShape = array{
 *   address?: null|Address|AddressShape,
 *   name?: string|null,
 *   trustees?: list<Trustee|TrusteeShape>|null,
 * }
 */
final class Trust implements BaseModel
{
    /** @use SdkModel<TrustShape> */
    use SdkModel;

    /**
     * The entity's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     */
    #[Optional]
    public ?Address $address;

    /**
     * The legal name of the trust.
     */
    #[Optional]
    public ?string $name;

    /**
     * The trustees of the trust. If you specify this parameter, the trust's existing trustees will be archived and replaced with the trustees you provide.
     *
     * @var list<Trustee>|null $trustees
     */
    #[Optional(list: Trustee::class)]
    public ?array $trustees;

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
     * @param list<Trustee|TrusteeShape>|null $trustees
     */
    public static function with(
        Address|array|null $address = null,
        ?string $name = null,
        ?array $trustees = null
    ): self {
        $self = new self;

        null !== $address && $self['address'] = $address;
        null !== $name && $self['name'] = $name;
        null !== $trustees && $self['trustees'] = $trustees;

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
     * The legal name of the trust.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The trustees of the trust. If you specify this parameter, the trust's existing trustees will be archived and replaced with the trustees you provide.
     *
     * @param list<Trustee|TrusteeShape> $trustees
     */
    public function withTrustees(array $trustees): self
    {
        $self = clone $this;
        $self['trustees'] = $trustees;

        return $self;
    }
}
