<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Options for the created export. Required if `category` is equal to `vendor_csv`.
 *
 * @phpstan-type VendorCsvShape = array<string,mixed>
 */
final class VendorCsv implements BaseModel
{
    /** @use SdkModel<VendorCsvShape> */
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
