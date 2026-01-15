<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransferCreateParams\Debtor\Address;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Unstructured address lines.
 *
 * @phpstan-type UnstructuredShape = array{
 *   line1: string, line2?: string|null, line3?: string|null
 * }
 */
final class Unstructured implements BaseModel
{
    /** @use SdkModel<UnstructuredShape> */
    use SdkModel;

    /**
     * The address line 1.
     */
    #[Required]
    public string $line1;

    /**
     * The address line 2.
     */
    #[Optional]
    public ?string $line2;

    /**
     * The address line 3.
     */
    #[Optional]
    public ?string $line3;

    /**
     * `new Unstructured()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Unstructured::with(line1: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Unstructured)->withLine1(...)
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
     */
    public static function with(
        string $line1,
        ?string $line2 = null,
        ?string $line3 = null
    ): self {
        $self = new self;

        $self['line1'] = $line1;

        null !== $line2 && $self['line2'] = $line2;
        null !== $line3 && $self['line3'] = $line3;

        return $self;
    }

    /**
     * The address line 1.
     */
    public function withLine1(string $line1): self
    {
        $self = clone $this;
        $self['line1'] = $line1;

        return $self;
    }

    /**
     * The address line 2.
     */
    public function withLine2(string $line2): self
    {
        $self = clone $this;
        $self['line2'] = $line2;

        return $self;
    }

    /**
     * The address line 3.
     */
    public function withLine3(string $line3): self
    {
        $self = clone $this;
        $self['line3'] = $line3;

        return $self;
    }
}
