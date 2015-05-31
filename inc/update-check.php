<?php
/**
 * Provides a notification everytime the theme is updated
 * Original code courtesy of João Araújo of Unisphere Design - http://themeforest.net/user/unisphere
 */

function observo_update_check() {  
	$xml = observo_get_latest_theme_version(21600); // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$theme_data = wp_get_theme(); // Get theme data from style.css (current version is what we want)
	
	if(version_compare($theme_data->get( 'Version' ), $xml->latest) == -1) {
		observo_update_notifier();
	}
}  

add_action( 'admin_notices', 'observo_update_check' );

function observo_update_notifier() { 
	$xml = observo_get_latest_theme_version(21600); // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$theme_data = wp_get_theme(); // Get theme data from style.css (current version is what we want) ?>
	
	<style>
		.update-nag {display: none;}
		#instructions {max-width: 800px;}
		h3.title {margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd;}
	</style>

	<div class="wrap">
	
		<div id="icon-tools" class="icon32"></div>
	    <div id="message" class="updated below-h2">
	    	<p><strong>There is a new version of the <?php echo $theme_data->get( 'Name' ); ?> theme available.</strong> You have version <?php echo $theme_data->get( 'Version' ); ?> installed. Update to version <?php echo $xml->latest; ?>.</p>
			<div id="instructions" style="max-width: 800px;">
			    <h3>Update Instructions</h3>
			    <p><strong>Please note:</strong> make a <strong>backup</strong> of the theme inside your WordPress themes folder <strong>/wp-content/themes/</strong></p>
			    <p>To update the Theme, login to your WordSkins account, go to the downloads section and re-download the theme zip file.</p>
			    <p>Extract the zip's contents, then upload the new folder using FTP to the <strong>/wp-content/themes/</strong> folder overwriting the old ones (this is why it's important to backup any changes you've made to the theme files).</p>
			</div>
	    </div>

	</div>
    
<?php } 

// This function retrieves a remote xml file on my server to see if there's a new update 
// For performance reasons this function caches the xml content in the database for XX seconds ($interval variable)
function observo_get_latest_theme_version($interval) {
	// remote xml file location
	$notifier_file_url = 'http://www.wordskins.com/updates/' . strtolower(wp_get_theme()) . '/notifier.xml';
	
	$db_cache_field = 'observo-notifier-cache';
	$db_cache_field_last_updated = 'observo-notifier-last-updated';
	$last = get_option( $db_cache_field_last_updated );
	$now = time();
	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {
		// cache doesn't exist, or is old, so refresh it
		if( function_exists('curl_init') ) { // if cURL is available, use it...
			$ch = curl_init($notifier_file_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			$cache = curl_exec($ch);
			curl_close($ch);
		} else {
			$cache = file_get_contents($notifier_file_url); // ...if not, use the common file_get_contents()
		}
		
		if ($cache) {			
			// we got good results
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );			
		}
		// read from the cache file
		$notifier_data = get_option( $db_cache_field );
	}
	else {
		// cache file is fresh enough, so read from it
		$notifier_data = get_option( $db_cache_field );
	}
	
	$xml = simplexml_load_string($notifier_data); 
	
	return $xml;
}

?>
