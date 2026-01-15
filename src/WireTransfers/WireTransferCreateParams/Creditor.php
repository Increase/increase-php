<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransferCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\WireTransfers\WireTransferCreateParams\Creditor\Address;

/**
 * The person or business that is receiving the funds from the transfer.
 *
 * @phpstan-import-type AddressShape from \Increase\WireTransfers\WireTransferCreateParams\Creditor\Address
 *
 * @phpstan-type CreditorShape = array{
 *   name: string, address?: null|Address|AddressShape
 * }
 */
final class Creditor implements BaseModel
{
    /** @use SdkModel<CreditorShape> */
    use SdkModel;

    /**
     * The person or business's name.
     */
    #[Required]
    public string $name;

    /**
     * The person or business's address.
     */
    #[Optional]
    public ?Address $address;

    /**
     * `new Creditor()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Creditor::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Creditor)->withName(...)
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
        string $name,
        Address|array|null $address = null
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $address && $self['address'] = $address;

        return $self;
    }

    /**
     * The person or business's name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The person or business's address.
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
