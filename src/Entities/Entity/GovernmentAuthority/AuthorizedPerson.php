<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\GovernmentAuthority;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type AuthorizedPersonShape = array{
 *   authorizedPersonID: string, name: string
 * }
 */
final class AuthorizedPerson implements BaseModel
{
    /** @use SdkModel<AuthorizedPersonShape> */
    use SdkModel;

    /**
     * The identifier of this authorized person.
     */
    #[Required('authorized_person_id')]
    public string $authorizedPersonID;

    /**
     * The person's legal name.
     */
    #[Required]
    public string $name;

    /**
     * `new AuthorizedPerson()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AuthorizedPerson::with(authorizedPersonID: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AuthorizedPerson)->withAuthorizedPersonID(...)->withName(...)
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
    public static function with(string $authorizedPersonID, string $name): self
    {
        $self = new self;

        $self['authorizedPersonID'] = $authorizedPersonID;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The identifier of this authorized person.
     */
    public function withAuthorizedPersonID(string $authorizedPersonID): self
    {
        $self = clone $this;
        $self['authorizedPersonID'] = $authorizedPersonID;

        return $self;
    }

    /**
     * The person's legal name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
