<?php

namespace App\Http;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager as Fractal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
* API Response
*/
class ApiResponse
{
    const CODE_BAD_REQUEST = 'GEN-FUBARGS';
    const CODE_NOT_FOUND = 'GEN-LIKETHEWIND';
    const CODE_NOT_ALLOWED = 'GEN-NOTALLOWED';
    const CODE_INTERNAL_ERROR = 'GEN-AAAGGH';
    const CODE_UNAUTHORIZED = 'GEN-MAYBGTFO';
    const CODE_FORBIDDEN = 'GEN-GTFO';
    const CODE_CONFLICT = 'GEN-CONFLICT';
    const CODE_CREATED = 'GEN-CREATED';
    const CODE_NO_CONTENT = 'GEN-DELETED';
    const CODE_INVALID_MIME_TYPE = 'GEN-UMWUT';

    /**
     * Request
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Response
     *
     * @var \Illuminate\Http\Response
     */
    protected $response;

    /**
     * Fractal manager
     *
     * @var \League\Fractal\Manager
     */
    protected $fractal;

    /**
     * HTTP Status code
     *
     * @var int
     */
    protected $statusCode = 200;


    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
        $this->fractal = new Fractal;
    }

    /**
     * Getter Fractal Manager
     *
     * @return \League\Fractal\Manager
     */
    public function getFractal()
    {
        return $this->fractal;
    }

    /**
     * Getter for statusCode
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Setter for statusCode
     *
     * @param int $statusCode Value to set
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function withItem($item, $callback)
    {
        $resource = new Item($item, $callback);
        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    public function withCollection($collection, $callback)
    {
        $resource = new Collection($collection, $callback);
        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    protected function respondWithArray(array $array, array $headers = [])
    {
        $mimeTypeRaw = $this->request->server('HTTP_ACCEPT', '*/*');

        // If its empty or has */* then default to JSON
        if ($mimeTypeRaw === '*/*') {
            $mimeType = 'application/json';
        } else {
            // You'll probably want to do something intelligent with charset if provided
            // This chapter just assumes UTF8 everything everywhere
            $mimeParts = (array) explode(';', $mimeTypeRaw);
            $mimeType = strtolower($mimeParts[0]);
        }

        switch ($mimeType) {
            case 'application/json':
                $contentType = 'application/json';
                $content = json_encode($array);
                break;
            default:
                $contentType = 'application/json';
                $content = json_encode([
                    'error' => [
                        'code' => static::CODE_INVALID_MIME_TYPE,
                        'http_code' => 415,
                        'message' => sprintf('Content of type %s is not supported.', $mimeType),
                    ]
                ]);
        }

        $this->response->setContent($content);
        $this->response->setStatusCode($this->statusCode);
        $this->response->header('Content-type', $contentType);

        return $this->response;
    }

    protected function respondWithError($message, $errorCode, $description = '', $link = '')
    {
        if ($this->statusCode === 200) {
            trigger_error(
                "You better have a really good reason for erroring on a 200...",
                E_USER_WARNING
            );
        }

        return $this->respondWithArray([
            'error' => [
                'code' => $errorCode,
                'http_code' => $this->statusCode,
                'message' => $message,
                'description' => $description,
                'link' => $link
            ]
        ]);
    }

    /**
     * Generates a Response with a 201 HTTP header and a given message.
     *
     * @return Response
     */
    public function httpResponseCreated($message = 'Resource Created Successfully')
    {
        return $this->setStatusCode(201)
                    ->respondWithError($message, self::CODE_CREATED);
    }

    /**
     * Generates a Response with a 204 HTTP header and a given message.
     *
     * @return Response
     */
    public function httpResponseNoContent($message = 'Resource Deleted Successfully')
    {
        return $this->setStatusCode(204)
                    ->respondWithError($message, self::CODE_NO_CONTENT);
    }

    /**
     * Generates a Response with a 400 HTTP header and a given message.
     *
     * @return Response
     */
    public function httpResponseBadRequest($message = 'Bad request. Data issues such as invalid JSON')
    {
        return $this->setStatusCode(400)
                    ->respondWithError($message, self::CODE_BAD_REQUEST);
    }

    /**
     * Generates a Response with a 401 HTTP header and a given message.
     *
     * @return Response
     */
    public function httpResponseUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)
                     ->respondWithError($message, self::CODE_UNAUTHORIZED);
    }

    /**
     * Generates a Response with a 403 HTTP header and a given message.
     *
     * @return Response
     */
    public function httpResponseForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)
                    ->respondWithError($message, self::CODE_FORBIDDEN);
    }

    /**
     * Generates a Response with a 404 HTTP header and a given message.
     *
     * @return Response
     */
    public function httpResponseNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)
                    ->respondWithError($message, self::CODE_NOT_FOUND);
    }

    /**
     * Generates a Response with a 405 HTTP header and a given message.
     *
     * @return Response
     */
    public function httpResponseNotAllowed($message = 'Method Not Allowed')
    {
        return $this->setStatusCode(405)
                    ->respondWithError($message, self::CODE_NOT_ALLOWED);
    }

    /**
     * Generates a Response with a 409 HTTP header and a given message.
     *
     * @return Response
     */
    public function httpResponseConflict($message = 'Conflict. Duplicate data or invalid data state would occur')
    {
        return $this->setStatusCode(409)
                    ->respondWithError($message, self::CODE_CONFLICT);
    }

    /**
     * Generates a Response with a 500 HTTP header and a given message.
     *
     * @return Response
     */
    public function httpResponseInternalError($message = 'Internal Server Error')
    {
        return $this->setStatusCode(500)
                    ->respondWithError($message, self::CODE_INTERNAL_ERROR);
    }

}
