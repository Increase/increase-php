<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Options for the created export. Required if `category` is equal to `funding_instructions`.
 *
 * @phpstan-type FundingInstructionsShape = array{accountNumberID: string}
 */
final class FundingInstructions implements BaseModel
{
    /** @use SdkModel<FundingInstructionsShape> */
    use SdkModel;

    /**
     * The Account Number to create funding instructions for.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * `new FundingInstructions()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FundingInstructions::with(accountNumberID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FundingInstructions)->withAccountNumberID(...)
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
    public static function with(string $accountNumberID): self
    {
        $self = new self;

        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * The Account Number to create funding instructions for.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }
}
