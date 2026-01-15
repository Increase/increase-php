<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams\Trust\Grantor\Identification;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Information about the passport used for identification. Required if `method` is equal to `passport`.
 *
 * @phpstan-type PassportShape = array{
 *   country: string, expirationDate: string, fileID: string
 * }
 */
final class Passport implements BaseModel
{
    /** @use SdkModel<PassportShape> */
    use SdkModel;

    /**
     * The two-character ISO 3166-1 code representing the country that issued the passport (e.g., `US`).
     */
    #[Required]
    public string $country;

    /**
     * The passport's expiration date in YYYY-MM-DD format.
     */
    #[Required('expiration_date')]
    public string $expirationDate;

    /**
     * The identifier of the File containing the passport.
     */
    #[Required('file_id')]
    public string $fileID;

    /**
     * `new Passport()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Passport::with(country: ..., expirationDate: ..., fileID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Passport)->withCountry(...)->withExpirationDate(...)->withFileID(...)
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
        string $country,
        string $expirationDate,
        string $fileID
    ): self {
        $self = new self;

        $self['country'] = $country;
        $self['expirationDate'] = $expirationDate;
        $self['fileID'] = $fileID;

        return $self;
    }

    /**
     * The two-character ISO 3166-1 code representing the country that issued the passport (e.g., `US`).
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * The passport's expiration date in YYYY-MM-DD format.
     */
    public function withExpirationDate(string $expirationDate): self
    {
        $self = clone $this;
        $self['expirationDate'] = $expirationDate;

        return $self;
    }

    /**
     * The identifier of the File containing the passport.
     */
    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }
}
