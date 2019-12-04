<?php
namespace Kodjo\Logic;

class GameMaster{
	
	private $Game;
	private $ContentMaster;
	
	const DEFAULT_GAME_SIZE = 4;
	
	
	public function __construct(){
		$this->ContentMaster = new \Kodjo\Content\ContentMaster();
		$this->ContentMaster->printPage();
	}
	
	// @param string $input
	public function processInput( $input ){
		$this->ContentMaster->clearContent();
		if( !$input ){
			$this->ContentMaster->setHeader("");
			$this->ContentMaster->printPage();
			return;
		}
		
		$input = explode( " ", $input );
		$this->processCommand( $input );
		$this->ContentMaster->printPage();
	}
	
	
	// @param string[] $input
	private function startGame( $input ){
		$size = self::DEFAULT_GAME_SIZE;
		if( count( $input ) == 2 ){
			$size = intval( $input[1] );
			if( $size < 2 ){
				$size = self::DEFAULT_GAME_SIZE;
			} elseif( $size % 2 == 1 ){
				$size++;
			}
		}
		$this->Game = new Game( $size );
	}
	
	// Input is console input split by " ", from processInput
	private function processMove( $input ){
		if( empty( $this->Game ) || !$this->Game->IsActive() || empty($input) || count($input) < 2 ){
			$this->ContentMaster->setHeader( \Kodjo\Content\Header::UNKNOWN_COMMAND );
			return;
		}
		
		if( !$this->Game->validateMove( intval( $input[0] ), intval( $input[1] ) ) ){
			$this->ContentMaster->setHeader( \Kodjo\Content\Header::MOVE_INCORRECT );
			$this->ContentMaster->setPage( \Kodjo\Content\Page::GAME );
			return;
		}
		
		$this->ContentMaster->setHeader( \Kodjo\Content\Header::MOVE_CORRECT );
		$this->ContentMaster->setGameField( $this->Game->getGameField() );
		if( $this->Game->guessIsCorrect() ){
			if( $this->Game->IsActive() ){
				$this->ContentMaster->setPage( \Kodjo\Content\Page::GAME_GUESS_CORRECT );
			} else {
				$this->ContentMaster->setPage( \Kodjo\Content\Page::GAME_WIN );
			}
		} else {
			$this->ContentMaster->setPage( \Kodjo\Content\Page::GAME_GUESS_INCORRECT );
		}
	}
	
	private function processCommand( $input ){
		switch( $input[0] ){
			case \Kodjo\Content\Command::NEW_GAME:
				$this->startGame( $input );
				$this->ContentMaster->setHeader( \Kodjo\Content\Header::NEW_GAME );
				$this->ContentMaster->setPage( \Kodjo\Content\Page::GAME );
				$this->ContentMaster->setGameField( $this->Game->getGameField() );
				break;
			case \Kodjo\Content\Command::HELP:
				$this->ContentMaster->setHeader( \Kodjo\Content\Header::HELP );
				break;
			case \Kodjo\Content\Command::LIST:
				$this->ContentMaster->setHeader( \Kodjo\Content\Header::LIST );
				break;
			case \Kodjo\Content\Command::LANGUAGE:
				$this->ContentMaster->setHeader("");
				$this->ContentMaster->setLanguage( $input[1] ?? "" );
				break;
			case \Kodjo\Content\Command::EXIT:
				$this->ContentMaster->setHeader("");
				$this->ContentMaster->setPage( \Kodjo\Content\Page::EXIT );
				break;
			// Move
			default:
				$this->processMove( $input );
				break;
		}
	}
	
}
?>