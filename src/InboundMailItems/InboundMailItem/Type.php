<?php

declare(strict_types=1);

namespace Increase\InboundMailItems\InboundMailItem;

/**
 * A constant representing the object's type. For this resource it will always be `inbound_mail_item`.
 */
enum Type: string
{
    case INBOUND_MAIL_ITEM = 'inbound_mail_item';
}
