<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Trust\Trustee\Individual;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\Entity\Trust\Trustee\Individual\Identification\Method;

/**
 * A means of verifying the person's identity.
 *
 * @phpstan-type IdentificationShape = array{
 *   method: Method|value-of<Method>, numberLast4: string
 * }
 */
final class Identification implements BaseModel
{
    /** @use SdkModel<IdentificationShape> */
    use SdkModel;

    /**
     * A method that can be used to verify the individual's identity.
     *
     * @var value-of<Method> $method
     */
    #[Required(enum: Method::class)]
    public string $method;

    /**
     * The last 4 digits of the identification number that can be used to verify the individual's identity.
     */
    #[Required('number_last4')]
    public string $numberLast4;

    /**
     * `new Identification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Identification::with(method: ..., numberLast4: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Identification)->withMethod(...)->withNumberLast4(...)
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
     *
     * @param Method|value-of<Method> $method
     */
    public static function with(
        Method|string $method,
        string $numberLast4
    ): self {
        $self = new self;

        $self['method'] = $method;
        $self['numberLast4'] = $numberLast4;

        return $self;
    }

    /**
     * A method that can be used to verify the individual's identity.
     *
     * @param Method|value-of<Method> $method
     */
    public function withMethod(Method|string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }

    /**
     * The last 4 digits of the identification number that can be used to verify the individual's identity.
     */
    public function withNumberLast4(string $numberLast4): self
    {
        $self = clone $this;
        $self['numberLast4'] = $numberLast4;

        return $self;
    }
}
