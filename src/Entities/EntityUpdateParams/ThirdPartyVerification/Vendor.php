<?php

declare(strict_types=1);

namespace Increase\Entities\EntityUpdateParams\ThirdPartyVerification;

/**
 * The vendor that was used to perform the verification.
 */
enum Vendor: string
{
    case ALLOY = 'alloy';

    case MIDDESK = 'middesk';

    case OSCILAR = 'oscilar';

    case PERSONA = 'persona';
}
