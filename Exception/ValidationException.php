<?php

declare(strict_types=1);

namespace Nzo\JsonSchemaValidatorBundle\Exception;

use League\OpenAPIValidation\PSR7\Exception\ValidationFailed;
use League\OpenAPIValidation\Schema\Exception\SchemaMismatch;

class ValidationException extends \Exception
{
    public static function buildException(ValidationFailed $exception): ValidationException
    {
        $previous = $exception;
        $message  = $exception->getMessage();

        while ($exception = $exception->getPrevious()) {
            $message .= sprintf(': %s', $exception->getMessage());

            if ($exception instanceof SchemaMismatch && ! empty($breadCrumb = $exception->dataBreadCrumb())) {
                $message .= sprintf(' Field: %s', implode('.', $breadCrumb->buildChain()));
            }
        }

        return new ValidationException($message, 0, $previous);
    }
}
