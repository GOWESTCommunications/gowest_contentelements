<?php

/*
 * This file is part of the "headless" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 *
 * (c) 2020
 */

declare(strict_types=1);

namespace GoWest\GowestContentelements\Xclass\Headless;

use TYPO3\CMS\Core\Resource\AbstractFile;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Connection;

/**
 * Class FileUtility
 */
class FileUtility extends \FriendsOfTYPO3\Headless\Utility\FileUtility
{

    /**
     * @param FileReference|File $fileReference
     * @param $dimensions
     * @param $cropVariant
     * @return array
     */
    public function processFile($fileReference, array $dimensions = [], $cropVariant = 'default'): array
    {
        $return = parent::processFile($fileReference, $dimensions, $cropVariant);
        $metaData = $fileReference->toArray();

        // Add categories of default language to files
        $metaDataUid = $fileReference->getProperty('metadata_uid');
        if($metaDataUid > 0) {
            $dbConnection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('sys_category_record_mm');

            $query = "
                SELECT 
                    c.*
                FROM
                    sys_category_record_mm cmm
                    JOIN sys_file_metadata meta ON meta.uid = cmm.uid_foreign
                    JOIN sys_category c ON c.uid = cmm.uid_local
                WHERE
                    cmm.tablenames = 'sys_file_metadata' 
                    AND cmm.uid_foreign = " . $metaDataUid . "
                ;
            ";

            $statement = $dbConnection->prepare($query);
            $statement->execute();
            $fileCategories = [];
            while ($row = $statement->fetch()) {
                $fileCategories[] = [
                    "uid"       => $row['uid'],
                    "parent"    => $row['parent'],
                    "title"     => $row['title'],
                ];
            }

            $return['properties']['categories'] = $fileCategories;
        }

        // temporary fix for pdf thumbnail
        if($fileReference->getType() !== AbstractFile::FILETYPE_IMAGE && $fileReference->getMimeType() === 'application/pdf') {
            $fileReference = $this->processImageFile($fileReference, $dimensions, $cropVariant);
            $publicUrl = $this->getImageService()->getImageUri($fileReference, true);
            $return['publicUrl'] = $publicUrl;
            $return['properties']['mimeType'] = $fileReference->getMimeType();
            $return['properties']['type'] =  explode('/', $fileReference->getMimeType())[0];
            $return['properties']['filename'] = $fileReference->getProperty('name');
            $return['properties']['size'] = $this->calculateKilobytesToFileSize((int)$fileReference->getSize());
            $return['properties']['dimenstions'] = [
                'width' => $fileReference->getProperty('width'),
                'height' => $fileReference->getProperty('height'),
            ];
        }

        $return['properties']['copyright'] = $metaData['copyright'] ?: $fileReference->getProperty('copyright');

        return $return;
    }
}
