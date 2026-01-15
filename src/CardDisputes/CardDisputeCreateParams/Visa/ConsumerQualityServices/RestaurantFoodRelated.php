<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityServices;

/**
 * Whether the dispute is related to the quality of food from an eating place or restaurant. Must be provided when Merchant Category Code (MCC) is 5812, 5813 or 5814.
 */
enum RestaurantFoodRelated: string
{
    case NOT_RELATED = 'not_related';

    case RELATED = 'related';
}
