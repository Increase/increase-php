<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Exports\Export;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\ExportsContract;
use Increase\Simulations\Exports\ExportCreateParams\Category;
use Increase\Simulations\Exports\ExportCreateParams\Form1099Int;

/**
 * @phpstan-import-type Form1099IntShape from \Increase\Simulations\Exports\ExportCreateParams\Form1099Int
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
     * Many exports are created by you via POST /exports or in the Dashboard. Some exports are created automatically by Increase. For example, tax documents are published once a year. In sandbox, you can trigger the arrival of an export that would normally only be created automatically via this simulation.
     *
     * @param Category|value-of<Category> $category the type of Export to create
     * @param Form1099Int|Form1099IntShape $form1099Int Options for the created export. Required if `category` is equal to `form_1099_int`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        Category|string $category,
        Form1099Int|array|null $form1099Int = null,
        RequestOptions|array|null $requestOptions = null,
    ): Export {
        $params = Util::removeNulls(
            ['category' => $category, 'form1099Int' => $form1099Int]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
