<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams\VoidedCheck;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type PayerShape = array{line: string}
 */
final class Payer implements BaseModel
{
    /** @use SdkModel<PayerShape> */
    use SdkModel;

    /**
     * The contents of the line.
     */
    #[Required]
    public string $line;

    /**
     * `new Payer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Payer::with(line: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Payer)->withLine(...)
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
    public static function with(string $line): self
    {
        $self = new self;

        $self['line'] = $line;

        return $self;
    }

    /**
     * The contents of the line.
     */
    public function withLine(string $line): self
    {
        $self = clone $this;
        $self['line'] = $line;

        return $self;
    }
}
