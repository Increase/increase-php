<?php

declare(strict_types=1);

namespace Increase\Exports;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Exports\Export\AccountStatementBai2;
use Increase\Exports\Export\AccountStatementOfx;
use Increase\Exports\Export\AccountVerificationLetter;
use Increase\Exports\Export\BalanceCsv;
use Increase\Exports\Export\BookkeepingAccountBalanceCsv;
use Increase\Exports\Export\Category;
use Increase\Exports\Export\DashboardTableCsv;
use Increase\Exports\Export\EntityCsv;
use Increase\Exports\Export\Form1099Int;
use Increase\Exports\Export\Form1099Misc;
use Increase\Exports\Export\FundingInstructions;
use Increase\Exports\Export\Result;
use Increase\Exports\Export\Status;
use Increase\Exports\Export\TransactionCsv;
use Increase\Exports\Export\Type;
use Increase\Exports\Export\VendorCsv;
use Increase\Exports\Export\VoidedCheck;

/**
 * Exports are generated files. Some exports can contain a lot of data, like a CSV of your transactions. Others can be a single document, like a tax form. Since they can take a while, they are generated asynchronously. We send a webhook when they are ready. For more information, please read our [Exports documentation](https://increase.com/documentation/exports).
 *
 * @phpstan-import-type AccountStatementBai2Shape from \Increase\Exports\Export\AccountStatementBai2
 * @phpstan-import-type AccountStatementOfxShape from \Increase\Exports\Export\AccountStatementOfx
 * @phpstan-import-type AccountVerificationLetterShape from \Increase\Exports\Export\AccountVerificationLetter
 * @phpstan-import-type BalanceCsvShape from \Increase\Exports\Export\BalanceCsv
 * @phpstan-import-type BookkeepingAccountBalanceCsvShape from \Increase\Exports\Export\BookkeepingAccountBalanceCsv
 * @phpstan-import-type DashboardTableCsvShape from \Increase\Exports\Export\DashboardTableCsv
 * @phpstan-import-type EntityCsvShape from \Increase\Exports\Export\EntityCsv
 * @phpstan-import-type Form1099IntShape from \Increase\Exports\Export\Form1099Int
 * @phpstan-import-type Form1099MiscShape from \Increase\Exports\Export\Form1099Misc
 * @phpstan-import-type FundingInstructionsShape from \Increase\Exports\Export\FundingInstructions
 * @phpstan-import-type ResultShape from \Increase\Exports\Export\Result
 * @phpstan-import-type TransactionCsvShape from \Increase\Exports\Export\TransactionCsv
 * @phpstan-import-type VendorCsvShape from \Increase\Exports\Export\VendorCsv
 * @phpstan-import-type VoidedCheckShape from \Increase\Exports\Export\VoidedCheck
 *
 * @phpstan-type ExportShape = array{
 *   id: string,
 *   accountStatementBai2: null|AccountStatementBai2|AccountStatementBai2Shape,
 *   accountStatementOfx: null|AccountStatementOfx|AccountStatementOfxShape,
 *   accountVerificationLetter: null|AccountVerificationLetter|AccountVerificationLetterShape,
 *   balanceCsv: null|BalanceCsv|BalanceCsvShape,
 *   bookkeepingAccountBalanceCsv: null|BookkeepingAccountBalanceCsv|BookkeepingAccountBalanceCsvShape,
 *   category: Category|value-of<Category>,
 *   createdAt: \DateTimeInterface,
 *   dashboardTableCsv: null|DashboardTableCsv|DashboardTableCsvShape,
 *   entityCsv: null|EntityCsv|EntityCsvShape,
 *   form1099Int: null|Form1099Int|Form1099IntShape,
 *   form1099Misc: null|Form1099Misc|Form1099MiscShape,
 *   fundingInstructions: null|FundingInstructions|FundingInstructionsShape,
 *   idempotencyKey: string|null,
 *   result: null|Result|ResultShape,
 *   status: Status|value-of<Status>,
 *   transactionCsv: null|TransactionCsv|TransactionCsvShape,
 *   type: Type|value-of<Type>,
 *   vendorCsv: null|VendorCsv|VendorCsvShape,
 *   voidedCheck: null|VoidedCheck|VoidedCheckShape,
 * }
 */
final class Export implements BaseModel
{
    /** @use SdkModel<ExportShape> */
    use SdkModel;

    /**
     * The Export identifier.
     */
    #[Required]
    public string $id;

    /**
     * Details of the account statement BAI2 export. This field will be present when the `category` is equal to `account_statement_bai2`.
     */
    #[Required('account_statement_bai2')]
    public ?AccountStatementBai2 $accountStatementBai2;

    /**
     * Details of the account statement OFX export. This field will be present when the `category` is equal to `account_statement_ofx`.
     */
    #[Required('account_statement_ofx')]
    public ?AccountStatementOfx $accountStatementOfx;

    /**
     * Details of the account verification letter export. This field will be present when the `category` is equal to `account_verification_letter`.
     */
    #[Required('account_verification_letter')]
    public ?AccountVerificationLetter $accountVerificationLetter;

    /**
     * Details of the balance CSV export. This field will be present when the `category` is equal to `balance_csv`.
     */
    #[Required('balance_csv')]
    public ?BalanceCsv $balanceCsv;

    /**
     * Details of the bookkeeping account balance CSV export. This field will be present when the `category` is equal to `bookkeeping_account_balance_csv`.
     */
    #[Required('bookkeeping_account_balance_csv')]
    public ?BookkeepingAccountBalanceCsv $bookkeepingAccountBalanceCsv;

    /**
     * The category of the Export. We may add additional possible values for this enum over time; your application should be able to handle that gracefully.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * The time the Export was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Details of the dashboard table CSV export. This field will be present when the `category` is equal to `dashboard_table_csv`.
     */
    #[Required('dashboard_table_csv')]
    public ?DashboardTableCsv $dashboardTableCsv;

    /**
     * Details of the entity CSV export. This field will be present when the `category` is equal to `entity_csv`.
     */
    #[Required('entity_csv')]
    public ?EntityCsv $entityCsv;

    /**
     * Details of the Form 1099-INT export. This field will be present when the `category` is equal to `form_1099_int`.
     */
    #[Required('form_1099_int')]
    public ?Form1099Int $form1099Int;

    /**
     * Details of the Form 1099-MISC export. This field will be present when the `category` is equal to `form_1099_misc`.
     */
    #[Required('form_1099_misc')]
    public ?Form1099Misc $form1099Misc;

    /**
     * Details of the funding instructions export. This field will be present when the `category` is equal to `funding_instructions`.
     */
    #[Required('funding_instructions')]
    public ?FundingInstructions $fundingInstructions;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The result of the Export. This will be present when the Export's status transitions to `complete`.
     */
    #[Required]
    public ?Result $result;

    /**
     * The status of the Export.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Details of the transaction CSV export. This field will be present when the `category` is equal to `transaction_csv`.
     */
    #[Required('transaction_csv')]
    public ?TransactionCsv $transactionCsv;

    /**
     * A constant representing the object's type. For this resource it will always be `export`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Details of the vendor CSV export. This field will be present when the `category` is equal to `vendor_csv`.
     */
    #[Required('vendor_csv')]
    public ?VendorCsv $vendorCsv;

    /**
     * Details of the voided check export. This field will be present when the `category` is equal to `voided_check`.
     */
    #[Required('voided_check')]
    public ?VoidedCheck $voidedCheck;

    /**
     * `new Export()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Export::with(
     *   id: ...,
     *   accountStatementBai2: ...,
     *   accountStatementOfx: ...,
     *   accountVerificationLetter: ...,
     *   balanceCsv: ...,
     *   bookkeepingAccountBalanceCsv: ...,
     *   category: ...,
     *   createdAt: ...,
     *   dashboardTableCsv: ...,
     *   entityCsv: ...,
     *   form1099Int: ...,
     *   form1099Misc: ...,
     *   fundingInstructions: ...,
     *   idempotencyKey: ...,
     *   result: ...,
     *   status: ...,
     *   transactionCsv: ...,
     *   type: ...,
     *   vendorCsv: ...,
     *   voidedCheck: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Export)
     *   ->withID(...)
     *   ->withAccountStatementBai2(...)
     *   ->withAccountStatementOfx(...)
     *   ->withAccountVerificationLetter(...)
     *   ->withBalanceCsv(...)
     *   ->withBookkeepingAccountBalanceCsv(...)
     *   ->withCategory(...)
     *   ->withCreatedAt(...)
     *   ->withDashboardTableCsv(...)
     *   ->withEntityCsv(...)
     *   ->withForm1099Int(...)
     *   ->withForm1099Misc(...)
     *   ->withFundingInstructions(...)
     *   ->withIdempotencyKey(...)
     *   ->withResult(...)
     *   ->withStatus(...)
     *   ->withTransactionCsv(...)
     *   ->withType(...)
     *   ->withVendorCsv(...)
     *   ->withVoidedCheck(...)
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
     * @param AccountStatementBai2|AccountStatementBai2Shape|null $accountStatementBai2
     * @param AccountStatementOfx|AccountStatementOfxShape|null $accountStatementOfx
     * @param AccountVerificationLetter|AccountVerificationLetterShape|null $accountVerificationLetter
     * @param BalanceCsv|BalanceCsvShape|null $balanceCsv
     * @param BookkeepingAccountBalanceCsv|BookkeepingAccountBalanceCsvShape|null $bookkeepingAccountBalanceCsv
     * @param Category|value-of<Category> $category
     * @param DashboardTableCsv|DashboardTableCsvShape|null $dashboardTableCsv
     * @param EntityCsv|EntityCsvShape|null $entityCsv
     * @param Form1099Int|Form1099IntShape|null $form1099Int
     * @param Form1099Misc|Form1099MiscShape|null $form1099Misc
     * @param FundingInstructions|FundingInstructionsShape|null $fundingInstructions
     * @param Result|ResultShape|null $result
     * @param Status|value-of<Status> $status
     * @param TransactionCsv|TransactionCsvShape|null $transactionCsv
     * @param Type|value-of<Type> $type
     * @param VendorCsv|VendorCsvShape|null $vendorCsv
     * @param VoidedCheck|VoidedCheckShape|null $voidedCheck
     */
    public static function with(
        string $id,
        AccountStatementBai2|array|null $accountStatementBai2,
        AccountStatementOfx|array|null $accountStatementOfx,
        AccountVerificationLetter|array|null $accountVerificationLetter,
        BalanceCsv|array|null $balanceCsv,
        BookkeepingAccountBalanceCsv|array|null $bookkeepingAccountBalanceCsv,
        Category|string $category,
        \DateTimeInterface $createdAt,
        DashboardTableCsv|array|null $dashboardTableCsv,
        EntityCsv|array|null $entityCsv,
        Form1099Int|array|null $form1099Int,
        Form1099Misc|array|null $form1099Misc,
        FundingInstructions|array|null $fundingInstructions,
        ?string $idempotencyKey,
        Result|array|null $result,
        Status|string $status,
        TransactionCsv|array|null $transactionCsv,
        Type|string $type,
        VendorCsv|array|null $vendorCsv,
        VoidedCheck|array|null $voidedCheck,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountStatementBai2'] = $accountStatementBai2;
        $self['accountStatementOfx'] = $accountStatementOfx;
        $self['accountVerificationLetter'] = $accountVerificationLetter;
        $self['balanceCsv'] = $balanceCsv;
        $self['bookkeepingAccountBalanceCsv'] = $bookkeepingAccountBalanceCsv;
        $self['category'] = $category;
        $self['createdAt'] = $createdAt;
        $self['dashboardTableCsv'] = $dashboardTableCsv;
        $self['entityCsv'] = $entityCsv;
        $self['form1099Int'] = $form1099Int;
        $self['form1099Misc'] = $form1099Misc;
        $self['fundingInstructions'] = $fundingInstructions;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['result'] = $result;
        $self['status'] = $status;
        $self['transactionCsv'] = $transactionCsv;
        $self['type'] = $type;
        $self['vendorCsv'] = $vendorCsv;
        $self['voidedCheck'] = $voidedCheck;

        return $self;
    }

    /**
     * The Export identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Details of the account statement BAI2 export. This field will be present when the `category` is equal to `account_statement_bai2`.
     *
     * @param AccountStatementBai2|AccountStatementBai2Shape|null $accountStatementBai2
     */
    public function withAccountStatementBai2(
        AccountStatementBai2|array|null $accountStatementBai2
    ): self {
        $self = clone $this;
        $self['accountStatementBai2'] = $accountStatementBai2;

        return $self;
    }

    /**
     * Details of the account statement OFX export. This field will be present when the `category` is equal to `account_statement_ofx`.
     *
     * @param AccountStatementOfx|AccountStatementOfxShape|null $accountStatementOfx
     */
    public function withAccountStatementOfx(
        AccountStatementOfx|array|null $accountStatementOfx
    ): self {
        $self = clone $this;
        $self['accountStatementOfx'] = $accountStatementOfx;

        return $self;
    }

    /**
     * Details of the account verification letter export. This field will be present when the `category` is equal to `account_verification_letter`.
     *
     * @param AccountVerificationLetter|AccountVerificationLetterShape|null $accountVerificationLetter
     */
    public function withAccountVerificationLetter(
        AccountVerificationLetter|array|null $accountVerificationLetter
    ): self {
        $self = clone $this;
        $self['accountVerificationLetter'] = $accountVerificationLetter;

        return $self;
    }

    /**
     * Details of the balance CSV export. This field will be present when the `category` is equal to `balance_csv`.
     *
     * @param BalanceCsv|BalanceCsvShape|null $balanceCsv
     */
    public function withBalanceCsv(BalanceCsv|array|null $balanceCsv): self
    {
        $self = clone $this;
        $self['balanceCsv'] = $balanceCsv;

        return $self;
    }

    /**
     * Details of the bookkeeping account balance CSV export. This field will be present when the `category` is equal to `bookkeeping_account_balance_csv`.
     *
     * @param BookkeepingAccountBalanceCsv|BookkeepingAccountBalanceCsvShape|null $bookkeepingAccountBalanceCsv
     */
    public function withBookkeepingAccountBalanceCsv(
        BookkeepingAccountBalanceCsv|array|null $bookkeepingAccountBalanceCsv
    ): self {
        $self = clone $this;
        $self['bookkeepingAccountBalanceCsv'] = $bookkeepingAccountBalanceCsv;

        return $self;
    }

    /**
     * The category of the Export. We may add additional possible values for this enum over time; your application should be able to handle that gracefully.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * The time the Export was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Details of the dashboard table CSV export. This field will be present when the `category` is equal to `dashboard_table_csv`.
     *
     * @param DashboardTableCsv|DashboardTableCsvShape|null $dashboardTableCsv
     */
    public function withDashboardTableCsv(
        DashboardTableCsv|array|null $dashboardTableCsv
    ): self {
        $self = clone $this;
        $self['dashboardTableCsv'] = $dashboardTableCsv;

        return $self;
    }

    /**
     * Details of the entity CSV export. This field will be present when the `category` is equal to `entity_csv`.
     *
     * @param EntityCsv|EntityCsvShape|null $entityCsv
     */
    public function withEntityCsv(EntityCsv|array|null $entityCsv): self
    {
        $self = clone $this;
        $self['entityCsv'] = $entityCsv;

        return $self;
    }

    /**
     * Details of the Form 1099-INT export. This field will be present when the `category` is equal to `form_1099_int`.
     *
     * @param Form1099Int|Form1099IntShape|null $form1099Int
     */
    public function withForm1099Int(Form1099Int|array|null $form1099Int): self
    {
        $self = clone $this;
        $self['form1099Int'] = $form1099Int;

        return $self;
    }

    /**
     * Details of the Form 1099-MISC export. This field will be present when the `category` is equal to `form_1099_misc`.
     *
     * @param Form1099Misc|Form1099MiscShape|null $form1099Misc
     */
    public function withForm1099Misc(
        Form1099Misc|array|null $form1099Misc
    ): self {
        $self = clone $this;
        $self['form1099Misc'] = $form1099Misc;

        return $self;
    }

    /**
     * Details of the funding instructions export. This field will be present when the `category` is equal to `funding_instructions`.
     *
     * @param FundingInstructions|FundingInstructionsShape|null $fundingInstructions
     */
    public function withFundingInstructions(
        FundingInstructions|array|null $fundingInstructions
    ): self {
        $self = clone $this;
        $self['fundingInstructions'] = $fundingInstructions;

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
     * The result of the Export. This will be present when the Export's status transitions to `complete`.
     *
     * @param Result|ResultShape|null $result
     */
    public function withResult(Result|array|null $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }

    /**
     * The status of the Export.
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
     * Details of the transaction CSV export. This field will be present when the `category` is equal to `transaction_csv`.
     *
     * @param TransactionCsv|TransactionCsvShape|null $transactionCsv
     */
    public function withTransactionCsv(
        TransactionCsv|array|null $transactionCsv
    ): self {
        $self = clone $this;
        $self['transactionCsv'] = $transactionCsv;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `export`.
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
     * Details of the vendor CSV export. This field will be present when the `category` is equal to `vendor_csv`.
     *
     * @param VendorCsv|VendorCsvShape|null $vendorCsv
     */
    public function withVendorCsv(VendorCsv|array|null $vendorCsv): self
    {
        $self = clone $this;
        $self['vendorCsv'] = $vendorCsv;

        return $self;
    }

    /**
     * Details of the voided check export. This field will be present when the `category` is equal to `voided_check`.
     *
     * @param VoidedCheck|VoidedCheckShape|null $voidedCheck
     */
    public function withVoidedCheck(VoidedCheck|array|null $voidedCheck): self
    {
        $self = clone $this;
        $self['voidedCheck'] = $voidedCheck;

        return $self;
    }
}
