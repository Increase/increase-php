<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams\Trust\Grantor;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityCreateParams\Trust\Grantor\Identification\DriversLicense;
use Increase\Entities\EntityCreateParams\Trust\Grantor\Identification\Method;
use Increase\Entities\EntityCreateParams\Trust\Grantor\Identification\Other;
use Increase\Entities\EntityCreateParams\Trust\Grantor\Identification\Passport;

/**
 * A means of verifying the person's identity.
 *
 * @phpstan-import-type DriversLicenseShape from \Increase\Entities\EntityCreateParams\Trust\Grantor\Identification\DriversLicense
 * @phpstan-import-type OtherShape from \Increase\Entities\EntityCreateParams\Trust\Grantor\Identification\Other
 * @phpstan-import-type PassportShape from \Increase\Entities\EntityCreateParams\Trust\Grantor\Identification\Passport
 *
 * @phpstan-type IdentificationShape = array{
 *   method: Method|value-of<Method>,
 *   number: string,
 *   driversLicense?: null|DriversLicense|DriversLicenseShape,
 *   other?: null|Other|OtherShape,
 *   passport?: null|Passport|PassportShape,
 * }
 */
final class Identification implements BaseModel
{
    /** @use SdkModel<IdentificationShape> */
    use SdkModel;

    /**
     * A method that can be used to verify the individual's identity.
     *
     * @var value-of<Method> $method
     */
    #[Required(enum: Method::class)]
    public string $method;

    /**
     * An identification number that can be used to verify the individual's identity, such as a social security number.
     */
    #[Required]
    public string $number;

    /**
     * Information about the United States driver's license used for identification. Required if `method` is equal to `drivers_license`.
     */
    #[Optional('drivers_license')]
    public ?DriversLicense $driversLicense;

    /**
     * Information about the identification document provided. Required if `method` is equal to `other`.
     */
    #[Optional]
    public ?Other $other;

    /**
     * Information about the passport used for identification. Required if `method` is equal to `passport`.
     */
    #[Optional]
    public ?Passport $passport;

    /**
     * `new Identification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Identification::with(method: ..., number: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Identification)->withMethod(...)->withNumber(...)
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
     *
     * @param Method|value-of<Method> $method
     * @param DriversLicense|DriversLicenseShape|null $driversLicense
     * @param Other|OtherShape|null $other
     * @param Passport|PassportShape|null $passport
     */
    public static function with(
        Method|string $method,
        string $number,
        DriversLicense|array|null $driversLicense = null,
        Other|array|null $other = null,
        Passport|array|null $passport = null,
    ): self {
        $self = new self;

        $self['method'] = $method;
        $self['number'] = $number;

        null !== $driversLicense && $self['driversLicense'] = $driversLicense;
        null !== $other && $self['other'] = $other;
        null !== $passport && $self['passport'] = $passport;

        return $self;
    }

    /**
     * A method that can be used to verify the individual's identity.
     *
     * @param Method|value-of<Method> $method
     */
    public function withMethod(Method|string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }

    /**
     * An identification number that can be used to verify the individual's identity, such as a social security number.
     */
    public function withNumber(string $number): self
    {
        $self = clone $this;
        $self['number'] = $number;

        return $self;
    }

    /**
     * Information about the United States driver's license used for identification. Required if `method` is equal to `drivers_license`.
     *
     * @param DriversLicense|DriversLicenseShape $driversLicense
     */
    public function withDriversLicense(
        DriversLicense|array $driversLicense
    ): self {
        $self = clone $this;
        $self['driversLicense'] = $driversLicense;

        return $self;
    }

    /**
     * Information about the identification document provided. Required if `method` is equal to `other`.
     *
     * @param Other|OtherShape $other
     */
    public function withOther(Other|array $other): self
    {
        $self = clone $this;
        $self['other'] = $other;

        return $self;
    }

    /**
     * Information about the passport used for identification. Required if `method` is equal to `passport`.
     *
     * @param Passport|PassportShape $passport
     */
    public function withPassport(Passport|array $passport): self
    {
        $self = clone $this;
        $self['passport'] = $passport;

        return $self;
    }
}
