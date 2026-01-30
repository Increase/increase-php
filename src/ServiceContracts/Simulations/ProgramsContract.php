<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\Programs\Program;
use Increase\RequestOptions;
use Increase\Simulations\Programs\ProgramCreateParams\Bank;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface ProgramsContract
{
    /**
     * @api
     *
     * @param string $name the name of the program being added
     * @param Bank|value-of<Bank> $bank the bank for the program's accounts, defaults to First Internet Bank
     * @param int $lendingMaximumExtendableCredit the maximum extendable credit of the program being added
     * @param string $reserveAccountID the identifier of the Account the Program should be added to is for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        Bank|string|null $bank = null,
        ?int $lendingMaximumExtendableCredit = null,
        ?string $reserveAccountID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Program;
}
