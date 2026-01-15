<?php

declare(strict_types=1);

namespace Increase\Simulations\CardAuthorizations\CardAuthorizationNewResponse;

/**
 * A constant representing the object's type. For this resource it will always be `inbound_card_authorization_simulation_result`.
 */
enum Type: string
{
    case INBOUND_CARD_AUTHORIZATION_SIMULATION_RESULT = 'inbound_card_authorization_simulation_result';
}
