<?php

declare(strict_types=1);

namespace Increase\Programs\Program;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The lending details for the program.
 *
 * @phpstan-type LendingShape = array{maximumExtendableCredit: int}
 */
final class Lending implements BaseModel
{
    /** @use SdkModel<LendingShape> */
    use SdkModel;

    /**
     * The maximum extendable credit of the program.
     */
    #[Required('maximum_extendable_credit')]
    public int $maximumExtendableCredit;

    /**
     * `new Lending()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Lending::with(maximumExtendableCredit: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Lending)->withMaximumExtendableCredit(...)
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
    public static function with(int $maximumExtendableCredit): self
    {
        $self = new self;

        $self['maximumExtendableCredit'] = $maximumExtendableCredit;

        return $self;
    }

    /**
     * The maximum extendable credit of the program.
     */
    public function withMaximumExtendableCredit(
        int $maximumExtendableCredit
    ): self {
        $self = clone $this;
        $self['maximumExtendableCredit'] = $maximumExtendableCredit;

        return $self;
    }
}
