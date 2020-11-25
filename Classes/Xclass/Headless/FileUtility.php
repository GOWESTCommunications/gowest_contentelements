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

use TYPO3\CMS\Core\Resource\FileReference;

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

        $return['properties']['copyright'] = $metaData['copyright'] ?: $fileReference->getProperty('copyright');

        return $return;
    }
}
