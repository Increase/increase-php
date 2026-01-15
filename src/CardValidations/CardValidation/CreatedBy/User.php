<?php

declare(strict_types=1);

namespace Increase\CardValidations\CardValidation\CreatedBy;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If present, details about the User that created the transfer.
 *
 * @phpstan-type UserShape = array{email: string}
 */
final class User implements BaseModel
{
    /** @use SdkModel<UserShape> */
    use SdkModel;

    /**
     * The email address of the User.
     */
    #[Required]
    public string $email;

    /**
     * `new User()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * User::with(email: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new User)->withEmail(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $email): self
    {
        $self = new self;

        $self['email'] = $email;

        return $self;
    }

    /**
     * The email address of the User.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }
}
