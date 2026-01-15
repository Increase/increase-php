<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledMerchandise\Returned;

/**
 * Return method.
 */
enum ReturnMethod: string
{
    case DHL = 'dhl';

    case FACE_TO_FACE = 'face_to_face';

    case FEDEX = 'fedex';

    case OTHER = 'other';

    case POSTAL_SERVICE = 'postal_service';

    case UPS = 'ups';
}
