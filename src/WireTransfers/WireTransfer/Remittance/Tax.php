<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransfer\Remittance;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Internal Revenue Service (IRS) tax repayment information. Required if `category` is equal to `tax`.
 *
 * @phpstan-type TaxShape = array{
 *   date: string, identificationNumber: string, typeCode: string
 * }
 */
final class Tax implements BaseModel
{
    /** @use SdkModel<TaxShape> */
    use SdkModel;

    /**
     * The month and year the tax payment is for, in YYYY-MM-DD format. The day is ignored.
     */
    #[Required]
    public string $date;

    /**
     * The 9-digit Tax Identification Number (TIN) or Employer Identification Number (EIN).
     */
    #[Required('identification_number')]
    public string $identificationNumber;

    /**
     * The 5-character tax type code.
     */
    #[Required('type_code')]
    public string $typeCode;

    /**
     * `new Tax()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Tax::with(date: ..., identificationNumber: ..., typeCode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Tax)->withDate(...)->withIdentificationNumber(...)->withTypeCode(...)
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
        string $date,
        string $identificationNumber,
        string $typeCode
    ): self {
        $self = new self;

        $self['date'] = $date;
        $self['identificationNumber'] = $identificationNumber;
        $self['typeCode'] = $typeCode;

        return $self;
    }

    /**
     * The month and year the tax payment is for, in YYYY-MM-DD format. The day is ignored.
     */
    public function withDate(string $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }

    /**
     * The 9-digit Tax Identification Number (TIN) or Employer Identification Number (EIN).
     */
    public function withIdentificationNumber(string $identificationNumber): self
    {
        $self = clone $this;
        $self['identificationNumber'] = $identificationNumber;

        return $self;
    }

    /**
     * The 5-character tax type code.
     */
    public function withTypeCode(string $typeCode): self
    {
        $self = clone $this;
        $self['typeCode'] = $typeCode;

        return $self;
    }
}
