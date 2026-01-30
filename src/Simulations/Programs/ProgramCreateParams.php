<?php

declare(strict_types=1);

namespace Increase\Simulations\Programs;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\Programs\ProgramCreateParams\Bank;

/**
 * Simulates a [Program](#programs) being created in your group. By default, your group has one program called Commercial Banking. Note that when your group operates more than one program, `program_id` is a required field when creating accounts.
 *
 * @see Increase\Services\Simulations\ProgramsService::create()
 *
 * @phpstan-type ProgramCreateParamsShape = array{
 *   name: string,
 *   bank?: null|Bank|value-of<Bank>,
 *   lendingMaximumExtendableCredit?: int|null,
 *   reserveAccountID?: string|null,
 * }
 */
final class ProgramCreateParams implements BaseModel
{
    /** @use SdkModel<ProgramCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The name of the program being added.
     */
    #[Required]
    public string $name;

    /**
     * The bank for the program's accounts, defaults to First Internet Bank.
     *
     * @var value-of<Bank>|null $bank
     */
    #[Optional(enum: Bank::class)]
    public ?string $bank;

    /**
     * The maximum extendable credit of the program being added.
     */
    #[Optional('lending_maximum_extendable_credit')]
    public ?int $lendingMaximumExtendableCredit;

    /**
     * The identifier of the Account the Program should be added to is for.
     */
    #[Optional('reserve_account_id')]
    public ?string $reserveAccountID;

    /**
     * `new ProgramCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProgramCreateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProgramCreateParams)->withName(...)
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
     *
     * @param Bank|value-of<Bank>|null $bank
     */
    public static function with(
        string $name,
        Bank|string|null $bank = null,
        ?int $lendingMaximumExtendableCredit = null,
        ?string $reserveAccountID = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $bank && $self['bank'] = $bank;
        null !== $lendingMaximumExtendableCredit && $self['lendingMaximumExtendableCredit'] = $lendingMaximumExtendableCredit;
        null !== $reserveAccountID && $self['reserveAccountID'] = $reserveAccountID;

        return $self;
    }

    /**
     * The name of the program being added.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The bank for the program's accounts, defaults to First Internet Bank.
     *
     * @param Bank|value-of<Bank> $bank
     */
    public function withBank(Bank|string $bank): self
    {
        $self = clone $this;
        $self['bank'] = $bank;

        return $self;
    }

    /**
     * The maximum extendable credit of the program being added.
     */
    public function withLendingMaximumExtendableCredit(
        int $lendingMaximumExtendableCredit
    ): self {
        $self = clone $this;
        $self['lendingMaximumExtendableCredit'] = $lendingMaximumExtendableCredit;

        return $self;
    }

    /**
     * The identifier of the Account the Program should be added to is for.
     */
    public function withReserveAccountID(string $reserveAccountID): self
    {
        $self = clone $this;
        $self['reserveAccountID'] = $reserveAccountID;

        return $self;
    }
}
