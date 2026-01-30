<?php

declare(strict_types=1);

namespace Increase\Accounts;

use Increase\Accounts\AccountCreateParams\Funding;
use Increase\Accounts\AccountCreateParams\Loan;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create an Account.
 *
 * @see Increase\Services\AccountsService::create()
 *
 * @phpstan-import-type LoanShape from \Increase\Accounts\AccountCreateParams\Loan
 *
 * @phpstan-type AccountCreateParamsShape = array{
 *   name: string,
 *   entityID?: string|null,
 *   funding?: null|Funding|value-of<Funding>,
 *   informationalEntityID?: string|null,
 *   loan?: null|Loan|LoanShape,
 *   programID?: string|null,
 * }
 */
final class AccountCreateParams implements BaseModel
{
    /** @use SdkModel<AccountCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The name you choose for the Account.
     */
    #[Required]
    public string $name;

    /**
     * The identifier for the Entity that will own the Account.
     */
    #[Optional('entity_id')]
    public ?string $entityID;

    /**
     * Whether the Account is funded by a loan or by deposits.
     *
     * @var value-of<Funding>|null $funding
     */
    #[Optional(enum: Funding::class)]
    public ?string $funding;

    /**
     * The identifier of an Entity that, while not owning the Account, is associated with its activity. This is generally the beneficiary of the funds.
     */
    #[Optional('informational_entity_id')]
    public ?string $informationalEntityID;

    /**
     * The loan details for the account.
     */
    #[Optional]
    public ?Loan $loan;

    /**
     * The identifier for the Program that this Account falls under. Required if you operate more than one Program.
     */
    #[Optional('program_id')]
    public ?string $programID;

    /**
     * `new AccountCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountCreateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountCreateParams)->withName(...)
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
     * @param Funding|value-of<Funding>|null $funding
     * @param Loan|LoanShape|null $loan
     */
    public static function with(
        string $name,
        ?string $entityID = null,
        Funding|string|null $funding = null,
        ?string $informationalEntityID = null,
        Loan|array|null $loan = null,
        ?string $programID = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $entityID && $self['entityID'] = $entityID;
        null !== $funding && $self['funding'] = $funding;
        null !== $informationalEntityID && $self['informationalEntityID'] = $informationalEntityID;
        null !== $loan && $self['loan'] = $loan;
        null !== $programID && $self['programID'] = $programID;

        return $self;
    }

    /**
     * The name you choose for the Account.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The identifier for the Entity that will own the Account.
     */
    public function withEntityID(string $entityID): self
    {
        $self = clone $this;
        $self['entityID'] = $entityID;

        return $self;
    }

    /**
     * Whether the Account is funded by a loan or by deposits.
     *
     * @param Funding|value-of<Funding> $funding
     */
    public function withFunding(Funding|string $funding): self
    {
        $self = clone $this;
        $self['funding'] = $funding;

        return $self;
    }

    /**
     * The identifier of an Entity that, while not owning the Account, is associated with its activity. This is generally the beneficiary of the funds.
     */
    public function withInformationalEntityID(
        string $informationalEntityID
    ): self {
        $self = clone $this;
        $self['informationalEntityID'] = $informationalEntityID;

        return $self;
    }

    /**
     * The loan details for the account.
     *
     * @param Loan|LoanShape $loan
     */
    public function withLoan(Loan|array $loan): self
    {
        $self = clone $this;
        $self['loan'] = $loan;

        return $self;
    }

    /**
     * The identifier for the Program that this Account falls under. Required if you operate more than one Program.
     */
    public function withProgramID(string $programID): self
    {
        $self = clone $this;
        $self['programID'] = $programID;

        return $self;
    }
}
