<?php

declare(strict_types=1);

namespace Increase\IntrafiBalances\IntrafiBalance\Balance;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The primary location of the bank.
 *
 * @phpstan-type BankLocationShape = array{city: string, state: string}
 */
final class BankLocation implements BaseModel
{
    /** @use SdkModel<BankLocationShape> */
    use SdkModel;

    /**
     * The bank's city.
     */
    #[Required]
    public string $city;

    /**
     * The bank's state.
     */
    #[Required]
    public string $state;

    /**
     * `new BankLocation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BankLocation::with(city: ..., state: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BankLocation)->withCity(...)->withState(...)
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
    public static function with(string $city, string $state): self
    {
        $self = new self;

        $self['city'] = $city;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The bank's city.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * The bank's state.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
