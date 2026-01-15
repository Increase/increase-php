<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Options for the created export. Required if `category` is equal to `account_verification_letter`.
 *
 * @phpstan-type AccountVerificationLetterShape = array{
 *   accountNumberID: string, balanceDate?: string|null
 * }
 */
final class AccountVerificationLetter implements BaseModel
{
    /** @use SdkModel<AccountVerificationLetterShape> */
    use SdkModel;

    /**
     * The Account Number to create a letter for.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

    /**
     * The date of the balance to include in the letter. Defaults to the current date.
     */
    #[Optional('balance_date')]
    public ?string $balanceDate;

    /**
     * `new AccountVerificationLetter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountVerificationLetter::with(accountNumberID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountVerificationLetter)->withAccountNumberID(...)
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
        string $accountNumberID,
        ?string $balanceDate = null
    ): self {
        $self = new self;

        $self['accountNumberID'] = $accountNumberID;

        null !== $balanceDate && $self['balanceDate'] = $balanceDate;

        return $self;
    }

    /**
     * The Account Number to create a letter for.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

        return $self;
    }

    /**
     * The date of the balance to include in the letter. Defaults to the current date.
     */
    public function withBalanceDate(string $balanceDate): self
    {
        $self = clone $this;
        $self['balanceDate'] = $balanceDate;

        return $self;
    }
}
