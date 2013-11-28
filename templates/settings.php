<?
		// Save form

if (isset($_POST['SaveCBESettings'])) {
					
		if ( !empty($_POST) && check_admin_referer( 'cbe-nonce') ) 
		{
   	
			

			$this->customlesscode = $_POST['customlesscode'];

			
			/*$url = wp_nonce_url('options-general.php?page=custom-bootstrap-editor','cbe-nonce');
			if (false === ($creds = request_filesystem_credentials($url, '', false, false, array('SaveCBESettings','customlesscode')) ) ) {
				exit;
			}*/
			
			
			if(1)
			{
				
				/*if ( ! WP_Filesystem($creds) ) {
				// our credentials were no good, ask the user for them again
				request_filesystem_credentials($url, $method, true, false, $form_fields);
				exit;
				}*/	
				if(1)
				{
				
                                  		// get the upload directory and make a test.txt file

		$upload_dir = wp_upload_dir();
                 
                if( !is_dir( $this->folder ) ) wp_mkdir_p( $this->folder );
		// by this point, the $wp_filesystem global should be working, so let's use it to create a file
                if ( is_writable( $this->folder ) ){
		//global $wp_filesystem;
       		
       		$plugindir = str_replace('templates/','',plugin_dir_path( __FILE__ ));
			if(!class_exists('Less_Parser'))
			{
			require $plugindir.'phpless/Less.php';
			//require $plugindir.'phpless/LessCache.php';
		    }
			$parser = new Less_Parser();
			$parser->parseFile( $plugindir .'assets/less/bootstrap.less', '' );
			
                        /* fix the glyphicons */
                        $plugindirurl = str_replace('templates/','',plugin_dir_url( __FILE__ ));
                        $parser->parse('@icon-font-path:          "'. $plugindirurl .'assets/fonts/";'); 
                        $parser->parse( $this->customlesscode );
			$css = $parser->getCss();
	        //if( !is_dir( $folder ) ) var_dump($wp_filesystem->mkdir( $folder ));

		file_put_contents( $this->folder.$this->filename, $css);
		/*if ( ! $wp_filesystem->put_contents( $folder.'/'.$filename, $css, FS_CHMOD_FILE) ) {

			echo "error saving file!";

		}*/
                }
				
				
		$this->save_options();
			
		echo '<div id="message" class="updated fade"><p><strong>Settings have been saved.</strong></p></div>';
			    } 
			}
	    }
}
?>

<?php
		echo '<div class="wrap">'."\n";
?><h2>Custom Bootstrap Editor <?php echo __('Settings','cbe');?></h2><?php 
		
		
		// Show Forms
		?>
		<div class="metabox-holder">
		<form id="FeaturedBanners" method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
        <?php wp_nonce_field('cbe-nonce'); ?>
        <div class="postbox" id="flexslider_settings">
        	<h3>Options</h3>
            <div class="inside">
                <fieldset>
				<p><label for="customlesscode"><?php echo __('Custom Less code','cbe');?>:</label>
                	<textarea style="width:70%;height:100px;" id="customlesscode" name="customlesscode"><?php
				
						echo $this->customlesscode;
		
					?></textarea></p>
			  </fieldset>
                <p class="submit"><input type="submit" name="SaveCBESettings" value="Save All Changes" class="button-primary" /></p>
            </div>
        </div><!-- postbox -->
        
        

        
        </form>
        </div><!-- metabox holder -->




        <?php
		echo '</div><!-- wrap -->'."\n";
