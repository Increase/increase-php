<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Corporation\BeneficialOwner\Individual\Identification;

/**
 * A method that can be used to verify the individual's identity.
 */
enum Method: string
{
    case SOCIAL_SECURITY_NUMBER = 'social_security_number';

    case INDIVIDUAL_TAXPAYER_IDENTIFICATION_NUMBER = 'individual_taxpayer_identification_number';

    case PASSPORT = 'passport';

    case DRIVERS_LICENSE = 'drivers_license';

    case OTHER = 'other';
}
