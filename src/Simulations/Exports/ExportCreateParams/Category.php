<?php

declare(strict_types=1);

namespace Increase\Simulations\Exports\ExportCreateParams;

/**
 * The type of Export to create.
 */
enum Category: string
{
    case FORM_1099_INT = 'form_1099_int';
}
