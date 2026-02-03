<?php

declare(strict_types=1);

namespace Increase\Exports\Export;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details of the Form 1099-INT export. This field will be present when the `category` is equal to `form_1099_int`.
 *
 * @phpstan-type Form1099IntShape = array{
 *   accountID: string, corrected: bool, description: string, year: int
 * }
 */
final class Form1099Int implements BaseModel
{
    /** @use SdkModel<Form1099IntShape> */
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
     * A description of the tax form.
     */
    #[Required]
    public string $description;

    /**
     * The tax year for the tax form.
     */
    #[Required]
    public int $year;

    /**
     * `new Form1099Int()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Form1099Int::with(accountID: ..., corrected: ..., description: ..., year: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Form1099Int)
     *   ->withAccountID(...)
     *   ->withCorrected(...)
     *   ->withDescription(...)
     *   ->withYear(...)
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
        string $description,
        int $year
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['corrected'] = $corrected;
        $self['description'] = $description;
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
     * A description of the tax form.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

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
