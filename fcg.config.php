<?php
/**
 * @version 2.0
 * @author Sammy
 *
 * @keywords Samils, ils, php framework
 * -----------------
 * @package Sammy\Packs\FileContentGetter
 * - Autoload, application dependencies
 */
namespace Sammy\Packs\FileContentGetter {
	/**
	 * @var FileContentGetterConfig
	 * - File Content Getter Configuration
	 * - data for using when getting a file
	 * - content based on it's type
	 */
	$module->exports = [
		'contentGetterSyntaxHighLight' => true,

		/**
		 * @var contentGetterSyntaxLanguages
		 * - Content getter Supported syntax
		 * - languages when using syntax high light
		 * - with contentGetter
		 * - ...
		 */
		'contentGetterSyntaxLanguages' => [
			'php', 'html'
		],

		/**
		 * @var contentGetterSyntaxesColors
		 * - File Content getter Syntaxes color
		 * - is a way to provide different colors
		 * - when using color highlight with
		 * - FileContentGetter lib
		 *
		 * It provides a color array based on
		 * "dataType => color" pattern for each
		 * supported language defined in
		 * 'contentGetterSyntaxLanguages'
		 * property
		 */
		'contentGetterSyntaxesColors' => [
			'php' => [
				'string' => '#eab727',
				'command' => 'red',
				'function' => 'blue',
				'number' => 'violet',
				'args' => 'orange'
			]
		]
	];
}
