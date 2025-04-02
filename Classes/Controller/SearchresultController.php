<?php

namespace GoWest\GowestContentelements\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Http\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SearchresultController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    private $results = [];

    /**
     * Initialize Action will performed before each action will be executed
     *
     * @return void
     */
    public function __construct()
    {
        $this->dbConnections = [
            'pages' => GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('pages'),
        ];
    }

    /**
     * Index action for this controller.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function indexAction(ServerRequestInterface $request): ResponseInterface
    {
        $q = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('q');
        $lang = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('lang');
        try {
            if ($q) {
                $this->get_pages_by_bodytext($q, $lang, 20);
                $this->get_pages_by_h2($q, $lang, 30);
                $this->get_pages_by_sectioncontent($q, $lang, 50);
                $this->get_pages_by_desc_keywords($q, $lang, 60);
                $this->get_pages_by_category($q, $lang, 80);
                $this->get_pages_by_title($q, $lang, 100);
            }
            usort($this->results, function ($a, $b) {
                return $b['weight'] <=> $a['weight'];
            });
            if(!is_array($this->results) || count($this->results) === 0) {
                $response = new JsonResponse([]);
                $response->setPayload([]);
            } else {
                $response = new JsonResponse($this->results);
            }
            
        } catch (\Throwable $th) {
            $response = new JsonResponse([]);
            $response->setPayload([]);
        }

        return $response;
    }

    function get_pages_by_title($searchword, $lang, $weight)
    {
        $query = "SELECT
                    `uid`,
                    `title`,
                    `subtitle`,
                    `description`,
                    `nav_title`,
                    `keywords`,
                    `sys_language_uid`,
                    `slug`
                FROM
                    `pages`
                WHERE
                    `doktype` = 1
                    AND `sys_language_uid` = ?
                    AND `hidden` = 0
                    AND `deleted` = 0
                    AND (
                        `title` LIKE ?
                        OR `nav_title` LIKE ?
                    )";

        $this->get_results($query, $weight, [$lang, '%' . $searchword . '%', '%' . $searchword . '%']);
    }

    function get_pages_by_category($searchword, $lang, $weight)
    {
        $query = "SELECT
                    `sys_category_record_mm`.`uid_foreign`,
                    `category`.`title`,
                    `page`.`uid`,
                    `page`.`title`,
                    `page`.`description`,
                    `page`.`slug`
                FROM
                    `sys_category_record_mm`
                    INNER JOIN `sys_category` `category` ON `sys_category_record_mm`.`uid_local` = `category`.`uid`
                    INNER JOIN `pages` `page` ON `sys_category_record_mm`.`uid_foreign` = `page`.`uid`
                WHERE
                    `tablenames` = 'pages'
                    AND `category`.`title` LIKE ?
                    AND `page`.`sys_language_uid` = ?
                    AND `category`.`sys_language_uid` = ?
                    AND `category`.`hidden` = 0
                    AND `category`.`deleted` = 0
                    AND `page`.`deleted` = 0
                    AND `page`.`hidden` = 0
                    AND `page`.`doktype` = 1";

        $this->get_results($query, $weight, ['%' . $searchword . '%', $lang, $lang]);
    }

    function get_pages_by_desc_keywords($searchword, $lang, $weight)
    {
        $query = "SELECT
                    `uid`,
                    `title`,
                    `subtitle`,
                    `description`,
                    `slug`,
                    `keywords`
                FROM
                    `pages`
                WHERE
                    `doktype` = 1
                    AND `sys_language_uid` = ?
                    AND `hidden` = 0
                    AND `deleted` = 0
                    AND (
                        `keywords` LIKE ?
                        OR `description` LIKE ?
                    )";

        $this->get_results($query, $weight, [$lang, '%' . $searchword . '%', '%' . $searchword . '%']);
    }

    function get_pages_by_sectioncontent($searchword, $lang, $weight)
    {
        $query = "SELECT
                    `uid`,
                    `sys_language_uid`,
                    `title`,
                    `subtitle`,
                    `description`,
                    `slug`,
                    `keywords`,
                    `tx_sectioncontent_abstract_title`,
                    `tx_sectioncontent_abstract_subtitle`,
                    `tx_sectioncontent_abstract_description`
                FROM
                    `pages`
                WHERE
                    (
                        `tx_sectioncontent_abstract_title` LIKE ?
                        OR `tx_sectioncontent_abstract_subtitle` LIKE ?
                        OR `tx_sectioncontent_abstract_description` LIKE ?
                    )
                    AND `hidden` = 0
                    AND `deleted` = 0
                    AND `doktype` = 1
                    AND `sys_language_uid` = ?";

        $this->get_results($query, $weight, ['%' . $searchword . '%', '%' . $searchword . '%', '%' . $searchword . '%', $lang]);
    }

    function get_pages_by_h2($searchword, $lang, $weight)
    {
        $query = "SELECT
                    `page`.`uid`,
                    `page`.`sys_language_uid`,
                    `page`.`title`,
                    `page`.`subtitle`,
                    `page`.`description`,
                    `page`.`slug`
                FROM
                    `tt_content`
                    RIGHT JOIN `pages` `page` ON `tt_content`.`pid` = `page`.`uid`
                WHERE
                    `tt_content`.`header` LIKE ?
                    AND `page`.`sys_language_uid` = ?
                    AND `page`.`hidden` = 0
                    AND `page`.`deleted` = 0
                    AND `page`.`doktype` = 1
                    AND `tt_content`.`sys_language_uid` = ?
                    AND `tt_content`.`deleted` = 0
                    AND `tt_content`.`hidden` = 0";

        $this->get_results($query, $weight, ['%' . $searchword . '%', $lang, $lang]);
    }

    function get_pages_by_bodytext($searchword, $lang, $weight)
    {
        $query = "SELECT
                    `page`.`uid`,
                    `page`.`sys_language_uid`,
                    `page`.`title`,
                    `page`.`subtitle`,
                    `page`.`description`,
                    `page`.`slug`
                FROM
                    `tt_content`
                    RIGHT JOIN `pages` `page` ON `tt_content`.`pid` = `page`.`uid`
                WHERE
                    (
                        `tt_content`.`bodytext` LIKE ?
                        OR `tt_content`.`pi_flexform` LIKE ?
                    )
                    AND `page`.`sys_language_uid` = ?
                    AND `page`.`hidden` = 0
                    AND `page`.`deleted` = 0
                    AND `page`.`doktype` = 1
                    AND `tt_content`.`sys_language_uid` = ?
                    AND `tt_content`.`deleted` = 0
                    AND `tt_content`.`hidden` = 0";

        $this->get_results($query, $weight, ['%' . $searchword . '%', '%' . $searchword . '%', $lang, $lang]);
    }

    function get_results($query, $weight, $params)
    {
        $statement = $this->dbConnections['pages']->prepare($query);
        $statement->execute($params);

        while ($row = $statement->fetchAssociative()) {
            $this->results[$row['uid']]['uid'] = $row['uid'];
            $this->results[$row['uid']]['title'] = $row['title'];
            $this->results[$row['uid']]['subtitle'] = $row['subtitle'];
            $this->results[$row['uid']]['description'] = $row['description'];
            $this->results[$row['uid']]['nav_title'] = $row['nav_title'] ?? null;
            $this->results[$row['uid']]['slug'] = $row['slug'];
            $this->results[$row['uid']]['keywords'] = $row['keywords'] ?? null;
            $this->results[$row['uid']]['sys_language_uid'] = $row['sys_language_uid'];
            $this->results[$row['uid']]['weight'] = $weight;
        }
    }
}
