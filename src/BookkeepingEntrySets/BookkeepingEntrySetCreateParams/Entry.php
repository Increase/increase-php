<?php

declare(strict_types=1);

namespace Increase\BookkeepingEntrySets\BookkeepingEntrySetCreateParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type EntryShape = array{accountID: string, amount: int}
 */
final class Entry implements BaseModel
{
    /** @use SdkModel<EntryShape> */
    use SdkModel;

    /**
     * The identifier for the Bookkeeping Account impacted by this entry.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The entry amount in the minor unit of the account currency. For dollars, for example, this is cents. Debit entries have positive amounts; credit entries have negative amounts.
     */
    #[Required]
    public int $amount;

    /**
     * `new Entry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Entry::with(accountID: ..., amount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Entry)->withAccountID(...)->withAmount(...)
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
    public static function with(string $accountID, int $amount): self
    {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier for the Bookkeeping Account impacted by this entry.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The entry amount in the minor unit of the account currency. For dollars, for example, this is cents. Debit entries have positive amounts; credit entries have negative amounts.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }
}
