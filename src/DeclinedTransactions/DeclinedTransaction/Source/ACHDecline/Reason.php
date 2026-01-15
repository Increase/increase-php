<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source\ACHDecline;

/**
 * Why the ACH transfer was declined.
 */
enum Reason: string
{
    case ACH_ROUTE_CANCELED = 'ach_route_canceled';

    case ACH_ROUTE_DISABLED = 'ach_route_disabled';

    case BREACHES_LIMIT = 'breaches_limit';

    case ENTITY_NOT_ACTIVE = 'entity_not_active';

    case GROUP_LOCKED = 'group_locked';

    case TRANSACTION_NOT_ALLOWED = 'transaction_not_allowed';

    case USER_INITIATED = 'user_initiated';

    case INSUFFICIENT_FUNDS = 'insufficient_funds';

    case RETURNED_PER_ODFI_REQUEST = 'returned_per_odfi_request';

    case AUTHORIZATION_REVOKED_BY_CUSTOMER = 'authorization_revoked_by_customer';

    case PAYMENT_STOPPED = 'payment_stopped';

    case CUSTOMER_ADVISED_UNAUTHORIZED_IMPROPER_INELIGIBLE_OR_INCOMPLETE = 'customer_advised_unauthorized_improper_ineligible_or_incomplete';

    case REPRESENTATIVE_PAYEE_DECEASED_OR_UNABLE_TO_CONTINUE_IN_THAT_CAPACITY = 'representative_payee_deceased_or_unable_to_continue_in_that_capacity';

    case BENEFICIARY_OR_ACCOUNT_HOLDER_DECEASED = 'beneficiary_or_account_holder_deceased';

    case CREDIT_ENTRY_REFUSED_BY_RECEIVER = 'credit_entry_refused_by_receiver';

    case DUPLICATE_ENTRY = 'duplicate_entry';

    case CORPORATE_CUSTOMER_ADVISED_NOT_AUTHORIZED = 'corporate_customer_advised_not_authorized';
}
