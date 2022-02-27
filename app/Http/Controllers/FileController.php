<?php

namespace App\Http\Controllers;

use App\Services\FileServiceInterface;
use App\Services\UploadStatisticsServiceInterface;
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
     * @param UploadStatisticsServiceInterface $uploadStatisticsService
     */
    public function __construct(
        private FileServiceInterface $fileService,
        private FileValidator $fileValidator,
        private UploadStatisticsServiceInterface $uploadStatisticsService
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

        $ipAddress = $request->ip();

        $this->uploadStatisticsService->insertUploadStatistics($ipAddress);

        return $response;
    }
}
