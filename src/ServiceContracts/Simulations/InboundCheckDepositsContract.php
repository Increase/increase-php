<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\InboundCheckDeposits\InboundCheckDeposit;
use Increase\RequestOptions;
use Increase\Simulations\InboundCheckDeposits\InboundCheckDepositAdjustmentParams\Reason;
use Increase\Simulations\InboundCheckDeposits\InboundCheckDepositCreateParams\PayeeNameAnalysis;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundCheckDepositsContract
{
    /**
     * @api
     *
     * @param string $accountNumberID the identifier of the Account Number the Inbound Check Deposit will be against
     * @param int $amount the check amount in cents
     * @param string $checkNumber the check number on the check to be deposited
     * @param PayeeNameAnalysis|value-of<PayeeNameAnalysis> $payeeNameAnalysis Simulate the outcome of [payee name checking](https://increase.com/documentation/positive-pay#payee-name-mismatches). Defaults to `not_evaluated`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountNumberID,
        int $amount,
        string $checkNumber,
        PayeeNameAnalysis|string|null $payeeNameAnalysis = null,
        RequestOptions|array|null $requestOptions = null,
    ): InboundCheckDeposit;

    /**
     * @api
     *
     * @param string $inboundCheckDepositID the identifier of the Inbound Check Deposit to adjust
     * @param int $amount The adjustment amount in cents. Defaults to the amount of the Inbound Check Deposit.
     * @param Reason|value-of<Reason> $reason The reason for the adjustment. Defaults to `wrong_payee_credit`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function adjustment(
        string $inboundCheckDepositID,
        ?int $amount = null,
        Reason|string|null $reason = null,
        RequestOptions|array|null $requestOptions = null,
    ): InboundCheckDeposit;
}
