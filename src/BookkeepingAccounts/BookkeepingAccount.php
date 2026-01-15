<?php

declare(strict_types=1);

namespace Increase\BookkeepingAccounts;

use Increase\BookkeepingAccounts\BookkeepingAccount\ComplianceCategory;
use Increase\BookkeepingAccounts\BookkeepingAccount\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Accounts are T-accounts. They can store accounting entries. Your compliance setup might require annotating money movements using this API. Learn more in our [guide to Bookkeeping](https://increase.com/documentation/bookkeeping#bookkeeping).
 *
 * @phpstan-type BookkeepingAccountShape = array{
 *   id: string,
 *   accountID: string|null,
 *   complianceCategory: null|ComplianceCategory|value-of<ComplianceCategory>,
 *   entityID: string|null,
 *   idempotencyKey: string|null,
 *   name: string,
 *   type: Type|value-of<Type>,
 * }
 */
final class BookkeepingAccount implements BaseModel
{
    /** @use SdkModel<BookkeepingAccountShape> */
    use SdkModel;

    /**
     * The account identifier.
     */
    #[Required]
    public string $id;

    /**
     * The API Account associated with this bookkeeping account.
     */
    #[Required('account_id')]
    public ?string $accountID;

    /**
     * The compliance category of the account.
     *
     * @var value-of<ComplianceCategory>|null $complianceCategory
     */
    #[Required('compliance_category', enum: ComplianceCategory::class)]
    public ?string $complianceCategory;

    /**
     * The Entity associated with this bookkeeping account.
     */
    #[Required('entity_id')]
    public ?string $entityID;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The name you choose for the account.
     */
    #[Required]
    public string $name;

    /**
     * A constant representing the object's type. For this resource it will always be `bookkeeping_account`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new BookkeepingAccount()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BookkeepingAccount::with(
     *   id: ...,
     *   accountID: ...,
     *   complianceCategory: ...,
     *   entityID: ...,
     *   idempotencyKey: ...,
     *   name: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BookkeepingAccount)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withComplianceCategory(...)
     *   ->withEntityID(...)
     *   ->withIdempotencyKey(...)
     *   ->withName(...)
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
     * @param ComplianceCategory|value-of<ComplianceCategory>|null $complianceCategory
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        ?string $accountID,
        ComplianceCategory|string|null $complianceCategory,
        ?string $entityID,
        ?string $idempotencyKey,
        string $name,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['complianceCategory'] = $complianceCategory;
        $self['entityID'] = $entityID;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['name'] = $name;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The account identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The API Account associated with this bookkeeping account.
     */
    public function withAccountID(?string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The compliance category of the account.
     *
     * @param ComplianceCategory|value-of<ComplianceCategory>|null $complianceCategory
     */
    public function withComplianceCategory(
        ComplianceCategory|string|null $complianceCategory
    ): self {
        $self = clone $this;
        $self['complianceCategory'] = $complianceCategory;

        return $self;
    }

    /**
     * The Entity associated with this bookkeeping account.
     */
    public function withEntityID(?string $entityID): self
    {
        $self = clone $this;
        $self['entityID'] = $entityID;

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
     * The name you choose for the account.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `bookkeeping_account`.
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
