<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumberListParams;

use Increase\AccountNumbers\AccountNumberListParams\ACHDebitStatus\In;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type ACHDebitStatusShape = array{in?: list<In|value-of<In>>|null}
 */
final class ACHDebitStatus implements BaseModel
{
    /** @use SdkModel<ACHDebitStatusShape> */
    use SdkModel;

    /**
     * The ACH Debit status to retrieve Account Numbers for. For GET requests, this should be encoded as a comma-delimited string, such as `?in=one,two,three`.
     *
     * @var list<value-of<In>>|null $in
     */
    #[Optional(list: In::class)]
    public ?array $in;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<In|value-of<In>>|null $in
     */
    public static function with(?array $in = null): self
    {
        $self = new self;

        null !== $in && $self['in'] = $in;

        return $self;
    }

    /**
     * The ACH Debit status to retrieve Account Numbers for. For GET requests, this should be encoded as a comma-delimited string, such as `?in=one,two,three`.
     *
     * @param list<In|value-of<In>> $in
     */
    public function withIn(array $in): self
    {
        $self = clone $this;
        $self['in'] = $in;

        return $self;
    }
}
