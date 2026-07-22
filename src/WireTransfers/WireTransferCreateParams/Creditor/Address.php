<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransferCreateParams\Creditor;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\WireTransfers\WireTransferCreateParams\Creditor\Address\Unstructured;

/**
 * The person or business's address.
 *
 * @phpstan-import-type UnstructuredShape from \Increase\WireTransfers\WireTransferCreateParams\Creditor\Address\Unstructured
 *
 * @phpstan-type AddressShape = array{
 *   unstructured?: null|Unstructured|UnstructuredShape
 * }
 */
final class Address implements BaseModel
{
    /** @use SdkModel<AddressShape> */
    use SdkModel;

    /**
     * Unstructured address lines.
     */
    #[Optional]
    public ?Unstructured $unstructured;

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
    public static function with(Unstructured|array|null $unstructured = null): self
    {
        $self = new self;

        null !== $unstructured && $self['unstructured'] = $unstructured;

        return $self;
    }

    /**
     * Unstructured address lines.
     *
     * @param Unstructured|UnstructuredShape $unstructured
     */
    public function withUnstructured(Unstructured|array $unstructured): self
    {
        $self = clone $this;
        $self['unstructured'] = $unstructured;

        return $self;
    }
}
