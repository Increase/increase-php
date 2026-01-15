<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams\NaturalPerson\Identification;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Information about the identification document provided. Required if `method` is equal to `other`.
 *
 * @phpstan-type OtherShape = array{
 *   country: string,
 *   description: string,
 *   fileID: string,
 *   backFileID?: string|null,
 *   expirationDate?: string|null,
 * }
 */
final class Other implements BaseModel
{
    /** @use SdkModel<OtherShape> */
    use SdkModel;

    /**
     * The two-character ISO 3166-1 code representing the country that issued the document (e.g., `US`).
     */
    #[Required]
    public string $country;

    /**
     * A description of the document submitted.
     */
    #[Required]
    public string $description;

    /**
     * The identifier of the File containing the front of the document.
     */
    #[Required('file_id')]
    public string $fileID;

    /**
     * The identifier of the File containing the back of the document. Not every document has a reverse side.
     */
    #[Optional('back_file_id')]
    public ?string $backFileID;

    /**
     * The document's expiration date in YYYY-MM-DD format.
     */
    #[Optional('expiration_date')]
    public ?string $expirationDate;

    /**
     * `new Other()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Other::with(country: ..., description: ..., fileID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Other)->withCountry(...)->withDescription(...)->withFileID(...)
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
        string $description,
        string $fileID,
        ?string $backFileID = null,
        ?string $expirationDate = null,
    ): self {
        $self = new self;

        $self['country'] = $country;
        $self['description'] = $description;
        $self['fileID'] = $fileID;

        null !== $backFileID && $self['backFileID'] = $backFileID;
        null !== $expirationDate && $self['expirationDate'] = $expirationDate;

        return $self;
    }

    /**
     * The two-character ISO 3166-1 code representing the country that issued the document (e.g., `US`).
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * A description of the document submitted.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The identifier of the File containing the front of the document.
     */
    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }

    /**
     * The identifier of the File containing the back of the document. Not every document has a reverse side.
     */
    public function withBackFileID(string $backFileID): self
    {
        $self = clone $this;
        $self['backFileID'] = $backFileID;

        return $self;
    }

    /**
     * The document's expiration date in YYYY-MM-DD format.
     */
    public function withExpirationDate(string $expirationDate): self
    {
        $self = clone $this;
        $self['expirationDate'] = $expirationDate;

        return $self;
    }
}
