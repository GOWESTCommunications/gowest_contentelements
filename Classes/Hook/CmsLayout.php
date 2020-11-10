<?php
namespace GoWest\GowestContentelements\Hook;

class CmsLayout
{
    //for labeling actions in backend
	function list_type_Info(&$params, &$pObj) {
		return  '<strong>' . $params['row']['list_type'] . '</strong><br> Plugin: ' . $params['row']['pi_flexform'];
	}
}