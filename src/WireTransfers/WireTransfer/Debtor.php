<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\WireTransfers\WireTransfer\Debtor\Address;

/**
 * The person or business whose funds are being transferred.
 *
 * @phpstan-import-type AddressShape from \Increase\WireTransfers\WireTransfer\Debtor\Address
 *
 * @phpstan-type DebtorShape = array{
 *   address: null|Address|AddressShape, name: string|null
 * }
 */
final class Debtor implements BaseModel
{
    /** @use SdkModel<DebtorShape> */
    use SdkModel;

    /**
     * The person or business's address.
     */
    #[Required]
    public ?Address $address;

    /**
     * The person or business's name.
     */
    #[Required]
    public ?string $name;

    /**
     * `new Debtor()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Debtor::with(address: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Debtor)->withAddress(...)->withName(...)
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
     * @param Address|AddressShape|null $address
     */
    public static function with(
        Address|array|null $address,
        ?string $name
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The person or business's address.
     *
     * @param Address|AddressShape|null $address
     */
    public function withAddress(Address|array|null $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    /**
     * The person or business's name.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
