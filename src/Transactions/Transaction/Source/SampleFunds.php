<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Sample Funds object. This field will be present in the JSON response if and only if `category` is equal to `sample_funds`. Sample funds for testing purposes.
 *
 * @phpstan-type SampleFundsShape = array{originator: string}
 */
final class SampleFunds implements BaseModel
{
    /** @use SdkModel<SampleFundsShape> */
    use SdkModel;

    /**
     * Where the sample funds came from.
     */
    #[Required]
    public string $originator;

    /**
     * `new SampleFunds()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SampleFunds::with(originator: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SampleFunds)->withOriginator(...)
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
    public static function with(string $originator): self
    {
        $self = new self;

        $self['originator'] = $originator;

        return $self;
    }

    /**
     * Where the sample funds came from.
     */
    public function withOriginator(string $originator): self
    {
        $self = clone $this;
        $self['originator'] = $originator;

        return $self;
    }
}
