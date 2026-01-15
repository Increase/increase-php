<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\UserPrearbitration\CategoryChange;

/**
 * The category the dispute is being changed to.
 */
enum Category: string
{
    case AUTHORIZATION = 'authorization';

    case CONSUMER_CANCELED_MERCHANDISE = 'consumer_canceled_merchandise';

    case CONSUMER_CANCELED_RECURRING_TRANSACTION = 'consumer_canceled_recurring_transaction';

    case CONSUMER_CANCELED_SERVICES = 'consumer_canceled_services';

    case CONSUMER_COUNTERFEIT_MERCHANDISE = 'consumer_counterfeit_merchandise';

    case CONSUMER_CREDIT_NOT_PROCESSED = 'consumer_credit_not_processed';

    case CONSUMER_DAMAGED_OR_DEFECTIVE_MERCHANDISE = 'consumer_damaged_or_defective_merchandise';

    case CONSUMER_MERCHANDISE_MISREPRESENTATION = 'consumer_merchandise_misrepresentation';

    case CONSUMER_MERCHANDISE_NOT_AS_DESCRIBED = 'consumer_merchandise_not_as_described';

    case CONSUMER_MERCHANDISE_NOT_RECEIVED = 'consumer_merchandise_not_received';

    case CONSUMER_NON_RECEIPT_OF_CASH = 'consumer_non_receipt_of_cash';

    case CONSUMER_ORIGINAL_CREDIT_TRANSACTION_NOT_ACCEPTED = 'consumer_original_credit_transaction_not_accepted';

    case CONSUMER_QUALITY_MERCHANDISE = 'consumer_quality_merchandise';

    case CONSUMER_QUALITY_SERVICES = 'consumer_quality_services';

    case CONSUMER_SERVICES_MISREPRESENTATION = 'consumer_services_misrepresentation';

    case CONSUMER_SERVICES_NOT_AS_DESCRIBED = 'consumer_services_not_as_described';

    case CONSUMER_SERVICES_NOT_RECEIVED = 'consumer_services_not_received';

    case FRAUD = 'fraud';

    case PROCESSING_ERROR = 'processing_error';
}
