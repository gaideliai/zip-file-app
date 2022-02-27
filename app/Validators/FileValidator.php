<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\ValidationException;

class FileValidator
{
    /**
     * Validate request parameters
     *
     * @param array $files
     *
     * @return Validator
     */
    public function validateFile(array $files): Validator
    {
        $validator = ValidatorFacade::make(
            $files,
            [
                'files.*' => 'file|max:1024',
            ]
        );

        return $validator;
    }
}
