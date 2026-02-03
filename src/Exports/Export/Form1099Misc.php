<?php

declare(strict_types=1);

namespace Increase\Exports\Export;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details of the Form 1099-MISC export. This field will be present when the `category` is equal to `form_1099_misc`.
 *
 * @phpstan-type Form1099MiscShape = array{
 *   accountID: string, corrected: bool, year: int
 * }
 */
final class Form1099Misc implements BaseModel
{
    /** @use SdkModel<Form1099MiscShape> */
    use SdkModel;

    /**
     * The Account the tax form is for.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * Whether the tax form is a corrected form.
     */
    #[Required]
    public bool $corrected;

    /**
     * The tax year for the tax form.
     */
    #[Required]
    public int $year;

    /**
     * `new Form1099Misc()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Form1099Misc::with(accountID: ..., corrected: ..., year: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Form1099Misc)->withAccountID(...)->withCorrected(...)->withYear(...)
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
        string $accountID,
        bool $corrected,
        int $year
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['corrected'] = $corrected;
        $self['year'] = $year;

        return $self;
    }

    /**
     * The Account the tax form is for.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Whether the tax form is a corrected form.
     */
    public function withCorrected(bool $corrected): self
    {
        $self = clone $this;
        $self['corrected'] = $corrected;

        return $self;
    }

    /**
     * The tax year for the tax form.
     */
    public function withYear(int $year): self
    {
        $self = clone $this;
        $self['year'] = $year;

        return $self;
    }
}
