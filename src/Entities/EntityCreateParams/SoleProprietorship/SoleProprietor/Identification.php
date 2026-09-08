<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams\SoleProprietorship\SoleProprietor;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityCreateParams\SoleProprietorship\SoleProprietor\Identification\Method;

/**
 * A means of verifying the person's identity. Sole proprietors must be identified with a `social_security_number` or an `individual_taxpayer_identification_number`.
 *
 * @phpstan-type IdentificationShape = array{
 *   method: Method|value-of<Method>, number: string
 * }
 */
final class Identification implements BaseModel
{
    /** @use SdkModel<IdentificationShape> */
    use SdkModel;

    /**
     * A method that can be used to verify the individual's identity.
     *
     * Defaults to `social_security_number`.
     *
     * @var value-of<Method> $method
     */
    #[Required(enum: Method::class)]
    public string $method;

    /**
     * An identification number that can be used to verify the individual's identity, such as a social security number. Submit nine digits with no dashes or other separators.
     */
    #[Required]
    public string $number;

    /**
     * `new Identification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Identification::with(method: ..., number: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Identification)->withMethod(...)->withNumber(...)
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
        string $number,
        Method|string $method = 'social_security_number'
    ): self {
        $self = new self;

        $self['method'] = $method;
        $self['number'] = $number;

        return $self;
    }

    /**
     * A method that can be used to verify the individual's identity.
     *
     * Defaults to `social_security_number`.
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
     * An identification number that can be used to verify the individual's identity, such as a social security number. Submit nine digits with no dashes or other separators.
     */
    public function withNumber(string $number): self
    {
        $self = clone $this;
        $self['number'] = $number;

        return $self;
    }
}
