<?php

declare(strict_types=1);

namespace Increase\Programs;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Programs\Program\Bank;
use Increase\Programs\Program\Type;

/**
 * Programs determine the compliance and commercial terms of Accounts. By default, you have a Commercial Banking program for managing your own funds. If you are lending or managing funds on behalf of your customers, or otherwise engaged in regulated activity, we will work together to create additional Programs for you.
 *
 * @phpstan-type ProgramShape = array{
 *   id: string,
 *   bank: Bank|value-of<Bank>,
 *   billingAccountID: string|null,
 *   createdAt: \DateTimeInterface,
 *   defaultDigitalCardProfileID: string|null,
 *   interestRate: string,
 *   name: string,
 *   type: Type|value-of<Type>,
 *   updatedAt: \DateTimeInterface,
 * }
 */
final class Program implements BaseModel
{
    /** @use SdkModel<ProgramShape> */
    use SdkModel;

    /**
     * The Program identifier.
     */
    #[Required]
    public string $id;

    /**
     * The Bank the Program is with.
     *
     * @var value-of<Bank> $bank
     */
    #[Required(enum: Bank::class)]
    public string $bank;

    /**
     * The Program billing account.
     */
    #[Required('billing_account_id')]
    public ?string $billingAccountID;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Program was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The default configuration for digital cards attached to this Program.
     */
    #[Required('default_digital_card_profile_id')]
    public ?string $defaultDigitalCardProfileID;

    /**
     * The Interest Rate currently being earned on the accounts in this program, as a string containing a decimal number. For example, a 1% interest rate would be represented as "0.01".
     */
    #[Required('interest_rate')]
    public string $interestRate;

    /**
     * The name of the Program.
     */
    #[Required]
    public string $name;

    /**
     * A constant representing the object's type. For this resource it will always be `program`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Program was last updated.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * `new Program()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Program::with(
     *   id: ...,
     *   bank: ...,
     *   billingAccountID: ...,
     *   createdAt: ...,
     *   defaultDigitalCardProfileID: ...,
     *   interestRate: ...,
     *   name: ...,
     *   type: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Program)
     *   ->withID(...)
     *   ->withBank(...)
     *   ->withBillingAccountID(...)
     *   ->withCreatedAt(...)
     *   ->withDefaultDigitalCardProfileID(...)
     *   ->withInterestRate(...)
     *   ->withName(...)
     *   ->withType(...)
     *   ->withUpdatedAt(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        Bank|string $bank,
        ?string $billingAccountID,
        \DateTimeInterface $createdAt,
        ?string $defaultDigitalCardProfileID,
        string $interestRate,
        string $name,
        Type|string $type,
        \DateTimeInterface $updatedAt,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['bank'] = $bank;
        $self['billingAccountID'] = $billingAccountID;
        $self['createdAt'] = $createdAt;
        $self['defaultDigitalCardProfileID'] = $defaultDigitalCardProfileID;
        $self['interestRate'] = $interestRate;
        $self['name'] = $name;
        $self['type'] = $type;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * The Program identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The Bank the Program is with.
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
     * The Program billing account.
     */
    public function withBillingAccountID(?string $billingAccountID): self
    {
        $self = clone $this;
        $self['billingAccountID'] = $billingAccountID;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Program was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The default configuration for digital cards attached to this Program.
     */
    public function withDefaultDigitalCardProfileID(
        ?string $defaultDigitalCardProfileID
    ): self {
        $self = clone $this;
        $self['defaultDigitalCardProfileID'] = $defaultDigitalCardProfileID;

        return $self;
    }

    /**
     * The Interest Rate currently being earned on the accounts in this program, as a string containing a decimal number. For example, a 1% interest rate would be represented as "0.01".
     */
    public function withInterestRate(string $interestRate): self
    {
        $self = clone $this;
        $self['interestRate'] = $interestRate;

        return $self;
    }

    /**
     * The name of the Program.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `program`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Program was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
