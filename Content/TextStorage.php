<?php
namespace Kodjo\Content;

abstract class TextStorage{
	
	public function getCommandsGuide(){
		$guide = array();
		$commands = ( new \ReflectionClass("\\Kodjo\\Content\\Command") )->getConstants();
		foreach( $commands as $command ){
			$desc = $this->getCommandDescription( $command );
			if( $command === Command::LANGUAGE ){
				$desc .= $this->getLanguagesContcat();
			}
			
			$guide[] = $command." - ".$desc;
		}
		
		return $guide;
	}
	
	
	protected function getLanguagesContcat(){
		$langs = ( new \ReflectionClass("\\Kodjo\\Content\\Language") )->getConstants();
		
		return implode( ", ", $langs );
	}
	
	
	public abstract function Language();
	public abstract function getMessage( $type );
	public abstract function getCommandDescription( $command );
	
}
?>