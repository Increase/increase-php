<?php

declare(strict_types=1);

namespace Increase\Simulations\Exports\ExportCreateParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Options for the created export. Required if `category` is equal to `form_1099_int`.
 *
 * @phpstan-type Form1099IntShape = array{accountID: string}
 */
final class Form1099Int implements BaseModel
{
    /** @use SdkModel<Form1099IntShape> */
    use SdkModel;

    /**
     * The identifier of the Account the tax document is for.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * `new Form1099Int()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Form1099Int::with(accountID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Form1099Int)->withAccountID(...)
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
    public static function with(string $accountID): self
    {
        $self = new self;

        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The identifier of the Account the tax document is for.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }
}
