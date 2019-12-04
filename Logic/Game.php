<?php
namespace Kodjo\Logic;

class Game{
	
	private $RemainingPairs;
	private $Field;
	private $Move;
	private $ItemSize;
	private $FieldSize;
	
	public function getRemainingPairs(){ return $this->RemainingPairs; }
	public function IsActive(){ return ( $this->RemainingPairs > 0 ); }
	public function getGameField(){
		$field = array();
		for( $i = 0; $i < $this->FieldSize; $i++ ){
			$field[$i] = array();
			for( $j = 0; $j < $this->FieldSize; $j++ ){
				if(
					$this->Field[$i][$j] == "" || 
					$i == $this->Move[0][0] && $j == $this->Move[0][1] || 
					$i == $this->Move[1][0] && $j == $this->Move[1][1] 
				){
					$field[$i][$j] = $this->Field[$i][$j];
				} else {
					$field[$i][$j] = ( $i * count( $this->Field[$i] ) + $j + 1 )."";
				}
				while( mb_strlen( $field[$i][$j] ) < $this->ItemSize ){
					$field[$i][$j] = " ".$field[$i][$j];
				}
			}
		}
		
		return $field;
	}
	
	
	// @param $size int
	public function __construct( $size ){
		if( $size % 2 == 1 ){
			$size++;
		}
		if( $size < 2 ){
			throw new Exception("Incorrect field size!");
		}
		
		$this->Field = array();
		$this->FieldSize = $size;
		$this->RemainingPairs = $size * $size / 2;
		$this->Move = [ [-1, -1], [-1, -1] ];
		$this->ItemSize = 3;
		
		$this->setField();
	}
	
	public function validateMove( $id1, $id2 ){
		if(
			$id1 <= 0 || $id2 <= 0 || 
			$id1 > $this->FieldSize * $this->FieldSize || 
			$id2 > $this->FieldSize * $this->FieldSize
		){
			return false;
		}
		
		$this->Move[0][0] = floor( ( $id1 - 1 ) / $this->FieldSize );
		$this->Move[0][1] = ( $id1 - 1 ) % $this->FieldSize;
		$this->Move[1][0] = floor( ( $id2 - 1 ) / $this->FieldSize );
		$this->Move[1][1] = ( $id2 - 1 ) % $this->FieldSize;
		
		return true;
	}
	
	public function guessIsCorrect(){
		if( $this->Field[ $this->Move[0][0] ][ $this->Move[0][1] ] === $this->Field[ $this->Move[1][0] ][ $this->Move[1][1] ] ){
			$this->Field[ $this->Move[0][0] ][ $this->Move[0][1] ] = "";
			$this->Field[ $this->Move[1][0] ][ $this->Move[1][1] ] = "";
			$this->RemainingPairs--;
			return true;
		} else {
			return false;
		}
	}
	
	
	private function setField(){
		$items = array();
		$item = "";
		for( $i = 0; $i < $this->RemainingPairs; $i++ ){
			do {
				$item = $this->generateItem();
			} while( !empty( $items[ $item ] ) );
			
			$this->addItemToField( $item );
		}
	}
	
	private function generateItem(){
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		$len = mb_strlen( $alphabet );
		$item = "";
		for( $i = 0; $i < $this->ItemSize; $i++ ){
			$item .= $alphabet[ rand( 0, $len ) ];
		}
		
		return $item;
	}
	
	private function addItemToField( $item ){
		$row = 0;
		$col = 0;
		
		do {
			$row = rand( 0, $this->FieldSize - 1 );
			$col = rand( 0, $this->FieldSize - 1 );
		} while( !empty( $this->Field[$row][$col] ) );
		$this->Field[$row][$col] = $item;
		
		do {
			$row = rand( 0, $this->FieldSize - 1 );
			$col = rand( 0, $this->FieldSize - 1 );
		} while( !empty( $this->Field[$row][$col] ) );
		$this->Field[$row][$col] = $item;
	}
	
}
?>