<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransferCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\WireTransfers\WireTransferCreateParams\Debtor\Address;

/**
 * The person or business whose funds are being transferred. This is only necessary if you're transferring from a commingled account. Otherwise, we'll use the associated entity's details.
 *
 * @phpstan-import-type AddressShape from \Increase\WireTransfers\WireTransferCreateParams\Debtor\Address
 *
 * @phpstan-type DebtorShape = array{
 *   name: string, address?: null|Address|AddressShape
 * }
 */
final class Debtor implements BaseModel
{
    /** @use SdkModel<DebtorShape> */
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
     * `new Debtor()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Debtor::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Debtor)->withName(...)
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
