<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Exports\Export;
use Increase\Exports\ExportCreateParams;
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
use Increase\Exports\ExportListParams;
use Increase\Exports\ExportListParams\CreatedAt;
use Increase\Exports\ExportListParams\Form1099Int;
use Increase\Exports\ExportListParams\Form1099Misc;
use Increase\Exports\ExportListParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\ExportsRawContract;

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
final class ExportsRawService implements ExportsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create an Export
     *
     * @param array{
     *   category: value-of<Category>,
     *   accountStatementBai2?: AccountStatementBai2|AccountStatementBai2Shape,
     *   accountStatementOfx?: AccountStatementOfx|AccountStatementOfxShape,
     *   accountVerificationLetter?: AccountVerificationLetter|AccountVerificationLetterShape,
     *   balanceCsv?: BalanceCsv|BalanceCsvShape,
     *   bookkeepingAccountBalanceCsv?: BookkeepingAccountBalanceCsv|BookkeepingAccountBalanceCsvShape,
     *   entityCsv?: EntityCsv|EntityCsvShape,
     *   fundingInstructions?: FundingInstructions|FundingInstructionsShape,
     *   transactionCsv?: TransactionCsv|TransactionCsvShape,
     *   vendorCsv?: VendorCsv|VendorCsvShape,
     * }|ExportCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Export>
     *
     * @throws APIException
     */
    public function create(
        array|ExportCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ExportCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'exports',
            body: (object) $parsed,
            options: $options,
            convert: Export::class,
        );
    }

    /**
     * @api
     *
     * Retrieve an Export
     *
     * @param string $exportID the identifier of the Export to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Export>
     *
     * @throws APIException
     */
    public function retrieve(
        string $exportID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['exports/%1$s', $exportID],
            options: $requestOptions,
            convert: Export::class,
        );
    }

    /**
     * @api
     *
     * List Exports
     *
     * @param array{
     *   category?: value-of<ExportListParams\Category>,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   form1099Int?: Form1099Int|Form1099IntShape,
     *   form1099Misc?: Form1099Misc|Form1099MiscShape,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|ExportListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Export>>
     *
     * @throws APIException
     */
    public function list(
        array|ExportListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ExportListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'exports',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'createdAt' => 'created_at',
                    'form1099Int' => 'form_1099_int',
                    'form1099Misc' => 'form_1099_misc',
                    'idempotencyKey' => 'idempotency_key',
                ],
            ),
            options: $options,
            convert: Export::class,
            page: Page::class,
        );
    }
}
