<?php

namespace GoWest\GowestContentelements\Xclass;

use Aws\Exception\MultipartUploadException;
use Aws\S3\MultipartUploader;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class MultipartUploaderAdapter extends \AUS\AusDriverAmazonS3\S3Adapter\MultipartUploaderAdapter
{
    /**
     * @param string $localFilePath File path and name on local storage
     * @param string $targetFilePath File path and name on target S3 bucket
     * @param string $bucket S3 bucket name
     * @param string $cacheControl Cache control header
     */
    public function upload(string $localFilePath, string $targetFilePath, string $bucket, string $cacheControl)
    {
        
        /** Upload with correct SVG MimeType so it will be displayed in our frontend as expected **/
        $fileInfo = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Type\File\FileInfo::class, $localFilePath);
        $contentType = $fileInfo->getMimeType();
        $contentType = $contentType == 'image/svg' ? 'image/svg+xml' : $contentType;

        $uploader = new MultipartUploader($this->s3Client, $localFilePath, [
            'bucket' => $bucket,
            'key' => $targetFilePath,
            'params' => [
                'ContentType' => $contentType,
                'CacheControl' => $cacheControl,
            ],
        ]);

        // Upload and recover from errors
        do {
            try {
                $result = $uploader->upload();
            } catch (MultipartUploadException $e) {
                $uploader = new MultipartUploader($this->s3Client, $localFilePath, [
                    'state' => $e->getState(),
                ]);
            }
        } while (!isset($result));

        // Abort a multipart upload if failed
        try {
            $uploader->upload();
        } catch (MultipartUploadException $e) {
            // State contains the "Bucket", "Key", and "UploadId"
            $params = $e->getState()->getId();
            $this->s3Client->abortMultipartUpload($params);
            throw $e;
        }
    }
}
