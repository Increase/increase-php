<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Validation\Issue\BeneficialOwnerAddress;

/**
 * The reason the address is invalid.
 */
enum Reason: string
{
    case MAILBOX_ADDRESS = 'mailbox_address';
}
