<?php

namespace Nzo\JsonSchemaValidatorBundle\Validator;

use League\OpenAPIValidation\PSR7\ValidatorBuilder as PSR7ValidatorBuilder;

class ValidatorFactory
{
    public function build(string $path): Validator
    {
        $builder =  (new PSR7ValidatorBuilder())->fromYamlFile($path);

        return new Validator($builder->getRoutedRequestValidator(), $builder->getResponseValidator());
    }


}
