<?php

declare(strict_types=1);

namespace Increase\WireDrawdownRequests\WireDrawdownRequestCreateParams;

/**
 * Determines who bears the cost of the drawdown request. Defaults to `shared` if not specified.
 */
enum ChargeBearer: string
{
    case SHARED = 'shared';

    case DEBTOR = 'debtor';

    case CREDITOR = 'creditor';

    case SERVICE_LEVEL = 'service_level';
}
