<?php

declare(strict_types=1);

namespace Increase\Exports;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Exports\ExportCreateParams\AccountStatementBai2;
use Increase\Exports\ExportCreateParams\AccountStatementOfx;
use Increase\Exports\ExportCreateParams\AccountVerificationLetter;
use Increase\Exports\ExportCreateParams\BalanceCsv;
use Increase\Exports\ExportCreateParams\BookkeepingAccountBalanceCsv;
use Increase\Exports\ExportCreateParams\Category;
use Increase\Exports\ExportCreateParams\EntityCsv;
use Increase\Exports\ExportCreateParams\FundingInstructions;
use Increase\Exports\ExportCreateParams\TransactionCsv;
use Increase\Exports\ExportCreateParams\VendorCsv;
use Increase\Exports\ExportCreateParams\VoidedCheck;

/**
 * Create an Export.
 *
 * @see Increase\Services\ExportsService::create()
 *
 * @phpstan-import-type AccountStatementBai2Shape from \Increase\Exports\ExportCreateParams\AccountStatementBai2
 * @phpstan-import-type AccountStatementOfxShape from \Increase\Exports\ExportCreateParams\AccountStatementOfx
 * @phpstan-import-type AccountVerificationLetterShape from \Increase\Exports\ExportCreateParams\AccountVerificationLetter
 * @phpstan-import-type BalanceCsvShape from \Increase\Exports\ExportCreateParams\BalanceCsv
 * @phpstan-import-type BookkeepingAccountBalanceCsvShape from \Increase\Exports\ExportCreateParams\BookkeepingAccountBalanceCsv
 * @phpstan-import-type EntityCsvShape from \Increase\Exports\ExportCreateParams\EntityCsv
 * @phpstan-import-type FundingInstructionsShape from \Increase\Exports\ExportCreateParams\FundingInstructions
 * @phpstan-import-type TransactionCsvShape from \Increase\Exports\ExportCreateParams\TransactionCsv
 * @phpstan-import-type VendorCsvShape from \Increase\Exports\ExportCreateParams\VendorCsv
 * @phpstan-import-type VoidedCheckShape from \Increase\Exports\ExportCreateParams\VoidedCheck
 *
 * @phpstan-type ExportCreateParamsShape = array{
 *   category: Category|value-of<Category>,
 *   accountStatementBai2?: null|AccountStatementBai2|AccountStatementBai2Shape,
 *   accountStatementOfx?: null|AccountStatementOfx|AccountStatementOfxShape,
 *   accountVerificationLetter?: null|AccountVerificationLetter|AccountVerificationLetterShape,
 *   balanceCsv?: null|BalanceCsv|BalanceCsvShape,
 *   bookkeepingAccountBalanceCsv?: null|BookkeepingAccountBalanceCsv|BookkeepingAccountBalanceCsvShape,
 *   entityCsv?: null|EntityCsv|EntityCsvShape,
 *   fundingInstructions?: null|FundingInstructions|FundingInstructionsShape,
 *   transactionCsv?: null|TransactionCsv|TransactionCsvShape,
 *   vendorCsv?: null|VendorCsv|VendorCsvShape,
 *   voidedCheck?: null|VoidedCheck|VoidedCheckShape,
 * }
 */
final class ExportCreateParams implements BaseModel
{
    /** @use SdkModel<ExportCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The type of Export to create.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Options for the created export. Required if `category` is equal to `account_statement_bai2`.
     */
    #[Optional('account_statement_bai2')]
    public ?AccountStatementBai2 $accountStatementBai2;

    /**
     * Options for the created export. Required if `category` is equal to `account_statement_ofx`.
     */
    #[Optional('account_statement_ofx')]
    public ?AccountStatementOfx $accountStatementOfx;

    /**
     * Options for the created export. Required if `category` is equal to `account_verification_letter`.
     */
    #[Optional('account_verification_letter')]
    public ?AccountVerificationLetter $accountVerificationLetter;

    /**
     * Options for the created export. Required if `category` is equal to `balance_csv`.
     */
    #[Optional('balance_csv')]
    public ?BalanceCsv $balanceCsv;

    /**
     * Options for the created export. Required if `category` is equal to `bookkeeping_account_balance_csv`.
     */
    #[Optional('bookkeeping_account_balance_csv')]
    public ?BookkeepingAccountBalanceCsv $bookkeepingAccountBalanceCsv;

    /**
     * Options for the created export. Required if `category` is equal to `entity_csv`.
     */
    #[Optional('entity_csv')]
    public ?EntityCsv $entityCsv;

    /**
     * Options for the created export. Required if `category` is equal to `funding_instructions`.
     */
    #[Optional('funding_instructions')]
    public ?FundingInstructions $fundingInstructions;

    /**
     * Options for the created export. Required if `category` is equal to `transaction_csv`.
     */
    #[Optional('transaction_csv')]
    public ?TransactionCsv $transactionCsv;

    /**
     * Options for the created export. Required if `category` is equal to `vendor_csv`.
     */
    #[Optional('vendor_csv')]
    public ?VendorCsv $vendorCsv;

    /**
     * Options for the created export. Required if `category` is equal to `voided_check`.
     */
    #[Optional('voided_check')]
    public ?VoidedCheck $voidedCheck;

    /**
     * `new ExportCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExportCreateParams::with(category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExportCreateParams)->withCategory(...)
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
     * @param Category|value-of<Category> $category
     * @param AccountStatementBai2|AccountStatementBai2Shape|null $accountStatementBai2
     * @param AccountStatementOfx|AccountStatementOfxShape|null $accountStatementOfx
     * @param AccountVerificationLetter|AccountVerificationLetterShape|null $accountVerificationLetter
     * @param BalanceCsv|BalanceCsvShape|null $balanceCsv
     * @param BookkeepingAccountBalanceCsv|BookkeepingAccountBalanceCsvShape|null $bookkeepingAccountBalanceCsv
     * @param EntityCsv|EntityCsvShape|null $entityCsv
     * @param FundingInstructions|FundingInstructionsShape|null $fundingInstructions
     * @param TransactionCsv|TransactionCsvShape|null $transactionCsv
     * @param VendorCsv|VendorCsvShape|null $vendorCsv
     * @param VoidedCheck|VoidedCheckShape|null $voidedCheck
     */
    public static function with(
        Category|string $category,
        AccountStatementBai2|array|null $accountStatementBai2 = null,
        AccountStatementOfx|array|null $accountStatementOfx = null,
        AccountVerificationLetter|array|null $accountVerificationLetter = null,
        BalanceCsv|array|null $balanceCsv = null,
        BookkeepingAccountBalanceCsv|array|null $bookkeepingAccountBalanceCsv = null,
        EntityCsv|array|null $entityCsv = null,
        FundingInstructions|array|null $fundingInstructions = null,
        TransactionCsv|array|null $transactionCsv = null,
        VendorCsv|array|null $vendorCsv = null,
        VoidedCheck|array|null $voidedCheck = null,
    ): self {
        $self = new self;

        $self['category'] = $category;

        null !== $accountStatementBai2 && $self['accountStatementBai2'] = $accountStatementBai2;
        null !== $accountStatementOfx && $self['accountStatementOfx'] = $accountStatementOfx;
        null !== $accountVerificationLetter && $self['accountVerificationLetter'] = $accountVerificationLetter;
        null !== $balanceCsv && $self['balanceCsv'] = $balanceCsv;
        null !== $bookkeepingAccountBalanceCsv && $self['bookkeepingAccountBalanceCsv'] = $bookkeepingAccountBalanceCsv;
        null !== $entityCsv && $self['entityCsv'] = $entityCsv;
        null !== $fundingInstructions && $self['fundingInstructions'] = $fundingInstructions;
        null !== $transactionCsv && $self['transactionCsv'] = $transactionCsv;
        null !== $vendorCsv && $self['vendorCsv'] = $vendorCsv;
        null !== $voidedCheck && $self['voidedCheck'] = $voidedCheck;

        return $self;
    }

    /**
     * The type of Export to create.
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
     * Options for the created export. Required if `category` is equal to `account_statement_bai2`.
     *
     * @param AccountStatementBai2|AccountStatementBai2Shape $accountStatementBai2
     */
    public function withAccountStatementBai2(
        AccountStatementBai2|array $accountStatementBai2
    ): self {
        $self = clone $this;
        $self['accountStatementBai2'] = $accountStatementBai2;

        return $self;
    }

    /**
     * Options for the created export. Required if `category` is equal to `account_statement_ofx`.
     *
     * @param AccountStatementOfx|AccountStatementOfxShape $accountStatementOfx
     */
    public function withAccountStatementOfx(
        AccountStatementOfx|array $accountStatementOfx
    ): self {
        $self = clone $this;
        $self['accountStatementOfx'] = $accountStatementOfx;

        return $self;
    }

    /**
     * Options for the created export. Required if `category` is equal to `account_verification_letter`.
     *
     * @param AccountVerificationLetter|AccountVerificationLetterShape $accountVerificationLetter
     */
    public function withAccountVerificationLetter(
        AccountVerificationLetter|array $accountVerificationLetter
    ): self {
        $self = clone $this;
        $self['accountVerificationLetter'] = $accountVerificationLetter;

        return $self;
    }

    /**
     * Options for the created export. Required if `category` is equal to `balance_csv`.
     *
     * @param BalanceCsv|BalanceCsvShape $balanceCsv
     */
    public function withBalanceCsv(BalanceCsv|array $balanceCsv): self
    {
        $self = clone $this;
        $self['balanceCsv'] = $balanceCsv;

        return $self;
    }

    /**
     * Options for the created export. Required if `category` is equal to `bookkeeping_account_balance_csv`.
     *
     * @param BookkeepingAccountBalanceCsv|BookkeepingAccountBalanceCsvShape $bookkeepingAccountBalanceCsv
     */
    public function withBookkeepingAccountBalanceCsv(
        BookkeepingAccountBalanceCsv|array $bookkeepingAccountBalanceCsv
    ): self {
        $self = clone $this;
        $self['bookkeepingAccountBalanceCsv'] = $bookkeepingAccountBalanceCsv;

        return $self;
    }

    /**
     * Options for the created export. Required if `category` is equal to `entity_csv`.
     *
     * @param EntityCsv|EntityCsvShape $entityCsv
     */
    public function withEntityCsv(EntityCsv|array $entityCsv): self
    {
        $self = clone $this;
        $self['entityCsv'] = $entityCsv;

        return $self;
    }

    /**
     * Options for the created export. Required if `category` is equal to `funding_instructions`.
     *
     * @param FundingInstructions|FundingInstructionsShape $fundingInstructions
     */
    public function withFundingInstructions(
        FundingInstructions|array $fundingInstructions
    ): self {
        $self = clone $this;
        $self['fundingInstructions'] = $fundingInstructions;

        return $self;
    }

    /**
     * Options for the created export. Required if `category` is equal to `transaction_csv`.
     *
     * @param TransactionCsv|TransactionCsvShape $transactionCsv
     */
    public function withTransactionCsv(
        TransactionCsv|array $transactionCsv
    ): self {
        $self = clone $this;
        $self['transactionCsv'] = $transactionCsv;

        return $self;
    }

    /**
     * Options for the created export. Required if `category` is equal to `vendor_csv`.
     *
     * @param VendorCsv|VendorCsvShape $vendorCsv
     */
    public function withVendorCsv(VendorCsv|array $vendorCsv): self
    {
        $self = clone $this;
        $self['vendorCsv'] = $vendorCsv;

        return $self;
    }

    /**
     * Options for the created export. Required if `category` is equal to `voided_check`.
     *
     * @param VoidedCheck|VoidedCheckShape $voidedCheck
     */
    public function withVoidedCheck(VoidedCheck|array $voidedCheck): self
    {
        $self = clone $this;
        $self['voidedCheck'] = $voidedCheck;

        return $self;
    }
}
