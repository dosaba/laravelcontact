<?php

namespace App;

class Spam
{

	private static $wordsSpam=array(
				"viagra" 	=>5,
				"oferta" 	=>4,
				"ofertas"	=>4,
				"buy" 		=>5,
				"contactanos" 	=>3,
				"tarifas"	=>2,
				"stock"		=>1,
				
			);
		
	private static $limitspam=2.5;


	/**
		validador que cosidera si una palabra es spam o no
	*/
	public static function isSpam($string){

		$spamScore=self::getSpamScore($string);

		if($spamScore >$limitspam){
			return true;
		}
		return false;

	}

	/**
		calcula el spam score
	*/
	public static function getSpamScore($string){

		$matchFound = preg_match_all("/\b(" . implode(array_keys(self::$wordsSpam),"|") . ")\b/i", $string, $matches);
	
		$total=0;
		if($matchFound>0){	
			foreach($matches[0] as $m){
				$total+=self::$wordsSpam[$m];
			}
		}
		$amountWord=str_word_count($string);

		if($amountWord >0){
			return $total/$amountWord;
		}
		return 0;

	}
}
