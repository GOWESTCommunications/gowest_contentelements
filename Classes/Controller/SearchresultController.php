<?php

namespace GoWest\GowestContentelements\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Http\Message;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SearchresultController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * Index action for this controller.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
    */
    public function indexAction(ServerRequestInterface $request): ResponseInterface {

        $q = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('q');

        $options = [
            'w' =>  $q,
            "l" => 'test1'
        ]; 
        
        $response = new JsonResponse($options);
        

        return $response;

    }
}





