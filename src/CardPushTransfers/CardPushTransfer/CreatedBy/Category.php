<?php

declare(strict_types=1);

namespace Increase\CardPushTransfers\CardPushTransfer\CreatedBy;

/**
 * The type of object that created this transfer.
 */
enum Category: string
{
    case API_KEY = 'api_key';

    case OAUTH_APPLICATION = 'oauth_application';

    case USER = 'user';
}
