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
class GalleryProcessor extends \FriendsOfTYPO3\Headless\DataProcessing\GalleryProcessor
{

    /**
     * Disable this behaviour as we do the cropping in frontend via API
     */
    protected function calculateMediaWidthsAndHeights() {}
}
