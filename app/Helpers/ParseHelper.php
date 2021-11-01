<?php


namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

class ParseHelper{

	public static $predicates = [];
	public static function setPredicates($item){
		return function(Builder $q) use($item){
			$q->where($item['column'], $item['operator'], $item['value']);
		};
	}
	public static function logicalСonnection($item, $arr){
		if(preg_match("/\d+and\d+/", $item, $matches)) {
			if(mb_strlen($item) == mb_strlen($matches[0])) {
				preg_match_all("/\d+/", $item, $matches);
				if(!(isset($arr[$matches[0][0]]) && isset($arr[$matches[0][1]]))){
					throw new \Exception("The necessary predicates are missing");
				}
				return function($q) use ($arr, $matches){
					$q->where($arr[$matches[0][0]]);
					$q->where($arr[$matches[0][1]]);
				};
			} else {
				throw new \Exception("Invalid logical expression");
			}
		} elseif(preg_match("/\d+or\d+/", $item, $matches)){
			if(mb_strlen($item) == mb_strlen($matches[0])) {
				preg_match_all("/\d+/", $item, $matches);
				if(!(isset($arr[$matches[0][0]]) && isset($arr[$matches[0][1]]))){
					throw new \Exception("The necessary predicates are missing");
				}
				return function($q) use ($arr, $matches){
					$q->where($arr[$matches[0][0]]);
					$q->orWhere($arr[$matches[0][1]]);
				};
			} else {
				throw new \Exception("Invalid logical expression");
			}
		}elseif(preg_match("/\d/", $item, $matches)){
			return function($q) use ($arr, $matches){
				$q->where($arr[$matches[0]]);
			};
		} else{
			dd($item);
			throw new \Exception("Invalid logical expression");
		}
	}
	public static function makeQueryBuilder($items, $query){
		$current_index = count($items)+1;
		$arr[$current_index] = $query;
		$current_index++;
		//избавляемся от скобок
		$is_work = true;
		while($is_work){
			$is_work = false;
			foreach($arr as $key => $query){
				while(getBracketsPosition($query)){
					$is_work = true;
					$pos = getBracketsPosition($query);
					$arr[$current_index] = substr($query, $pos[0]+1, $pos[1]-$pos[0]-1);
					$arr[$key] = substr_replace($query, $current_index, $pos[0], $pos[1]-$pos[0]+1);
					$query = $arr[$key];
					$current_index++;
				}
			}
		}
		$is_work = true;
		while($is_work) {
			$is_work = false;
			foreach($arr as $key => $query){
				while(preg_match("/\d+and\d+/", $query, $matches)){
					if(mb_strlen($query) == mb_strlen($matches[0])){
						break;
					}
					$arr[$key] = str_replace($matches[0],$current_index, $query);
					$query = str_replace($matches[0],$current_index, $query);
					$arr[$current_index] = $matches[0];
					$current_index++;
				}
				while(preg_match("/\d+or\d+/", $query, $matches)){
					if(mb_strlen($query) == mb_strlen($matches[0])){
						break;
					}
					$arr[$key] = str_replace($matches[0],$current_index, $query);
					$query = str_replace($matches[0],$current_index, $query);
					$arr[$current_index] = $matches[0];
					$current_index++;
				}
			}
		}

		foreach($items as $key => $item){
			$arr[$key] = \App\Helpers\ParseHelper::setPredicates($item);
		}
		for($i = count($arr); $i > 0; $i--){
			if(is_string($arr[$i])){
				$arr[$i] = \App\Helpers\ParseHelper::logicalСonnection($arr[$i], $arr);
			}
		}
		return $arr[count($items)+1];
	}

}