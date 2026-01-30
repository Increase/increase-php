<?php

declare(strict_types=1);

namespace Increase\Accounts;

use Increase\Accounts\Account\Bank;
use Increase\Accounts\Account\Currency;
use Increase\Accounts\Account\Funding;
use Increase\Accounts\Account\Loan;
use Increase\Accounts\Account\Status;
use Increase\Accounts\Account\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Accounts are your bank accounts with Increase. They store money, receive transfers, and send payments. They earn interest and have depository insurance.
 *
 * @phpstan-import-type LoanShape from \Increase\Accounts\Account\Loan
 *
 * @phpstan-type AccountShape = array{
 *   id: string,
 *   accountRevenueRate: string|null,
 *   bank: Bank|value-of<Bank>,
 *   closedAt: \DateTimeInterface|null,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency|value-of<Currency>,
 *   entityID: string,
 *   funding: Funding|value-of<Funding>,
 *   idempotencyKey: string|null,
 *   informationalEntityID: string|null,
 *   interestAccrued: string,
 *   interestAccruedAt: string|null,
 *   interestRate: string,
 *   loan: null|Loan|LoanShape,
 *   name: string,
 *   programID: string,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class Account implements BaseModel
{
    /** @use SdkModel<AccountShape> */
    use SdkModel;

    /**
     * The Account identifier.
     */
    #[Required]
    public string $id;

    /**
     * The account revenue rate currently being earned on the account, as a string containing a decimal number. For example, a 1% account revenue rate would be represented as "0.01". Account revenue is a type of non-interest income accrued on the account.
     */
    #[Required('account_revenue_rate')]
    public ?string $accountRevenueRate;

    /**
     * The bank the Account is with.
     *
     * @var value-of<Bank> $bank
     */
    #[Required(enum: Bank::class)]
    public string $bank;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Account was closed.
     */
    #[Required('closed_at')]
    public ?\DateTimeInterface $closedAt;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Account was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the Account currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The identifier for the Entity the Account belongs to.
     */
    #[Required('entity_id')]
    public string $entityID;

    /**
     * Whether the Account is funded by a loan or by deposits.
     *
     * @var value-of<Funding> $funding
     */
    #[Required(enum: Funding::class)]
    public string $funding;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The identifier of an Entity that, while not owning the Account, is associated with its activity.
     */
    #[Required('informational_entity_id')]
    public ?string $informationalEntityID;

    /**
     * The interest accrued but not yet paid, expressed as a string containing a floating-point value.
     */
    #[Required('interest_accrued')]
    public string $interestAccrued;

    /**
     * The latest [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date on which interest was accrued.
     */
    #[Required('interest_accrued_at')]
    public ?string $interestAccruedAt;

    /**
     * The interest rate currently being earned on the account, as a string containing a decimal number. For example, a 1% interest rate would be represented as "0.01".
     */
    #[Required('interest_rate')]
    public string $interestRate;

    /**
     * The Account's loan-related information, if the Account is a loan account.
     */
    #[Required]
    public ?Loan $loan;

    /**
     * The name you choose for the Account.
     */
    #[Required]
    public string $name;

    /**
     * The identifier of the Program determining the compliance and commercial terms of this Account.
     */
    #[Required('program_id')]
    public string $programID;

    /**
     * The status of the Account.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `account`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new Account()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Account::with(
     *   id: ...,
     *   accountRevenueRate: ...,
     *   bank: ...,
     *   closedAt: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   entityID: ...,
     *   funding: ...,
     *   idempotencyKey: ...,
     *   informationalEntityID: ...,
     *   interestAccrued: ...,
     *   interestAccruedAt: ...,
     *   interestRate: ...,
     *   loan: ...,
     *   name: ...,
     *   programID: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Account)
     *   ->withID(...)
     *   ->withAccountRevenueRate(...)
     *   ->withBank(...)
     *   ->withClosedAt(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withEntityID(...)
     *   ->withFunding(...)
     *   ->withIdempotencyKey(...)
     *   ->withInformationalEntityID(...)
     *   ->withInterestAccrued(...)
     *   ->withInterestAccruedAt(...)
     *   ->withInterestRate(...)
     *   ->withLoan(...)
     *   ->withName(...)
     *   ->withProgramID(...)
     *   ->withStatus(...)
     *   ->withType(...)
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
     * @param Bank|value-of<Bank> $bank
     * @param Currency|value-of<Currency> $currency
     * @param Funding|value-of<Funding> $funding
     * @param Loan|LoanShape|null $loan
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        ?string $accountRevenueRate,
        Bank|string $bank,
        ?\DateTimeInterface $closedAt,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        string $entityID,
        Funding|string $funding,
        ?string $idempotencyKey,
        ?string $informationalEntityID,
        string $interestAccrued,
        ?string $interestAccruedAt,
        string $interestRate,
        Loan|array|null $loan,
        string $name,
        string $programID,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountRevenueRate'] = $accountRevenueRate;
        $self['bank'] = $bank;
        $self['closedAt'] = $closedAt;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['entityID'] = $entityID;
        $self['funding'] = $funding;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['informationalEntityID'] = $informationalEntityID;
        $self['interestAccrued'] = $interestAccrued;
        $self['interestAccruedAt'] = $interestAccruedAt;
        $self['interestRate'] = $interestRate;
        $self['loan'] = $loan;
        $self['name'] = $name;
        $self['programID'] = $programID;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Account identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The account revenue rate currently being earned on the account, as a string containing a decimal number. For example, a 1% account revenue rate would be represented as "0.01". Account revenue is a type of non-interest income accrued on the account.
     */
    public function withAccountRevenueRate(?string $accountRevenueRate): self
    {
        $self = clone $this;
        $self['accountRevenueRate'] = $accountRevenueRate;

        return $self;
    }

    /**
     * The bank the Account is with.
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
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Account was closed.
     */
    public function withClosedAt(?\DateTimeInterface $closedAt): self
    {
        $self = clone $this;
        $self['closedAt'] = $closedAt;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Account was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the Account currency.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The identifier for the Entity the Account belongs to.
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
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * The identifier of an Entity that, while not owning the Account, is associated with its activity.
     */
    public function withInformationalEntityID(
        ?string $informationalEntityID
    ): self {
        $self = clone $this;
        $self['informationalEntityID'] = $informationalEntityID;

        return $self;
    }

    /**
     * The interest accrued but not yet paid, expressed as a string containing a floating-point value.
     */
    public function withInterestAccrued(string $interestAccrued): self
    {
        $self = clone $this;
        $self['interestAccrued'] = $interestAccrued;

        return $self;
    }

    /**
     * The latest [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date on which interest was accrued.
     */
    public function withInterestAccruedAt(?string $interestAccruedAt): self
    {
        $self = clone $this;
        $self['interestAccruedAt'] = $interestAccruedAt;

        return $self;
    }

    /**
     * The interest rate currently being earned on the account, as a string containing a decimal number. For example, a 1% interest rate would be represented as "0.01".
     */
    public function withInterestRate(string $interestRate): self
    {
        $self = clone $this;
        $self['interestRate'] = $interestRate;

        return $self;
    }

    /**
     * The Account's loan-related information, if the Account is a loan account.
     *
     * @param Loan|LoanShape|null $loan
     */
    public function withLoan(Loan|array|null $loan): self
    {
        $self = clone $this;
        $self['loan'] = $loan;

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
     * The identifier of the Program determining the compliance and commercial terms of this Account.
     */
    public function withProgramID(string $programID): self
    {
        $self = clone $this;
        $self['programID'] = $programID;

        return $self;
    }

    /**
     * The status of the Account.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `account`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
