<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransfer\Remittance;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Unstructured remittance information. Required if `category` is equal to `unstructured`.
 *
 * @phpstan-type UnstructuredShape = array{message: string}
 */
final class Unstructured implements BaseModel
{
    /** @use SdkModel<UnstructuredShape> */
    use SdkModel;

    /**
     * The message to the beneficiary.
     */
    #[Required]
    public string $message;

    /**
     * `new Unstructured()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Unstructured::with(message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Unstructured)->withMessage(...)
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
    public static function with(string $message): self
    {
        $self = new self;

        $self['message'] = $message;

        return $self;
    }

    /**
     * The message to the beneficiary.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
