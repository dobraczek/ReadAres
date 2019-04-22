<?php

/**
 * Read Ares
 * @author Dobr@CZek
 * @link http://webscript.cz
 * @version 1.0
 */

namespace ReadAres;

class Read {

	public $ic;
	public $link;
	
	public function __construct($ic = null) {
		$this->ic = $ic;
		$this->link = 'https://wwwinfo.mfcr.cz/cgi-bin/ares/darv_res.cgi';
	}
	
	private function file_get_contents_curl($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	
	public function testIC() {
	    
		$in = $this->file_get_contents_curl($this->link."?ico=".$this->ic."&jazyk=cz&xml=1");
	    
		preg_match_all('/<D:ET>(.*?)</s', $in, $error);
	    
		if($error[1][0]) {
	        
			$output = array('error' => $error[1][0]);
	    
		} else {
	        
			$tag = array(
				'ICO' => 'IČ',
				'OF' => 'Firma',
				'N' => 'Město',
				'NU' => 'Ulice',
				'CD' => 'ČP',
				'PSC' => 'PSČ',
				'NPF' => 'Právní forma',
				'Nazev_NACE' => 'ekonomické činnosti',
				'KPP' => 'velikostní kat. dle počtu zam.',
				'Zuj_kod_orig' => 'ZÚJ kód',
				'NZUJ' => 'ZÚJ'
			);
    	    
			foreach ($tag as $key => $value) {
				preg_match_all('/<D:'.$key.'>(.*?)</s', $in, $out);
				$output[] = array(
					'name' => $value,
					'value' => $out[1][0]
				);
			}
    	    
		}
	    
		return json_encode($output);
	}
	
}
