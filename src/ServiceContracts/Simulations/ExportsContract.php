<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\Exports\Export;
use Increase\RequestOptions;
use Increase\Simulations\Exports\ExportCreateParams\Category;
use Increase\Simulations\Exports\ExportCreateParams\Form1099Int;

/**
 * @phpstan-import-type Form1099IntShape from \Increase\Simulations\Exports\ExportCreateParams\Form1099Int
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface ExportsContract
{
    /**
     * @api
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
    ): Export;
}
