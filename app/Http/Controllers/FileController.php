<?php

namespace App\Http\Controllers;

use App\Services\FileServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller
{
    /**
     * FileController constructor.
     *
     * @param FileServiceInterface $fileService
     */
    public function __construct(
        private FileServiceInterface $fileService,
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

        $fileZip = $this->fileService->archiveFiles($files);

        $response = response()->download($fileZip);

        register_shutdown_function('unlink', $fileZip);

        return $response;
    }
}
