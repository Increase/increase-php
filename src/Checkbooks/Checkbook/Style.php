<?php

declare(strict_types=1);

namespace Increase\Checkbooks\Checkbook;

/**
 * The physical format of the Checkbook.
 */
enum Style: string
{
    case THREE_RING_BINDER = 'three_ring_binder';

    case FOLDER = 'folder';
}
