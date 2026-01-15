<?php

declare(strict_types=1);

namespace Increase\BookkeepingEntrySets\BookkeepingEntrySet;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type EntryShape = array{id: string, accountID: string, amount: int}
 */
final class Entry implements BaseModel
{
    /** @use SdkModel<EntryShape> */
    use SdkModel;

    /**
     * The entry identifier.
     */
    #[Required]
    public string $id;

    /**
     * The bookkeeping account impacted by the entry.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The amount of the entry in minor units.
     */
    #[Required]
    public int $amount;

    /**
     * `new Entry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Entry::with(id: ..., accountID: ..., amount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Entry)->withID(...)->withAccountID(...)->withAmount(...)
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
        string $id,
        string $accountID,
        int $amount
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The entry identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The bookkeeping account impacted by the entry.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The amount of the entry in minor units.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }
}
