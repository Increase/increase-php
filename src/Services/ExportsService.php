<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Exports\Export;
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
use Increase\Exports\ExportListParams\CreatedAt;
use Increase\Exports\ExportListParams\Form1099Int;
use Increase\Exports\ExportListParams\Form1099Misc;
use Increase\Exports\ExportListParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\ExportsContract;

/**
 * @phpstan-import-type AccountStatementBai2Shape from \Increase\Exports\ExportCreateParams\AccountStatementBai2
 * @phpstan-import-type AccountStatementOfxShape from \Increase\Exports\ExportCreateParams\AccountStatementOfx
 * @phpstan-import-type AccountVerificationLetterShape from \Increase\Exports\ExportCreateParams\AccountVerificationLetter
 * @phpstan-import-type BalanceCsvShape from \Increase\Exports\ExportCreateParams\BalanceCsv
 * @phpstan-import-type BookkeepingAccountBalanceCsvShape from \Increase\Exports\ExportCreateParams\BookkeepingAccountBalanceCsv
 * @phpstan-import-type EntityCsvShape from \Increase\Exports\ExportCreateParams\EntityCsv
 * @phpstan-import-type FundingInstructionsShape from \Increase\Exports\ExportCreateParams\FundingInstructions
 * @phpstan-import-type TransactionCsvShape from \Increase\Exports\ExportCreateParams\TransactionCsv
 * @phpstan-import-type VendorCsvShape from \Increase\Exports\ExportCreateParams\VendorCsv
 * @phpstan-import-type CreatedAtShape from \Increase\Exports\ExportListParams\CreatedAt
 * @phpstan-import-type Form1099IntShape from \Increase\Exports\ExportListParams\Form1099Int
 * @phpstan-import-type Form1099MiscShape from \Increase\Exports\ExportListParams\Form1099Misc
 * @phpstan-import-type StatusShape from \Increase\Exports\ExportListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class ExportsService implements ExportsContract
{
    /**
     * @api
     */
    public ExportsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ExportsRawService($client);
    }

    /**
     * @api
     *
     * Create an Export
     *
     * @param Category|value-of<Category> $category the type of Export to create
     * @param AccountStatementBai2|AccountStatementBai2Shape $accountStatementBai2 Options for the created export. Required if `category` is equal to `account_statement_bai2`.
     * @param AccountStatementOfx|AccountStatementOfxShape $accountStatementOfx Options for the created export. Required if `category` is equal to `account_statement_ofx`.
     * @param AccountVerificationLetter|AccountVerificationLetterShape $accountVerificationLetter Options for the created export. Required if `category` is equal to `account_verification_letter`.
     * @param BalanceCsv|BalanceCsvShape $balanceCsv Options for the created export. Required if `category` is equal to `balance_csv`.
     * @param BookkeepingAccountBalanceCsv|BookkeepingAccountBalanceCsvShape $bookkeepingAccountBalanceCsv Options for the created export. Required if `category` is equal to `bookkeeping_account_balance_csv`.
     * @param EntityCsv|EntityCsvShape $entityCsv Options for the created export. Required if `category` is equal to `entity_csv`.
     * @param FundingInstructions|FundingInstructionsShape $fundingInstructions Options for the created export. Required if `category` is equal to `funding_instructions`.
     * @param TransactionCsv|TransactionCsvShape $transactionCsv Options for the created export. Required if `category` is equal to `transaction_csv`.
     * @param VendorCsv|VendorCsvShape $vendorCsv Options for the created export. Required if `category` is equal to `vendor_csv`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
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
        RequestOptions|array|null $requestOptions = null,
    ): Export {
        $params = Util::removeNulls(
            [
                'category' => $category,
                'accountStatementBai2' => $accountStatementBai2,
                'accountStatementOfx' => $accountStatementOfx,
                'accountVerificationLetter' => $accountVerificationLetter,
                'balanceCsv' => $balanceCsv,
                'bookkeepingAccountBalanceCsv' => $bookkeepingAccountBalanceCsv,
                'entityCsv' => $entityCsv,
                'fundingInstructions' => $fundingInstructions,
                'transactionCsv' => $transactionCsv,
                'vendorCsv' => $vendorCsv,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve an Export
     *
     * @param string $exportID the identifier of the Export to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $exportID,
        RequestOptions|array|null $requestOptions = null
    ): Export {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($exportID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Exports
     *
     * @param \Increase\Exports\ExportListParams\Category|value-of<\Increase\Exports\ExportListParams\Category> $category filter Exports for those with the specified category
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param Form1099Int|Form1099IntShape $form1099Int
     * @param Form1099Misc|Form1099MiscShape $form1099Misc
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<Export>
     *
     * @throws APIException
     */
    public function list(
        \Increase\Exports\ExportListParams\Category|string|null $category = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        Form1099Int|array|null $form1099Int = null,
        Form1099Misc|array|null $form1099Misc = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'category' => $category,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'form1099Int' => $form1099Int,
                'form1099Misc' => $form1099Misc,
                'idempotencyKey' => $idempotencyKey,
                'limit' => $limit,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
