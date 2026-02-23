<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardBalanceInquiry\NetworkDetails\Visa;

/**
 * The capability of the terminal being used to read the card. Shows whether a terminal can e.g., accept chip cards or if it only supports magnetic stripe reads. This reflects the highest capability of the terminal — for example, a terminal that supports both chip and magnetic stripe will be identified as chip-capable.
 */
enum TerminalEntryCapability: string
{
    case UNKNOWN = 'unknown';

    case TERMINAL_NOT_USED = 'terminal_not_used';

    case MAGNETIC_STRIPE = 'magnetic_stripe';

    case BARCODE = 'barcode';

    case OPTICAL_CHARACTER_RECOGNITION = 'optical_character_recognition';

    case CHIP_OR_CONTACTLESS = 'chip_or_contactless';

    case CONTACTLESS_ONLY = 'contactless_only';

    case NO_CAPABILITY = 'no_capability';
}
