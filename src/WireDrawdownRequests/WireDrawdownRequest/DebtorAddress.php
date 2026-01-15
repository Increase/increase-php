<?php

declare(strict_types=1);

namespace Increase\WireDrawdownRequests\WireDrawdownRequest;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The debtor's address.
 *
 * @phpstan-type DebtorAddressShape = array{
 *   city: string,
 *   country: string,
 *   line1: string,
 *   line2: string|null,
 *   postalCode: string|null,
 *   state: string|null,
 * }
 */
final class DebtorAddress implements BaseModel
{
    /** @use SdkModel<DebtorAddressShape> */
    use SdkModel;

    /**
     * The city, district, town, or village of the address.
     */
    #[Required]
    public string $city;

    /**
     * The two-letter [ISO 3166-1 alpha-2](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) code for the country of the address.
     */
    #[Required]
    public string $country;

    /**
     * The first line of the address.
     */
    #[Required]
    public string $line1;

    /**
     * The second line of the address.
     */
    #[Required]
    public ?string $line2;

    /**
     * The ZIP code of the address.
     */
    #[Required('postal_code')]
    public ?string $postalCode;

    /**
     * The address state.
     */
    #[Required]
    public ?string $state;

    /**
     * `new DebtorAddress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DebtorAddress::with(
     *   city: ..., country: ..., line1: ..., line2: ..., postalCode: ..., state: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DebtorAddress)
     *   ->withCity(...)
     *   ->withCountry(...)
     *   ->withLine1(...)
     *   ->withLine2(...)
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
        string $country,
        string $line1,
        ?string $line2,
        ?string $postalCode,
        ?string $state,
    ): self {
        $self = new self;

        $self['city'] = $city;
        $self['country'] = $country;
        $self['line1'] = $line1;
        $self['line2'] = $line2;
        $self['postalCode'] = $postalCode;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The city, district, town, or village of the address.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * The two-letter [ISO 3166-1 alpha-2](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) code for the country of the address.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * The first line of the address.
     */
    public function withLine1(string $line1): self
    {
        $self = clone $this;
        $self['line1'] = $line1;

        return $self;
    }

    /**
     * The second line of the address.
     */
    public function withLine2(?string $line2): self
    {
        $self = clone $this;
        $self['line2'] = $line2;

        return $self;
    }

    /**
     * The ZIP code of the address.
     */
    public function withPostalCode(?string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * The address state.
     */
    public function withState(?string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
