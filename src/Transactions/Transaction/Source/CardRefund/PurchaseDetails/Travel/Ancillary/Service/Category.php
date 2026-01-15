<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardRefund\PurchaseDetails\Travel\Ancillary\Service;

/**
 * Category of the ancillary service.
 */
enum Category: string
{
    case NONE = 'none';

    case BUNDLED_SERVICE = 'bundled_service';

    case BAGGAGE_FEE = 'baggage_fee';

    case CHANGE_FEE = 'change_fee';

    case CARGO = 'cargo';

    case CARBON_OFFSET = 'carbon_offset';

    case FREQUENT_FLYER = 'frequent_flyer';

    case GIFT_CARD = 'gift_card';

    case GROUND_TRANSPORT = 'ground_transport';

    case IN_FLIGHT_ENTERTAINMENT = 'in_flight_entertainment';

    case LOUNGE = 'lounge';

    case MEDICAL = 'medical';

    case MEAL_BEVERAGE = 'meal_beverage';

    case OTHER = 'other';

    case PASSENGER_ASSIST_FEE = 'passenger_assist_fee';

    case PETS = 'pets';

    case SEAT_FEES = 'seat_fees';

    case STANDBY = 'standby';

    case SERVICE_FEE = 'service_fee';

    case STORE = 'store';

    case TRAVEL_SERVICE = 'travel_service';

    case UNACCOMPANIED_TRAVEL = 'unaccompanied_travel';

    case UPGRADES = 'upgrades';

    case WIFI = 'wifi';
}
