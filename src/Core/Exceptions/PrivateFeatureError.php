<?php

namespace Increase\Core\Exceptions;

class PrivateFeatureError extends PermissionDeniedException
{
    public const type = 'private_feature_error';

    /** @var string */
    protected const DESC = 'Increase Private Feature Error';
}
