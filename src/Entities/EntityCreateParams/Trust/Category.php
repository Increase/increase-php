<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams\Trust;

/**
 * Whether the trust is `revocable` or `irrevocable`. Irrevocable trusts require their own Employer Identification Number. Revocable trusts require information about the individual `grantor` who created the trust.
 */
enum Category: string
{
    case REVOCABLE = 'revocable';

    case IRREVOCABLE = 'irrevocable';
}
