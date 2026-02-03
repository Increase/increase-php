<?php

declare(strict_types=1);

namespace Increase\Exports\Export;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details of the dashboard table CSV export. This field will be present when the `category` is equal to `dashboard_table_csv`.
 *
 * @phpstan-type DashboardTableCsvShape = array<string,mixed>
 */
final class DashboardTableCsv implements BaseModel
{
    /** @use SdkModel<DashboardTableCsvShape> */
    use SdkModel;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }
}
