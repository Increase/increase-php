<?php

declare(strict_types=1);

namespace Increase\Checkbooks\Checkbook;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The address the Checkbook will return to if there is a delivery issue.
 *
 * @phpstan-type ReturnAddressShape = array{
 *   city: string,
 *   line1: string,
 *   line2: string|null,
 *   name: string,
 *   postalCode: string,
 *   state: string,
 * }
 */
final class ReturnAddress implements BaseModel
{
    /** @use SdkModel<ReturnAddressShape> */
    use SdkModel;

    /**
     * The city of the return address.
     */
    #[Required]
    public string $city;

    /**
     * The first line of the return address.
     */
    #[Required]
    public string $line1;

    /**
     * The second line of the return address.
     */
    #[Required]
    public ?string $line2;

    /**
     * The recipient at the return address.
     */
    #[Required]
    public string $name;

    /**
     * The postal code of the return address.
     */
    #[Required('postal_code')]
    public string $postalCode;

    /**
     * The state of the return address.
     */
    #[Required]
    public string $state;

    /**
     * `new ReturnAddress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReturnAddress::with(
     *   city: ..., line1: ..., line2: ..., name: ..., postalCode: ..., state: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReturnAddress)
     *   ->withCity(...)
     *   ->withLine1(...)
     *   ->withLine2(...)
     *   ->withName(...)
     *   ->withPostalCode(...)
     *   ->withState(...)
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
        string $city,
        string $line1,
        ?string $line2,
        string $name,
        string $postalCode,
        string $state,
    ): self {
        $self = new self;

        $self['city'] = $city;
        $self['line1'] = $line1;
        $self['line2'] = $line2;
        $self['name'] = $name;
        $self['postalCode'] = $postalCode;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The city of the return address.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * The first line of the return address.
     */
    public function withLine1(string $line1): self
    {
        $self = clone $this;
        $self['line1'] = $line1;

        return $self;
    }

    /**
     * The second line of the return address.
     */
    public function withLine2(?string $line2): self
    {
        $self = clone $this;
        $self['line2'] = $line2;

        return $self;
    }

    /**
     * The recipient at the return address.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The postal code of the return address.
     */
    public function withPostalCode(string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * The state of the return address.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
