<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransfer\Creditor;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\WireTransfers\WireTransfer\Creditor\Address\Unstructured;

/**
 * The person or business's address.
 *
 * @phpstan-import-type UnstructuredShape from \Increase\WireTransfers\WireTransfer\Creditor\Address\Unstructured
 *
 * @phpstan-type AddressShape = array{
 *   unstructured: null|Unstructured|UnstructuredShape
 * }
 */
final class Address implements BaseModel
{
    /** @use SdkModel<AddressShape> */
    use SdkModel;

    /**
     * Unstructured address lines.
     */
    #[Required]
    public ?Unstructured $unstructured;

    /**
     * `new Address()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Address::with(unstructured: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Address)->withUnstructured(...)
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
     * @param Unstructured|UnstructuredShape|null $unstructured
     */
    public static function with(Unstructured|array|null $unstructured): self
    {
        $self = new self;

        $self['unstructured'] = $unstructured;

        return $self;
    }

    /**
     * Unstructured address lines.
     *
     * @param Unstructured|UnstructuredShape|null $unstructured
     */
    public function withUnstructured(
        Unstructured|array|null $unstructured
    ): self {
        $self = clone $this;
        $self['unstructured'] = $unstructured;

        return $self;
    }
}
