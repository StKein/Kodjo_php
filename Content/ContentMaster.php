<?php
namespace Kodjo\Content;

class ContentMaster {
	
	private $TextStorage;
	private $Page;
	private $Header;
	private $CurrentGameField;
	
	public function setPage( $page ){ $this->Page = $page; }
	public function setHeader( $header ){ $this->Header = $header; }
	public function setGameField( $game_field ){ $this->CurrentGameField = $game_field; }
	
	
	public function __construct(){
		$this->TextStorage = new TextStorageEng();
		$this->Page = Page::INDEX;
		$this->Header = "";
	}
	
	public function setLanguage( $language ){
		// TODO: get rid of this copypasta
		switch( $language ){
			case "en":
			case "eng":
			case "english":
				if( $this->TextStorage->Language() == Language::ENGLISH ){
					$this->println( $this->TextStorage->getMessage("language_already_set") );
				} else {
					$this->TextStorage = new TextStorageEng();
					$this->println( $this->TextStorage->getMessage("language_set") );
				}
				break;
			case "ru":
			case "rus":
			case "russian":
				if( $this->TextStorage->Language() == Language::RUSSIAN ){
					$this->println( $this->TextStorage->getMessage("language_already_set") );
				} else {
					$this->TextStorage = new TextStorageRus();
					$this->println( $this->TextStorage->getMessage("language_set") );
				}
				break;
		}
	}
	
	public function clearContent(){
		if( strncasecmp( PHP_OS, "win", 3 ) === 0 ){
			popen('cls', 'w');
		} else {
			echo exec('clear');
		}
	}
	
	public function printPage(){
		$this->printHeader();
		if( $this->Header ){
			$this->println("");
		}
		$this->printContent();
	}
	
	
	private function printHeader(){
		// TODO: get rid of THIS TRASH
		switch( $this->Header ){
			case Header::NEW_GAME:
				$this->println( $this->TextStorage->getMessage( Text::NEW_GAME ) );
				break;
			case Header::MOVE_INCORRECT:
				$this->println( $this->TextStorage->getMessage( Text::MOVE_INCORRECT ) );
				break;
			case Header::UNKNOWN_COMMAND:
				$this->println( $this->TextStorage->getMessage( Text::UNKNOWN_COMMAND ) );
				break;
			case Header::HELP:
				$this->println( $this->TextStorage->getMessage( Text::HELP ) );
				break;
			case Header::LIST:
				$this->println( $this->TextStorage->getMessage( Text::LIST ) );
				$guide = $this->TextStorage->getCommandsGuide();
				for( $i = 0; $i < count( $guide ); $i++ ){
					$this->println( $guide[$i] );
				}
				break;
		}
	}
	
	private function printContent(){
		// TODO: same as above (REEEEEEEEd)
		switch( $this->Page ){
			case Page::INDEX:
				$this->println( $this->TextStorage->getMessage( Text::GREETING ) );
				$this->println( $this->TextStorage->getMessage( Text::GUIDE ) );
				break;
			case Page::GAME:
				$this->printGameField();
				$this->println( $this->TextStorage->getMessage( Text::MOVE ) );
				break;
			case Page::GAME_GUESS_CORRECT:
				$this->printGameField();
				$this->println( $this->TextStorage->getMessage( Text::GUESS_CORRECT ) );
				$this->println( $this->TextStorage->getMessage( Text::MOVE ) );
				break;
			case Page::GAME_GUESS_INCORRECT:
				$this->printGameField();
				$this->println( $this->TextStorage->getMessage( Text::GUESS_INCORRECT ) );
				$this->println( $this->TextStorage->getMessage( Text::MOVE ) );
				break;
			case Page::GAME_LOSE:
				$this->printGameField();
				$this->println( $this->TextStorage->getMessage( Text::LOSE ) );
				break;
			case Page::GAME_WIN:
				$this->printGameField();
				$this->println( $this->TextStorage->getMessage( Text::WIN ) );
				$this->setPage( Page::INDEX );
				break;
			case Page::EXIT:
				$this->println( $this->TextStorage->getMessage( Text::FAREWELL ) );
				break;
		}
	}
	
	private function printGameField(){
		for( $i = 0; $i < count( $this->CurrentGameField ); $i++ ){
			for( $j = 0; $j < count( $this->CurrentGameField[$i] ); $j++ ){
				if( $j > 0 ){
					$this->print(" ");
				}
				$this->print( $this->CurrentGameField[$i][$j] );
			}
			$this->println("");
		}
	}
	
	private function println( $text ){
		$this->print( $text );
		$this->print( PHP_EOL );
	}
	
	private function print( $text ){
		// Don't ask
		print( $text );
	}
	
}
?>