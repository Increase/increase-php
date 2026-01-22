<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundCheckDeposits\InboundCheckDeposit;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\InboundCheckDepositsContract;
use Increase\Simulations\InboundCheckDeposits\InboundCheckDepositCreateParams\PayeeNameAnalysis;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundCheckDepositsService implements InboundCheckDepositsContract
{
    /**
     * @api
     */
    public InboundCheckDepositsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboundCheckDepositsRawService($client);
    }

    /**
     * @api
     *
     * Simulates an Inbound Check Deposit against your account. This imitates someone depositing a check at their bank that was issued from your account. It may or may not be associated with a Check Transfer. Increase will evaluate the Inbound Check Deposit as we would in production and either create a Transaction or a Declined Transaction as a result. You can inspect the resulting Inbound Check Deposit object to see the result.
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
    ): InboundCheckDeposit {
        $params = Util::removeNulls(
            [
                'accountNumberID' => $accountNumberID,
                'amount' => $amount,
                'checkNumber' => $checkNumber,
                'payeeNameAnalysis' => $payeeNameAnalysis,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
