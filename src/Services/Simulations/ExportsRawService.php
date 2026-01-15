<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Exports\Export;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\ExportsRawContract;
use Increase\Simulations\Exports\ExportCreateParams;
use Increase\Simulations\Exports\ExportCreateParams\Category;
use Increase\Simulations\Exports\ExportCreateParams\Form1099Int;

/**
 * @phpstan-import-type Form1099IntShape from \Increase\Simulations\Exports\ExportCreateParams\Form1099Int
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
     * Many exports are created by you via POST /exports or in the Dashboard. Some exports are created automatically by Increase. For example, tax documents are published once a year. In sandbox, you can trigger the arrival of an export that would normally only be created automatically via this simulation.
     *
     * @param array{
     *   category: Category|value-of<Category>,
     *   form1099Int?: Form1099Int|Form1099IntShape,
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
            path: 'simulations/exports',
            body: (object) $parsed,
            options: $options,
            convert: Export::class,
        );
    }
}
