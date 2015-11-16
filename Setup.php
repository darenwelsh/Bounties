<?php
/**
 *
 * Documentation: https://github.com/darenwelsh/bounties
 * Support:       https://github.com/darenwelsh/bounties
 * Source code:   https://github.com/darenwelsh/bounties
 *
 * @addtogroup Extensions
 * @author Daren Welsh
 * @copyright © 2015 by Daren Welsh
 * @licence GNU GPL v3+
 */

namespace Bounties;

class Setup {

	/**
	* Handler for ParserFirstCallInit hook; sets up parser functions.
	* @see http://www.mediawiki.org/wiki/Manual:Hooks/BeforePageDisplay
	* @param $parser Parser object
	* @param $frame FIXME: what does frame really do?
	* @param $args array of arguments passed to parser function
	* @return bool true in all cases
	*/
	static function setupParserFunctions ( &$parser ) {

		setup #bounty parser function
		$parser->setFunctionHook(
			'bounty',
			array(
				'Bounties\Setup',
				'renderBountyParserFunction'
			),
			SFH_OBJECT_ARGS
		);

		return true;

	}



	/**
	* Handler for bounty parser function.
	* @see http://www.mediawiki.org/wiki/Manual:Hooks/BeforePageDisplay
	* @param $parser Parser object
	* @param $frame FIXME: what does frame really do?
	* @param $args array of arguments passed to parser function
	* @return bool true in all cases
	*/
	static function renderBountyParserFunction ( &$parser, $frame, $args ) {
		$args = self::processArgs( $frame, $args, array("", 255, 1) );

		$full_text  = $args[0];
		$max_length = $args[1];
		$max_lines  = $args[2];

		return $synopsis;
	}

	/**
	* Processes arguments to parser function, setting defaults where required.
	* @see http://www.mediawiki.org/wiki/Manual:Hooks/BeforePageDisplay
	* @param $frame FIXME: what does frame really do?
	* @param $args array of arguments passed to parser function
	* @param $defaults array of default values for arguments
	* @return bool true in all cases
	*/
	static function processArgs( $frame, $args, $defaults ) {
		$new_args = array();
		$num_args = count($args);
		$num_defaults = count($defaults);
		$count = ($num_args > $num_defaults) ? $num_args : $num_defaults;

		for ($i=0; $i<$count; $i++) {
			if ( isset($args[$i]) )
				$new_args[$i] = trim( $frame->expand($args[$i]) );
			else
				$new_args[$i] = $defaults[$i];
		}
		return $new_args;
	}


	/**
	* Handler for BeforePageDisplay hook. Adds required modules for extension.
	* @see http://www.mediawiki.org/wiki/Manual:Hooks/BeforePageDisplay
	* @param $out OutputPage object
	* @param $skin Skin being used.
	* @return bool true in all cases
	*/
	public static function onBeforePageDisplay( \OutputPage &$out, \Skin &$skin ) {
		// $out->addModules( array( 'ext.bounties.template' ) );
		return true;
	}
}