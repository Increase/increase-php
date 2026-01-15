<?php

declare(strict_types=1);

namespace Increase\Files\FileCreateParams;

/**
 * What the File will be used for in Increase's systems.
 */
enum Purpose: string
{
    case CARD_DISPUTE_ATTACHMENT = 'card_dispute_attachment';

    case CHECK_IMAGE_FRONT = 'check_image_front';

    case CHECK_IMAGE_BACK = 'check_image_back';

    case MAILED_CHECK_IMAGE = 'mailed_check_image';

    case CHECK_ATTACHMENT = 'check_attachment';

    case CHECK_VOUCHER_IMAGE = 'check_voucher_image';

    case FORM_SS_4 = 'form_ss_4';

    case IDENTITY_DOCUMENT = 'identity_document';

    case LOAN_APPLICATION_SUPPLEMENTAL_DOCUMENT = 'loan_application_supplemental_document';

    case OTHER = 'other';

    case TRUST_FORMATION_DOCUMENT = 'trust_formation_document';

    case DIGITAL_WALLET_ARTWORK = 'digital_wallet_artwork';

    case DIGITAL_WALLET_APP_ICON = 'digital_wallet_app_icon';

    case PHYSICAL_CARD_FRONT = 'physical_card_front';

    case PHYSICAL_CARD_CARRIER = 'physical_card_carrier';

    case DOCUMENT_REQUEST = 'document_request';

    case ENTITY_SUPPLEMENTAL_DOCUMENT = 'entity_supplemental_document';

    case UNUSUAL_ACTIVITY_REPORT_ATTACHMENT = 'unusual_activity_report_attachment';

    case PROOF_OF_AUTHORIZATION_REQUEST_SUBMISSION = 'proof_of_authorization_request_submission';
}
