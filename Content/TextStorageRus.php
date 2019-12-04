<?php
namespace Kodjo\Content;

class TextStorageRus extends TextStorage{
	
	public function Language(){
		return Language::RUSSIAN;
	}
	
	
	public function getMessage( $type ){
		$message = "";
		switch( $type ){
			case Text::GREETING:
				$message = "Guten tag и добро пожаловать в Kodjo 1.01!";
				break;
			case Text::GUIDE:
				$message = "Чтобы начать новую игру, введите \"".Command::NEW_GAME.
									"\" (без кавычек). Для получения списка доступных команд ".
									"введите \"".Command::LIST."\".";
				break;
			case Text::UNKNOWN_COMMAND:
				$message = "Неизвестная команда. Для получения списка доступных команд ".
									"введите \"".Command::LIST."\".";
				break;
			case Text::NEW_GAME:
				$message = "Начата новая игра. GLHF!";
				break;
			case Text::HELP:
				$message = "Задача - очистить поле, открывая попарно одинаковые элементы. ".
									"Чтобы открыть пару элементов, введите их ID через пробел.";
				break;
			case Text::MOVE:
				$message = "Введите следующий ход.";
				break;
			case Text::GUESS_CORRECT:
				$message = "Элементы совпали, отлично!";
				break;
			case Text::GUESS_INCORRECT:
				$message = "Элементы не совпали.";
				break;
			case Text::MOVE_INCORRECT:
				$message = "Некорректный ход. Введите два ID элементов, оставшихся на поле, через пробел,";
				break;
			case Text::LOSE:
				$message = "Увы, вы проиграли. Не расстраивайтесь! Начните новую игру или займитесь чем-то другим.";
				break;
			case Text::WIN:
				$message = "Ура, победа! Если хотите, начните новую игру.";
				break;
			case Text::LIST:
				$message = "Список команд:";
				break;
			case Text::LIST_PS:
				$message = "Любая иная команда будет считаться ходом в игре.";
				break;
			case Text::LANGUAGE_ALREADY_SET:
				$message = "Уже установлен русский язык.";
				break;
			case Text::LANGUAGE_SET:
				$message = "Установлен русский язык.";
				break;
			case Text::FAREWELL:
				$message = "До встречи!";
				break;
		}
		
		return $message;
	}
	
	public function getCommandDescription( $command ){
		$description = "";
		$no_quotes = " (without quotes)";
		switch( $command ){
			case Command::NEW_GAME:
				$description = "Начать новую игру. Вы можете установить размер поля, ".
										"указав его через пробел, например, \"".Command::NEW_GAME.
										" 6\" (без кавычек). Имейте в виду, что в данной версии игры ".
										"поле квадратное и при вводе нечетного числа в качестве размера ".
										"оно будет увеличено на 1.";
				break;
			case Command::HELP:
				$description = "Вывод справки по игре.";
				break;
			case Command::LIST:
				$description = "Допустимые команды и их пояснения.";
				break;
			case Command::LANGUAGE:
				$description = "Установить язык текста в игре. Можно ввести как полное название, так и сокращенное. Возможные языки: ";
				break;
			case Command::EXIT:
				$description = "Выход из игры.";
				break;
		}
		
		return $description;
	}
	
}
?>