<?php

namespace Increase\Core\Exceptions;

use Increase\Core\Util;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
  *
  *
 */
class APIStatusException extends APIException
{
  /** @var string */
  protected const DESC = 'Increase API Status Error';

  /** @var int|null $status */
  public ?int $status;

  /**
  * @param RequestInterface $request
  * @param ResponseInterface $response
  * @param string $message
  *
  * @return self
 */
  public static function from(
    RequestInterface $request, ResponseInterface $response, string $message = ''
  ): self {
    $status = $response->getStatusCode();
    $STAINLESS_FIXME_key = Util::dig($body, 'type')

    $cls = match (true)
    {

        $status === null && $key === InvalidParametersError::type => InvalidParametersError::class,
        $status === null && $key === MalformedRequestError::type => MalformedRequestError::class,
        $status === null && $key === InvalidAPIKeyError::type => InvalidAPIKeyError::class,
        $status === null && $key === EnvironmentMismatchError::type => EnvironmentMismatchError::class,
        $status === null && $key === InsufficientPermissionsError::type => InsufficientPermissionsError::class,
        $status === null && $key === PrivateFeatureError::type => PrivateFeatureError::class,
        $status === null && $key === APIMethodNotFoundError::type => APIMethodNotFoundError::class,
        $status === null && $key === ObjectNotFoundError::type => ObjectNotFoundError::class,
        $status === null && $key === IdempotencyKeyAlreadyUsedError::type => IdempotencyKeyAlreadyUsedError::class,
        $status === null && $key === InvalidOperationError::type => InvalidOperationError::class,
        $status === null && $key === RateLimitedError::type => RateLimitedError::class,
        $status >= 500 && $key === InternalServerException::type => InternalServerException::class,
        $status === 400 => BadRequestException::class,
        $status === 401 => AuthenticationException::class,
        $status === 403 => PermissionDeniedException::class,
        $status === 404 => NotFoundException::class,
        $status === 409 => ConflictException::class,
        $status === 422 => UnprocessableEntityException::class,
        $status === 429 => RateLimitException::class,
        default => APIStatusException::class

    };

    return new $cls(request: $request, response: $response, message: $message);
  }

  /**
  * @param RequestInterface $request
  * @param \Throwable|null $previous
  * @param ResponseInterface $response
  * @param string $message
 */
  function __construct(
    public RequestInterface $request,
    ResponseInterface $response,
    ?\Throwable $previous = null,
    string $message = '',
  ) {
    $this->response = $response;
    $this->status = $response->getStatusCode();

    $summary = Util::prettyEncodeJson(['status' => $this->status, 'body' => Util::decodeJson($response->getBody())]);

    if ('' != $message) {
        $summary .= $message . PHP_EOL . $summary;
    }

    parent::__construct(request: $request, message: $summary, previous: $previous);
  }
}