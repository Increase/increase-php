<?php

declare(strict_types=1);

namespace Increase\Cards\CardCreateParams\AuthorizationControls\MerchantCountry;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type AllowedShape = array{country: string}
 */
final class Allowed implements BaseModel
{
    /** @use SdkModel<AllowedShape> */
    use SdkModel;

    /**
     * The ISO 3166-1 alpha-2 country code.
     */
    #[Required]
    public string $country;

    /**
     * `new Allowed()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Allowed::with(country: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Allowed)->withCountry(...)
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
    public static function with(string $country): self
    {
        $self = new self;

        $self['country'] = $country;

        return $self;
    }

    /**
     * The ISO 3166-1 alpha-2 country code.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }
}
