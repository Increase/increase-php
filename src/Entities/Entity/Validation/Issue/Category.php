<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Validation\Issue;

/**
 * The type of issue. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
 */
enum Category: string
{
    case ENTITY_TAX_IDENTIFIER = 'entity_tax_identifier';

    case ENTITY_ADDRESS = 'entity_address';

    case BENEFICIAL_OWNER_IDENTITY = 'beneficial_owner_identity';

    case BENEFICIAL_OWNER_ADDRESS = 'beneficial_owner_address';
}
