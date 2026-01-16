<?php

namespace Increase\Core\Exceptions;

use Increase\Core\Util;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class APIStatusException extends APIException
{
    /** @var string */
    protected const DESC = 'Increase API Status Error';

    public ?int $status;

    public function __construct(
        public RequestInterface $request,
        ResponseInterface $response,
        ?\Throwable $previous = null,
        string $message = '',
    ) {
        $this->response = $response;
        $this->status = $response->getStatusCode();

        $summary = Util::prettyEncodeJson(['status' => $this->status, 'body' => Util::decodeJson($response->getBody())]);

        if ('' != $message) {
            $summary .= $message.PHP_EOL.$summary;
        }

        parent::__construct(request: $request, message: $summary, previous: $previous);
    }

    public static function from(
        RequestInterface $request,
        ResponseInterface $response,
        string $message = ''
    ): self {
        $status = $response->getStatusCode();
        $body = Util::decodeJson($response->getBody());
        $key = Util::dig($body, 'type');

        $cls = match (true) {
            400 === $status && InvalidParametersError::type === $key => InvalidParametersError::class,
            400 === $status && MalformedRequestError::type === $key => MalformedRequestError::class,
            401 === $status && InvalidAPIKeyError::type === $key => InvalidAPIKeyError::class,
            403 === $status && EnvironmentMismatchError::type === $key => EnvironmentMismatchError::class,
            403 === $status && InsufficientPermissionsError::type === $key => InsufficientPermissionsError::class,
            403 === $status && PrivateFeatureError::type === $key => PrivateFeatureError::class,
            404 === $status && APIMethodNotFoundError::type === $key => APIMethodNotFoundError::class,
            404 === $status && ObjectNotFoundError::type === $key => ObjectNotFoundError::class,
            409 === $status && IdempotencyKeyAlreadyUsedError::type === $key => IdempotencyKeyAlreadyUsedError::class,
            409 === $status && InvalidOperationError::type === $key => InvalidOperationError::class,
            429 === $status && RateLimitedError::type === $key => RateLimitedError::class,
            $status >= 500 && InternalServerException::type === $key => InternalServerException::class,
            400 === $status => BadRequestException::class,
            401 === $status => AuthenticationException::class,
            403 === $status => PermissionDeniedException::class,
            404 === $status => NotFoundException::class,
            409 === $status => ConflictException::class,
            422 === $status => UnprocessableEntityException::class,
            429 === $status => RateLimitException::class,
            default => APIStatusException::class
        };

        return new $cls(request: $request, response: $response, message: $message);
    }
}
