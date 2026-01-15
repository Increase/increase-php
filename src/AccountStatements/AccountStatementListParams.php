<?php

declare(strict_types=1);

namespace Increase\AccountStatements;

use Increase\AccountStatements\AccountStatementListParams\StatementPeriodStart;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * List Account Statements.
 *
 * @see Increase\Services\AccountStatementsService::list()
 *
 * @phpstan-import-type StatementPeriodStartShape from \Increase\AccountStatements\AccountStatementListParams\StatementPeriodStart
 *
 * @phpstan-type AccountStatementListParamsShape = array{
 *   accountID?: string|null,
 *   cursor?: string|null,
 *   limit?: int|null,
 *   statementPeriodStart?: null|StatementPeriodStart|StatementPeriodStartShape,
 * }
 */
final class AccountStatementListParams implements BaseModel
{
    /** @use SdkModel<AccountStatementListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter Account Statements to those belonging to the specified Account.
     */
    #[Optional]
    public ?string $accountID;

    /**
     * Return the page of entries after this one.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     */
    #[Optional]
    public ?int $limit;

    #[Optional]
    public ?StatementPeriodStart $statementPeriodStart;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param StatementPeriodStart|StatementPeriodStartShape|null $statementPeriodStart
     */
    public static function with(
        ?string $accountID = null,
        ?string $cursor = null,
        ?int $limit = null,
        StatementPeriodStart|array|null $statementPeriodStart = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $statementPeriodStart && $self['statementPeriodStart'] = $statementPeriodStart;

        return $self;
    }

    /**
     * Filter Account Statements to those belonging to the specified Account.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Return the page of entries after this one.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * @param StatementPeriodStart|StatementPeriodStartShape $statementPeriodStart
     */
    public function withStatementPeriodStart(
        StatementPeriodStart|array $statementPeriodStart
    ): self {
        $self = clone $this;
        $self['statementPeriodStart'] = $statementPeriodStart;

        return $self;
    }
}
