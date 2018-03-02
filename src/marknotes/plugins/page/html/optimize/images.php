<?php

/**
 * Optimize Images
 */

namespace MarkNotes\Plugins\Page\HTML\Optimize;

defined('_MARKNOTES') or die('No direct access allowed');

class Images
{

	public static function run(string $str, array $arrOptimize) : string
	{

		// Lazyload images ?
		$bLazyLoad = boolval($arrOptimize['lazyload'] ?? false);

		if ($bLazyLoad) {
			$aeFolders = \MarkNotes\Folders::getInstance();
			$aeFunctions = \MarkNotes\Functions::getInstance();
			$aeSettings = \MarkNotes\Settings::getInstance();

			/*<!-- build:debug -->*/
			if ($aeSettings->getDebugMode()) {
				$aeDebug = \MarkNotes\Debug::getInstance();
				$aeDebug->log('Images - Add lazyloading', 'debug');
			}
			/*<!-- endbuild -->*/

			$lib=$aeSettings->getFolderLibs().'lazysizes/';

			if ($aeFolders->exists($lib)) {
				$aeFunctions = \MarkNotes\Functions::getInstance();
				$root = rtrim($aeFunctions->getCurrentURL(), '/');

				// Add the lazyload class to every images.
				// The script /libs/lazysizes/lazysizes.min.js will do the rest
				$str = str_replace(
					'<img src="',
					'<img src="'.$root.'/assets/images/blank.png" class="lazyload" data-src="',
					$str
				);
			} else { // if ($aeFolders->exists($lib))
				/*<!-- build:debug -->*/
				if ($aeSettings->getDebugMode()) {
					$aeDebug->log('Library not found ['.$lib.']', 'warning');
				}
				/*<!-- endbuild -->*/
			} // if ($aeFolders->exists($lib))
		} // if ($bLazyLoad)

		return $str;
	}
}
