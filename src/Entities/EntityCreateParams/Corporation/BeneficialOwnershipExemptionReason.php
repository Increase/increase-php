<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams\Corporation;

/**
 * If the entity is exempt from the requirement to submit beneficial owners, provide the justification. If a reason is provided, you do not need to submit a list of beneficial owners.
 */
enum BeneficialOwnershipExemptionReason: string
{
    case REGULATED_FINANCIAL_INSTITUTION = 'regulated_financial_institution';

    case PUBLICLY_TRADED_COMPANY = 'publicly_traded_company';

    case PUBLIC_ENTITY = 'public_entity';

    case OTHER = 'other';
}
