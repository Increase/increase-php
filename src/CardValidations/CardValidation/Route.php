<?php

declare(strict_types=1);

namespace Increase\CardValidations\CardValidation;

/**
 * The card network route used for the validation.
 */
enum Route: string
{
    case VISA = 'visa';

    case MASTERCARD = 'mastercard';
}
