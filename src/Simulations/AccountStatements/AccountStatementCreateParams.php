<?php

declare(strict_types=1);

namespace Increase\Simulations\AccountStatements;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Simulates an [Account Statement](#account-statements) being created for an account. In production, Account Statements are generated once per month.
 *
 * @see Increase\Services\Simulations\AccountStatementsService::create()
 *
 * @phpstan-type AccountStatementCreateParamsShape = array{accountID: string}
 */
final class AccountStatementCreateParams implements BaseModel
{
    /** @use SdkModel<AccountStatementCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Account the statement is for.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * `new AccountStatementCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountStatementCreateParams::with(accountID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountStatementCreateParams)->withAccountID(...)
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
     * The identifier of the Account the statement is for.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }
}
