<?php

namespace GoWest\GowestContentelements\Controller;


class CsvtablesController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * Index action for this controller.
     *
     * @return void
    */
    public function indexAction() {
        $this->logger = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Log\LogManager')->getLogger(__CLASS__);
        $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();
        $csv = $resourceFactory->getFileObject($this->settings['file'])->getPublicUrl();
        $this->data = $this->get_csv($csv);

        
        //$this->parse_number();
        //$this->set_current();
        if($this->settings['noPast']) {
            $this->delete_past();
        }
        
        return json_encode($this->data);
    }

    public function set_current() {
        $cur = time();
       
        foreach ($this->data as $key=>$table) {
            for ($i = 3; $i < count($table[0]); $i++) {
                if ($table[0][$i]['start'] <= $cur && $table[0][$i]['end'] >= $cur) {
                    $this->data[$key][0][$i]['current'] = true;
                    break;
                }
            }
        }
    }
    
    public function delete_past() {
        $cur = time();
        for ($i = 3; $i < count($this->data[0]); $i++) {
            if ($this->data[0][$i]['start'] <= $cur && $this->data[0][$i]['end'] < $cur) {
                unset($this->data[0][$i]);
                unset($this->data[1][$i]);
                unset($this->data[2][$i]);

                $this->data[0] = array_merge($this->data[0]);
                $this->data[1] = array_merge($this->data[1]);
                $this->data[2] = array_merge($this->data[2]);

                for ($j=3; $j < count($this->data); $j++) {
                    unset($this->data[$j][$i]);

                    $this->data[$j] = array_merge($this->data[$j]);
                }
            } 
        }
    }

    public function parse_number() {
        
        foreach ($this->data as $item=>$table) {
            
            if(!$table || !$table[3]) { return; }
            
            for ($rooms = 3; $rooms < count($this->data[$item]); $rooms++) {
               
               for($prices = 3; $prices < count($this->data[$item][$rooms]); $prices++) {
                    // ist der wert mehr oder weniger numerisch - ziffern von 0-9 Komma oder Punkt

					if (preg_match('#^(?:[0-9]|\.|,)+$#', $this->data[$item][$rooms][$prices])) {
                        
                        // wenn nur 1 Trennzeichen existiert und dieses von 1 oder 2 ziffern gefolgt wird, ist des der Separator, wenn es ein Komma ist ersetzen
                        if (preg_match('#(\d+)((\.|,)\d{1,2})?#', $table[$rooms][$prices])) {
                            $this->data[$item][$rooms][$prices] = (float)str_replace(',', '.', $this->data[$item][$rooms][$prices]);
                        }
                        
                        // wenn mehrere Trennzeichen vorkommen und das Komma vor dem Punkt liegt, nichts unternehmen
                        if (preg_match('#\,.+\.\d{1,2}$#', $table[$rooms][$prices])) {
                            $this->data[$item][$rooms][$prices] = (float)str_replace(',', '', $this->data[$item][$rooms][$prices]);
                        }
                        
                        // in allen anderen Fällen wird der Punkt entfernt und dann das Komma durch einen Punkt ersetzt.

						$this->data[$item][$rooms][$prices] = (float)str_replace(
							array(
								'.',
								','
							),
							array(
								'',
								'.'
							),
							$this->data[$item][$rooms][$prices]
						);

                    }
					
					$value = $this->data[$item][$rooms][$prices];
					if(is_float($value)) {
						unset($this->data[$item][$rooms][$prices]);
						$this->data[$item][$rooms][$prices] = array(
							'value' => $value,
							'type'  => 'float'
						);
					} else {
						unset($this->data[$item][$rooms][$prices]);
						$this->data[$item][$rooms][$prices] = array(
							'value' => $value,
							'type'  => 'string'
						);
					}

                }
				
	
            }
        }  
    }

    public function get_csv($file) {
        
        $str = file_get_contents($file);
        if (mb_detect_encoding($str) !== 'UTF-8') {
            $str = utf8_encode($str);
        }
        
        $lines = preg_split('/\n|\r\n?/', $str);
        

        foreach ($lines as $line) {
            $data[] = str_getcsv($line, ';', '"', '"');
        }

       //foreach($data as $key=>$value) {
       //    foreach($data[$key] as $k=>$v) {
       //        if(strpos($data[$key][$k], '*') == true) {
       //            $data[$key][$k] = str_replace("*", ",00 € *", "*")
       //            var_dump($data[$key][$k])
       //        } 
       //        
       //    }
       //    
       //}
        
        if($this->settings['cols']) {
                // remove unwanted colums ($j) -> Columns that have no LinkID or where LinkID is not the same as current page ID
				foreach($data[2] as $j=>$col) {
                    
					if ($j > 2) {
						if(!(($col != '' && intval($col) === 0) || $col == $GLOBALS['TSFE']->id)) {
							foreach($data as $i=>$row) {
								unset($data[$i][$j]);
							}
						}
					}
				}
				foreach($data as $i=>$row) {
					$data[$i] = array_values($row);
				}
		}
			
        if($this->settings['rows']) {
            // remove unwanted rows ($i)
            foreach($data as $i=>$row) {
                $data[$i] = array_values($row);
                    
                if ($i > 2) {
                    if(!(($row[2] != '' && intval($row[2]) === 0) || $row[2] == $GLOBALS['TSFE']->id)) {
                        unset($data[$i]);
                    }
                }
            }
            $data = array_values($data);
        }
            
        //removed, because makes no sense here? 
        //foreach ($data as $key=>$row) {
        //    //var_dump($key);
        //    if ($key > 2) {
        //     
        //        $data[$key][0] = explode('|', $row[0]);
        //        $data[$key][1] = explode('|', $row[1]);
        //    }
        //    
        //}
        
        for ($i = 3; $i < count($data[0]); $i++) {
            
            if(preg_match('#(\d{4})-(\d{2})-(\d{2})/(\d{4})-(\d{2})-(\d{2})#', $data[0][$i], $interval)) {
                $interval['start'] = mktime(0, 0, 0, $interval[2], $interval[3], $interval[1]);
                $interval['end']   = mktime(0, 0, 0, $interval[5], $interval[6], $interval[4]);
                unset($data[0][$i]);
                $data[0][$i]['start'] = $interval['start'];
                $data[0][$i]['end'] = $interval['end'];
                			
                $this->logger->info(
                    'parsed interval',
                    array($interval)
                );
            }
            $data[$i][2] = $GLOBALS['TSFE']->cObj->typoLink_URL(
                array(
                    'parameter' => $data[$i][2],
                    'forceRelativeUrl' => false,
                )
            );
            
			$data[0][$i]['name'] = $data[1][$i];
            $data[0][$i]['link'] = $data[2][$i];
			
			// derive class based from season name
            $data[0][$i]['class'] = strtolower(str_replace(
				array(' '),
				'',
            $data[1][$i]));  
        }
		return $data;
	}  
}