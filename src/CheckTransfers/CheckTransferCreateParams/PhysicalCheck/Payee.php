<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type PayeeShape = array{contents: string}
 */
final class Payee implements BaseModel
{
    /** @use SdkModel<PayeeShape> */
    use SdkModel;

    /**
     * The contents of the line.
     */
    #[Required]
    public string $contents;

    /**
     * `new Payee()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Payee::with(contents: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Payee)->withContents(...)
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
    public static function with(string $contents): self
    {
        $self = new self;

        $self['contents'] = $contents;

        return $self;
    }

    /**
     * The contents of the line.
     */
    public function withContents(string $contents): self
    {
        $self = clone $this;
        $self['contents'] = $contents;

        return $self;
    }
}
