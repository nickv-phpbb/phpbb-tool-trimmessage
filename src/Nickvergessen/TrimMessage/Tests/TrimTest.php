<?php
/**
 *
 * @package phpBB Translation Validator
 * @copyright (c) 2014 phpBB Ltd.
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */
namespace Nickvergessen\TrimMessage\Tests;

class TrimTest extends \PHPUnit_Framework_TestCase
{
	public function trim_message_data()
	{
		$messages = array(
			array(
				'message'		=> '[quote=&quot;nickv&quot;:l0nwstsc]foobar[/quote:l0nwstsc][quote=&quot;nickv&quot;:l0nwstsc]foobar[/quote:l0nwstsc]',
				'bbcode_uid'	=> 'l0nwstsc',
			),
			array(
				'message'		=> 'h<!-- s:geek: --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt=":geek:" title="Geek" /><!-- s:geek: -->h<!-- s:geek: --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt=":geek:" title="Geek" /><!-- s:geek: -->h',
				'bbcode_uid'	=> 'foobar',
			),
			array(
				'message'		=> '[quote=&quot;[url=http&#58;//www&#46;example&#46;tdl/:2sda49fx][color=#00BF00:2sda49fx]bbcodes in quotes...[/color:2sda49fx][/url:2sda49fx]&quot;:2sda49fx][color=#FF0000:2sda49fx]hard[/color:2sda49fx]core[/quote:2sda49fx]',
				'bbcode_uid'	=> '2sda49fx',
			),
			array(
				'message'		=> '[list:1wmer8b2][*:1wmer8b2]1[/*:m:1wmer8b2][*:1wmer8b2]2[/*:1wmer8b2][/list:u:1wmer8b2]',
				'bbcode_uid'	=> '1wmer8b2',
			),
			array(
				'message'		=> 'Thanks to [player]Un1matr1x[/player] for the bug report.',
				'bbcode_uid'	=> '1wmer8b2',
			),
			array(
				'message'		=> 'foo[quote=&quot;he[llo&quot;:2sda49fx]test[/quote:2sda49fx]bar',
				'bbcode_uid'	=> '2sda49fx',
			),
			array(
				'message'		=> 'foo[url:2sda49fx]https://github.com/nickvergessen/phpbb3-tools-trim-message[/url:2sda49fx]bar',
				'bbcode_uid'	=> '2sda49fx',
			),
			array(
				'message'		=> 'h<!-- s[geek] --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt="[geek]" title="Geek" /><!-- s[geek] -->h<!-- s[geek] --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt="[geek]" title="Geek" /><!-- s[geek] -->h',
				'bbcode_uid'	=> '2sda49fx',
			),
			array(
				'message'		=> '<!-- s[foo.bar] --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt="[foo.bar]" title="Geek" /><!-- s[foo.bar] -->h<!-- s[foo.bar] --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt="[foo.bar]" title="Geek" /><!-- s[foo.bar] -->h',
				'bbcode_uid'	=> '2sda49fx',
			),
		);

		$cases = array(
			/**
			 * Breaking within BBCodes
			 */
			array(
				'message_set'	=> 0, 'length' => 0, 'trimmed' => true,
				'expected'		=> ' [...]',
			),
			array(
				'message_set'	=> 0, 'length' => 3, 'trimmed' => true,
				'expected'		=> '[quote=&quot;nickv&quot;:l0nwstsc]foo [...][/quote:l0nwstsc]',
			),
			array(
				'message_set'	=> 0, 'length' => 5, 'trimmed' => true,
				'expected'		=> '[quote=&quot;nickv&quot;:l0nwstsc]fooba [...][/quote:l0nwstsc]',
			),
			array(
				'message_set'	=> 0, 'length' => 7, 'trimmed' => true,
				'expected'		=> '[quote=&quot;nickv&quot;:l0nwstsc]foobar[/quote:l0nwstsc][quote=&quot;nickv&quot;:l0nwstsc]f [...][/quote:l0nwstsc]',
			),
			array(
				'message_set'	=> 0, 'length' => 12, 'trimmed' => false,
				'expected'		=> '[quote=&quot;nickv&quot;:l0nwstsc]foobar[/quote:l0nwstsc][quote=&quot;nickv&quot;:l0nwstsc]foobar[/quote:l0nwstsc]',
			),
			array(
				'message_set'	=> 0, 'length' => 13, 'trimmed' => false,
				'expected'		=> '[quote=&quot;nickv&quot;:l0nwstsc]foobar[/quote:l0nwstsc][quote=&quot;nickv&quot;:l0nwstsc]foobar[/quote:l0nwstsc]',
			),

			/**
			 * Breaking within Smilies
			 */
			array(
				'message_set'	=> 1, 'length' => 1, 'trimmed' => true,
				'expected'		=> 'h [...]',
			),
			array(
				'message_set'	=> 1, 'length' => 3, 'trimmed' => true,
				'expected'		=> 'h [...]',
			),
			array(
				'message_set'	=> 1, 'length' => 7, 'trimmed' => true,
				'expected'		=> 'h<!-- s:geek: --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt=":geek:" title="Geek" /><!-- s:geek: --> [...]',
			),
			array(
				'message_set'	=> 1, 'length' => 8, 'trimmed' => true,
				'expected'		=> 'h<!-- s:geek: --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt=":geek:" title="Geek" /><!-- s:geek: -->h [...]',
			),
			array(
				'message_set'	=> 1, 'length' => 11, 'trimmed' => false,
				'expected'		=> 'h<!-- s:geek: --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt=":geek:" title="Geek" /><!-- s:geek: -->h<!-- s:geek: --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt=":geek:" title="Geek" /><!-- s:geek: -->h',
			),
			array(
				'message_set'	=> 1, 'length' => 12, 'trimmed' => false,
				'expected'		=> 'h<!-- s:geek: --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt=":geek:" title="Geek" /><!-- s:geek: -->h<!-- s:geek: --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt=":geek:" title="Geek" /><!-- s:geek: -->h',
			),

			/**
			 * Breaking within Smilies that use [ and ] as limiter
			 */
			array(
				'message_set'	=> 7, 'length' => 1, 'trimmed' => true,
				'expected'		=> 'h [...]',
			),
			array(
				'message_set'	=> 7, 'length' => 3, 'trimmed' => true,
				'expected'		=> 'h [...]',
			),
			array(
				'message_set'	=> 7, 'length' => 7, 'trimmed' => true,
				'expected'		=> 'h<!-- s[geek] --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt="[geek]" title="Geek" /><!-- s[geek] --> [...]',
			),
			array(
				'message_set'	=> 7, 'length' => 8, 'trimmed' => true,
				'expected'		=> 'h<!-- s[geek] --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt="[geek]" title="Geek" /><!-- s[geek] -->h [...]',
			),
			array(
				'message_set'	=> 7, 'length' => 11, 'trimmed' => false,
				'expected'		=> 'h<!-- s[geek] --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt="[geek]" title="Geek" /><!-- s[geek] -->h<!-- s[geek] --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt="[geek]" title="Geek" /><!-- s[geek] -->h',
			),
			array(
				'message_set'	=> 7, 'length' => 12, 'trimmed' => false,
				'expected'		=> 'h<!-- s[geek] --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt="[geek]" title="Geek" /><!-- s[geek] -->h<!-- s[geek] --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt="[geek]" title="Geek" /><!-- s[geek] -->h',
			),

			/**
			 * Breaking within Quotes with BBCodes in username.
			 */
			array(
				'message_set' => 2, 'length' => 1, 'trimmed' => true,
				'expected' => '[quote=&quot;[url=http&#58;//www&#46;example&#46;tdl/:2sda49fx][color=#00BF00:2sda49fx]bbcodes in quotes...[/color:2sda49fx][/url:2sda49fx]&quot;:2sda49fx][color=#FF0000:2sda49fx]h [...][/color:2sda49fx][/quote:2sda49fx]',
			),
			array(
				'message_set' => 2, 'length' => 5, 'trimmed' => true,
				'expected' => '[quote=&quot;[url=http&#58;//www&#46;example&#46;tdl/:2sda49fx][color=#00BF00:2sda49fx]bbcodes in quotes...[/color:2sda49fx][/url:2sda49fx]&quot;:2sda49fx][color=#FF0000:2sda49fx]hard[/color:2sda49fx]c [...][/quote:2sda49fx]',
			),
			array(
				'message_set' => 2, 'length' => 8, 'trimmed' => false,
				'expected' => '[quote=&quot;[url=http&#58;//www&#46;example&#46;tdl/:2sda49fx][color=#00BF00:2sda49fx]bbcodes in quotes...[/color:2sda49fx][/url:2sda49fx]&quot;:2sda49fx][color=#FF0000:2sda49fx]hard[/color:2sda49fx]core[/quote:2sda49fx]',
			),

			/**
			 * Breaking within lists
			 */
			array(
				'message_set' => 3, 'length' => 1, 'trimmed' => true,
				'expected' => '[list:1wmer8b2][*:1wmer8b2]1 [...][/*:m:1wmer8b2][/list:u:1wmer8b2]',
			),
			array(
				'message_set' => 3, 'length' => 2, 'trimmed' => false,
				'expected' => '[list:1wmer8b2][*:1wmer8b2]1[/*:m:1wmer8b2][*:1wmer8b2]2[/*:1wmer8b2][/list:u:1wmer8b2]',
			),

			/**
			 * Handling non-bbcode []-brackets
			 */
			array(
				'message_set' => 4, 'length' => 6, 'trimmed' => true,
				'expected' => 'Thanks [...]',
			),
			array(
				'message_set' => 4, 'length' => 15, 'trimmed' => true,
				'expected' => 'Thanks to [play [...]',
			),
			array(
				'message_set' => 4, 'length' => 21, 'trimmed' => true,
				'expected' => 'Thanks to [player]Un1 [...]',
			),
			array(
				'message_set' => 4, 'length' => 40, 'trimmed' => true,
				'expected' => 'Thanks to [player]Un1matr1x[/player] for [...]',
			),
			array(
				'message_set' => 4, 'length' => 57, 'trimmed' => false,
				'expected' => 'Thanks to [player]Un1matr1x[/player] for the bug report.',
			),

			/**
			 * [ Brackets in quote-usernames
			 */
			array(
				'message_set' => 5, 'length' => 5, 'trimmed' => true,
				'expected' => 'foo[quote=&quot;he[llo&quot;:2sda49fx]te [...][/quote:2sda49fx]',
			),

			/**
			 * Sensitive BBCode
			 */
			array(
				'message_set' => 6, 'length' => 4, 'trimmed' => true,
				'expected' => 'foo[url:2sda49fx]https://github.com/nickvergessen/phpbb3-tools-trim-message[/url:2sda49fx]b [...]',
			),

			/**
			 * Breaking withing smiley with dot and square parentheses
			 */
			array(
				'message_set'	=> 8, 'length' => 12, 'trimmed' => false,
				'expected'		=> '<!-- s[foo.bar] --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt="[foo.bar]" title="Geek" /><!-- s[foo.bar] -->h<!-- s[foo.bar] --><img src="{SMILIES_PATH}/icon_e_geek.gif" alt="[foo.bar]" title="Geek" /><!-- s[foo.bar] -->h',
			),
		);

		$test_cases = array();
		foreach ($cases as $case)
		{
			$test_cases[] = array(
				$messages[$case['message_set']]['message'],
				$messages[$case['message_set']]['bbcode_uid'],
				$case['length'],
				$case['expected'],
				$case['trimmed'],
				(isset($case['incomplete']) ? $case['incomplete'] : ''),
			);
		}

		return $test_cases;
	}

	/**
	 * @dataProvider trim_message_data
	 */
	public function test_trim_message($message, $bbcode_uid, $length, $expected, $trimmed, $incomplete)
	{
		if ($incomplete)
		{
			$this->markTestIncomplete($incomplete);
		}

		$TrimMessage = new \Nickvergessen\TrimMessage\TrimMessage($message, $bbcode_uid, $length, ' [...]', 0);
		$this->assertEquals($expected, $TrimMessage->message());
		$this->assertEquals($trimmed, $TrimMessage->is_trimmed());
	}
}
