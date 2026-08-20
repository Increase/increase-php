<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransferCreateParams\Debtor;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\WireTransfers\WireTransferCreateParams\Debtor\Address\Structured;

/**
 * The person or business's address.
 *
 * @phpstan-import-type StructuredShape from \Increase\WireTransfers\WireTransferCreateParams\Debtor\Address\Structured
 *
 * @phpstan-type AddressShape = array{structured?: null|Structured|StructuredShape}
 */
final class Address implements BaseModel
{
    /** @use SdkModel<AddressShape> */
    use SdkModel;

    /**
     * Structured address components. City and country are required.
     */
    #[Optional]
    public ?Structured $structured;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Structured|StructuredShape|null $structured
     */
    public static function with(Structured|array|null $structured = null): self
    {
        $self = new self;

        null !== $structured && $self['structured'] = $structured;

        return $self;
    }

    /**
     * Structured address components. City and country are required.
     *
     * @param Structured|StructuredShape $structured
     */
    public function withStructured(Structured|array $structured): self
    {
        $self = clone $this;
        $self['structured'] = $structured;

        return $self;
    }
}
