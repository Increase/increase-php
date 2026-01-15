<?php

namespace Increase\Core\Exceptions;

class IdempotencyKeyAlreadyUsedError extends ConflictException
{
    public const type = 'idempotency_key_already_used_error';

    /** @var string */
    protected const DESC = 'Increase Idempotency Key Already Used Error';
}
