# phpBB Trim Message Tool #

This tool contains a class, that is able to trim a message from the phpbb message_parser to a maximum length without breaking the bbcodes/smilies and links.

## How to use ##

1. Add `nickvergessen/phpbb-tool-trimmessage` as a composer dependency to your extension
2. Use the code:

		$object = new \Nickvergessen\TrimMessage\TrimMessage($message, $bbcode_uid, $length);
		// Ready to get parsed:
		echo $object->message();

## How to run tests ##

We use Travis-CI as a continous intergtation server and phpunit for our unit testing. See more information on the [phpBB development wiki](https://wiki.phpbb.com/Unit_Tests).

[![Build Status](https://travis-ci.org/nickvergessen/phpbb-tool-trimmessage.png?branch=master)](https://travis-ci.org/nickvergessen/phpbb-tool-trimmessage)

1. `php composer.phar install --dev`
2. `vendor/bin/phpunit`

## Requirements ##
* This tool requires php 5.3.3 or above. When you include this tool in your MOD, put a note about the php-version in the author notes.
* This tool does not require a specific database.

## License ##
[GNU Public License](license.txt)
