# phpBB Trim Message Tool #

This tool contains a class, that is able to trim a message from the phpbb message_parser to a maximum length without breaking the bbcodes/smilies and links.

## How to use ##

1. Clone the tool into phpBB/ext/nickvergessen/trimmessage
2. Use the code:

		$object = new \nickvergessen\trimmessage\trim_message($message, $bbcode_uid, $length);
		// Ready to get parsed:
		echo $object->message();

## How to run tests ##

1. `cd ext/nickvergessen/trimmessage`
2. `..\..\..\vendor\bin\phpunit`

## Requirements ##
* This tool requires php 5.3.3 or above. When you include this tool in your MOD, put a note about the php-version in the author notes.
* This tool requires phpBB 3.1.0-a1 or above.
* This tool does not require a specific database.

## License ##
[GNU Public License](license.txt)
