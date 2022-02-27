<?php

namespace App\Http\Controllers;

use App\Services\FileServiceInterface;
use App\Validators\FileValidator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller
{
    /**
     * FileController constructor.
     *
     * @param FileServiceInterface $fileService
     * @param FileValidator $fileValidator
     */
    public function __construct(
        private FileServiceInterface $fileService,
        private FileValidator $fileValidator
    ) {
    }

    /**
     * Archive uploaded files
     *
     * @param Request $request
     *
     * @return BinaryFileResponse
     */
    public function archiveFiles(Request $request): BinaryFileResponse
    {
        $files = $request->allFiles();

        $this->fileValidator->validateFile($files)->validate();

        $fileZip = $this->fileService->archiveFiles($files['files']);

        $response = response()->download($fileZip);

        register_shutdown_function('unlink', $fileZip);

        return $response;
    }
}
