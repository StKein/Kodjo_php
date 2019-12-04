<?php
namespace Kodjo\Content;

class TextStorageEng extends TextStorage{
	
	public function Language(){
		return Language::ENGLISH;
	}
	
	
	public function getMessage( $type ){
		$message = "";
		switch( $type ){
			case Text::GREETING:
				$message = "Guten tag and welcome to Kodjo 1.01!";
				break;
			case Text::GUIDE:
				$message = "To start a new game, enter \"".Command::NEW_GAME.
									"\"(without quotes). To see a list of available ".
									"commands, enter \"".Command::LIST."\".";
				break;
			case Text::UNKNOWN_COMMAND:
				$message = "Unknown command. To see a list of available ".
									"commands, enter \"".Command::LIST."\".";
				break;
			case Text::NEW_GAME:
				$message = "Started a new  game. Good luck!";
				break;
			case Text::HELP:
				$message = "Your goal is to clear the field by opening ".
									"pairs of the same items, one pair per move. ".
									"To open a pair of items, enter their respective IDs, ".
									"separated by space.";
				break;
			case Text::MOVE:
				$message = "Enter your next move.";
				break;
			case Text::GUESS_CORRECT:
				$message = "Items match! Well done.";
				break;
			case Text::GUESS_INCORRECT:
				$message = "Items don't match.";
				break;
			case Text::MOVE_INCORRECT:
				$message = "Incorrect move. Please enter two IDs of remaining items, separated by space.";
				break;
			case Text::LOSE:
				$message = "Alas, you lost the game. Don't get upset! Start a new game or switch to something else.";
				break;
			case Text::WIN:
				$message = "You won the game. Congratulations! Feel free to start a new one.";
				break;
			case Text::LIST:
				$message = "Available commands:";
				break;
			case Text::LIST_PS:
				$message = "Any other command will be treated as game move.";
				break;
			case Text::LANGUAGE_ALREADY_SET:
				$message = "Language already set to english.";
				break;
			case Text::LANGUAGE_SET:
				$message = "Language set to english.";
				break;
			case Text::FAREWELL:
				$message = "Au revoir! Come back any time.";
				break;
		}
		
		return $message;
	}
	
	public function getCommandDescription( $command ){
		$description = "";
		switch( $command ){
			case Command::NEW_GAME:
				$description = "Start a new game. You can set the field size after space, ".
									"for example, \"".Command::NEW_GAME." 6\" (without quotes). ".
									"Keep in mind that field is square and if you enter ".
									"odd number, it will be increased by 1.";
				break;
			case Command::HELP:
				$description = "Print help about the game.";
				break;
			case Command::LIST:
				$description = "Print list of commands and their description.";
				break;
			case Command::LANGUAGE:
				$description = "Sel text language in the game. Keep in mind that you can enter ".
										"either full name of language or short one. Available languages: ";
				break;
			case Command::EXIT:
				$description = "Exit the game.";
				break;
		}
		
		return $description;
	}
	
}
?>