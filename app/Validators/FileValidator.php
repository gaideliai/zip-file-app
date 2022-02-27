<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;

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
                'files' => 'array|max_uploaded_file_size:1',
                'files.*' => 'file',
            ]
        );

        return $validator;
    }
}
