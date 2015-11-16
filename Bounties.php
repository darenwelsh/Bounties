<?php
/**
 * The Bounties extension allows you to track and reward bounties in MediaWiki.
 * See README.md.
 *
 * Documentation: https://github.com/darenwelsh/bounties
 * Support:       https://github.com/darenwelsh/bounties
 * Source code:   https://github.com/darenwelsh/bounties
 *
 * @file Bounties.php
 * @addtogroup Extensions
 * @author Daren Welsh
 * @copyright © 2015 by Daren Welsh
 * @licence GNU GPL v3+
 */

# Not a valid entry point, skip unless MEDIAWIKI is defined
if ( ! defined( 'MEDIAWIKI' ) ) {
	die( 'Bounties extension' );
}

$GLOBALS['wgExtensionCredits'][] = array(
	'path'           => __FILE__,
	'name'           => 'Bounties',
	'url'            => 'https://github.com/darenwelsh/bounties',
	'author'         => array(
		'[https://www.mediawiki.org/wiki/User:Darenwelsh Darenwelsh]'
	),
	'descriptionmsg' => 'bounties-desc',
	'version'        => '0.1.0'
);

$GLOBALS['wgMessagesDirs']['Bounties'] = __DIR__ . '/i18n';
// $GLOBALS['wgExtensionMessagesFiles']['Bounties'] = __DIR__ . '/Magic.php';

// Autoload setup class (location of parser function definitions)
$GLOBALS['wgAutoloadClasses']['Bounties\Setup'] = __DIR__ . '/Setup.php';

$wgSpecialPages['Bounties'] = 'SpecialBounties'; // register special page

// Setup parser functions
$GLOBALS['wgHooks']['ParserFirstCallInit'][] = 'Bounties\Setup::setupParserFunctions';
$GLOBALS['wgHooks']['BeforePageDisplay'][] = 'Bounties\Setup::onBeforePageDisplay';


$ExtensionBountiesResourceTemplate = array(
	'localBasePath' => __DIR__ . '/resources',
	'remoteExtPath' => 'Bounties/resources',
);


$GLOBALS['wgResourceModules'] += array(

	'ext.bounties.base' => $ExtensionBountiesResourceTemplate + array(
		'styles' => 'base/bounties.css',
		// 'scripts' => 'base/bounties.js',
		'position' => 'top',
	),

);
