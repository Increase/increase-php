<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams\Joint\Individual\Identification;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Information about the United States driver's license used for identification. Required if `method` is equal to `drivers_license`.
 *
 * @phpstan-type DriversLicenseShape = array{
 *   expirationDate: string,
 *   fileID: string,
 *   state: string,
 *   backFileID?: string|null,
 * }
 */
final class DriversLicense implements BaseModel
{
    /** @use SdkModel<DriversLicenseShape> */
    use SdkModel;

    /**
     * The driver's license's expiration date in YYYY-MM-DD format.
     */
    #[Required('expiration_date')]
    public string $expirationDate;

    /**
     * The identifier of the File containing the front of the driver's license.
     */
    #[Required('file_id')]
    public string $fileID;

    /**
     * The state that issued the provided driver's license.
     */
    #[Required]
    public string $state;

    /**
     * The identifier of the File containing the back of the driver's license.
     */
    #[Optional('back_file_id')]
    public ?string $backFileID;

    /**
     * `new DriversLicense()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DriversLicense::with(expirationDate: ..., fileID: ..., state: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DriversLicense)->withExpirationDate(...)->withFileID(...)->withState(...)
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
        string $expirationDate,
        string $fileID,
        string $state,
        ?string $backFileID = null,
    ): self {
        $self = new self;

        $self['expirationDate'] = $expirationDate;
        $self['fileID'] = $fileID;
        $self['state'] = $state;

        null !== $backFileID && $self['backFileID'] = $backFileID;

        return $self;
    }

    /**
     * The driver's license's expiration date in YYYY-MM-DD format.
     */
    public function withExpirationDate(string $expirationDate): self
    {
        $self = clone $this;
        $self['expirationDate'] = $expirationDate;

        return $self;
    }

    /**
     * The identifier of the File containing the front of the driver's license.
     */
    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }

    /**
     * The state that issued the provided driver's license.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The identifier of the File containing the back of the driver's license.
     */
    public function withBackFileID(string $backFileID): self
    {
        $self = clone $this;
        $self['backFileID'] = $backFileID;

        return $self;
    }
}
