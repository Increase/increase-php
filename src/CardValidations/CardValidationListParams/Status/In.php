<?php

declare(strict_types=1);

namespace Increase\CardValidations\CardValidationListParams\Status;

enum In: string
{
    case REQUIRES_ATTENTION = 'requires_attention';

    case PENDING_SUBMISSION = 'pending_submission';

    case SUBMITTED = 'submitted';

    case COMPLETE = 'complete';

    case DECLINED = 'declined';
}
