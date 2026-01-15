<?php

declare(strict_types=1);

namespace Increase\BookkeepingAccounts;

use Increase\BookkeepingAccounts\BookkeepingAccountCreateParams\ComplianceCategory;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a Bookkeeping Account.
 *
 * @see Increase\Services\BookkeepingAccountsService::create()
 *
 * @phpstan-type BookkeepingAccountCreateParamsShape = array{
 *   name: string,
 *   accountID?: string|null,
 *   complianceCategory?: null|ComplianceCategory|value-of<ComplianceCategory>,
 *   entityID?: string|null,
 * }
 */
final class BookkeepingAccountCreateParams implements BaseModel
{
    /** @use SdkModel<BookkeepingAccountCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The name you choose for the account.
     */
    #[Required]
    public string $name;

    /**
     * The account, if `compliance_category` is `commingled_cash`.
     */
    #[Optional('account_id')]
    public ?string $accountID;

    /**
     * The account compliance category.
     *
     * @var value-of<ComplianceCategory>|null $complianceCategory
     */
    #[Optional('compliance_category', enum: ComplianceCategory::class)]
    public ?string $complianceCategory;

    /**
     * The entity, if `compliance_category` is `customer_balance`.
     */
    #[Optional('entity_id')]
    public ?string $entityID;

    /**
     * `new BookkeepingAccountCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BookkeepingAccountCreateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BookkeepingAccountCreateParams)->withName(...)
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
     */
    public static function with(
        string $name,
        ?string $accountID = null,
        ComplianceCategory|string|null $complianceCategory = null,
        ?string $entityID = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $complianceCategory && $self['complianceCategory'] = $complianceCategory;
        null !== $entityID && $self['entityID'] = $entityID;

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
     * The account, if `compliance_category` is `commingled_cash`.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The account compliance category.
     *
     * @param ComplianceCategory|value-of<ComplianceCategory> $complianceCategory
     */
    public function withComplianceCategory(
        ComplianceCategory|string $complianceCategory
    ): self {
        $self = clone $this;
        $self['complianceCategory'] = $complianceCategory;

        return $self;
    }

    /**
     * The entity, if `compliance_category` is `customer_balance`.
     */
    public function withEntityID(string $entityID): self
    {
        $self = clone $this;
        $self['entityID'] = $entityID;

        return $self;
    }
}
