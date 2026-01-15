<?php

declare(strict_types=1);

namespace Increase\Files\File;

/**
 * What the File will be used for. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
 */
enum Purpose: string
{
    case CARD_DISPUTE_ATTACHMENT = 'card_dispute_attachment';

    case CHECK_IMAGE_FRONT = 'check_image_front';

    case CHECK_IMAGE_BACK = 'check_image_back';

    case PROCESSED_CHECK_IMAGE_FRONT = 'processed_check_image_front';

    case PROCESSED_CHECK_IMAGE_BACK = 'processed_check_image_back';

    case MAILED_CHECK_IMAGE = 'mailed_check_image';

    case CHECK_ATTACHMENT = 'check_attachment';

    case CHECK_VOUCHER_IMAGE = 'check_voucher_image';

    case INBOUND_MAIL_ITEM = 'inbound_mail_item';

    case FORM_1099_INT = 'form_1099_int';

    case FORM_1099_MISC = 'form_1099_misc';

    case FORM_SS_4 = 'form_ss_4';

    case IDENTITY_DOCUMENT = 'identity_document';

    case INCREASE_STATEMENT = 'increase_statement';

    case LOAN_APPLICATION_SUPPLEMENTAL_DOCUMENT = 'loan_application_supplemental_document';

    case OTHER = 'other';

    case TRUST_FORMATION_DOCUMENT = 'trust_formation_document';

    case DIGITAL_WALLET_ARTWORK = 'digital_wallet_artwork';

    case DIGITAL_WALLET_APP_ICON = 'digital_wallet_app_icon';

    case PHYSICAL_CARD_FRONT = 'physical_card_front';

    case PHYSICAL_CARD_BACK = 'physical_card_back';

    case PHYSICAL_CARD_CARRIER = 'physical_card_carrier';

    case DOCUMENT_REQUEST = 'document_request';

    case ENTITY_SUPPLEMENTAL_DOCUMENT = 'entity_supplemental_document';

    case EXPORT = 'export';

    case FEE_STATEMENT = 'fee_statement';

    case UNUSUAL_ACTIVITY_REPORT_ATTACHMENT = 'unusual_activity_report_attachment';

    case DEPOSIT_ACCOUNT_CONTROL_AGREEMENT = 'deposit_account_control_agreement';

    case PROOF_OF_AUTHORIZATION_REQUEST_SUBMISSION = 'proof_of_authorization_request_submission';

    case ACCOUNT_VERIFICATION_LETTER = 'account_verification_letter';

    case FUNDING_INSTRUCTIONS = 'funding_instructions';

    case HOLD_HARMLESS_LETTER = 'hold_harmless_letter';
}
