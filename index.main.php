<?php
/**
 * This is the main/default page template for the "TealPro" skin.
 *
 * This skin only uses one single template which includes most of its features.
 * It will also rely on default includes for specific dispays (like the comment form).
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://manual.b2evolution.net/Skins_2.0}
 *
 * The main page template is used to display the blog when no specific page template is available
 * to handle the request (based on $disp).
 *
 * @package evoskins
 * @subpackage TealPro
 *
 * @version $Id: $
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

if( version_compare( $app_version, '3.0' ) < 0 )
{ // Older skins (versions 2.x and above) should work on newer b2evo versions, but newer skins may not work on older b2evo versions.
	die( 'This skin is designed for b2evolution 3.0 and above. Please <a href="http://b2evolution.net/downloads/index.html">upgrade your b2evolution</a>.' );
}

// This is the main template; it may be used to display very different things.
// Do inits depending on current $disp:
skin_init( $disp );

require_js( '#jquery#' );
require_js( 'scripts.js', true );
require_css( 'print.css', true, '', 'print' );

// -------------------------- HTML HEADER INCLUDED HERE --------------------------
skin_include( '_html_header.inc.php', array() );
// -------------------------------- END OF HEADER --------------------------------
?>
<div class="page-wrapper">
	
	<div id="header">
		<div id="pagetop">
			<?php
				// ------------------------- "Page Top" CONTAINER EMBEDDED HERE --------------------------
				// Display container and contents:
				skin_container( NT_('Page Top'), array(
						// The following params will be used as defaults for widgets included in this container:
						'block_start'         => '<div class="$wi_class$">',
						'block_end'           => '</div>',
						'block_display_title' => false,
						'list_start'          => '<ul>',
						'list_end'            => '</ul>',
						'item_start'          => '<li>',
						'item_end'            => '</li>',
					) );
				// ----------------------------- END OF "Page Top" CONTAINER -----------------------------
			?>
		</div>
		<div id="logo">
			<?php
				// ------------------------- "Header" CONTAINER EMBEDDED HERE --------------------------
				// Display container and contents:
				skin_container( NT_('Header'), array(
						// The following params will be used as defaults for widgets included in this container:
						'block_start'       => '<div class="$wi_class$">',
						'block_end'         => '</div>',
						'block_title_start' => '<h1>',
						'block_title_end'   => '</h1>',
					) );
				// ----------------------------- END OF "Header" CONTAINER -----------------------------
			?>
		</div>
	</div>
	<!-- end #header -->
	
	    <div class="blog_list">
      <?php
	  // START OF BLOG LIST
	  skin_widget( array(
			'widget' => 'colls_list_public',
			'block_start' => '',
			'block_end' => '',
			'block_display_title' => false,
			'list_start' => '',
			'list_end' => '',
			'item_start' => '',
			'item_end' => '',
			'item_selected_start' => '<span class="selected">',
			'item_selected_end' => '</span>',
		  ) );
	  ?>
    </div>
	
	<div id="menu">
		<ul>
			<?php
				// ------------------------- "Menu" CONTAINER EMBEDDED HERE --------------------------
				// Display container and contents:
				// Note: this container is designed to be a single <ul> list
				skin_container( NT_('Menu'), array(
						// The following params will be used as defaults for widgets included in this container:
						'block_start'         => '',
						'block_end'           => '',
						'block_display_title' => false,
						'list_start'          => '',
						'list_end'            => '',
						'item_start'          => '<li>',
						'item_end'            => '</li>',
						'link_selected_class' => 'current_page_item',
					) );
				// ----------------------------- END OF "Menu" CONTAINER -----------------------------
			?>
            
		</ul>
	</div>
	<!-- end #menu -->
	<div id="page" class="clearfix">
		<div id="banner">&nbsp;</div>
		<div id="content">
			<?php
				// ------------------------- MESSAGES GENERATED FROM ACTIONS -------------------------
				messages( array(
						'block_start' => '<div class="action_messages">',
						'block_end'   => '</div>',
					) );
				// --------------------------------- END OF MESSAGES ---------------------------------
			?>

			<?php
				// ------------------------ TITLE FOR THE CURRENT REQUEST ------------------------
				request_title( array(
						'title_before'=> '<h2 class="requesttitle">',
						'title_after' => '</h2>',
						'title_none'  => '',
						'glue'        => ' - ',
						'title_page_disp' => false,
						'title_single_disp' => false,
						'format'      => 'htmlbody',
					) );
				// ----------------------------- END OF REQUEST TITLE ----------------------------
			?>

			<?php
			// Go Grab the featured post:
			if( $Item = & get_featured_Item() )
			{	// We have a featured/intro post to display:
				// ---------------------- ITEM BLOCK INCLUDED HERE ------------------------
				skin_include( '_item_block.inc.php', array(
						'feature_block' => true,
						'content_mode' => 'auto',		// 'auto' will auto select depending on $disp-detail
						'intro_mode'   => 'normal',	// Intro posts will be displayed in normal mode
						'item_class'   => 'featured_post',
						'image_size'	 =>	'fit-400x320',
					) );
				// ----------------------------END ITEM BLOCK  ----------------------------
			}
			?>

			<?php
				// --------------------------------- START OF POSTS -------------------------------------
				// Display message if no post:
				display_if_empty();

				while( $Item = & mainlist_get_item() )
				{	// For each blog post, do everything below up to the closing curly brace "}"

					// ---------------------- ITEM BLOCK INCLUDED HERE ------------------------
					skin_include( '_item_block.inc.php', array(
							'content_mode' => 'auto',		// 'auto' will auto select depending on $disp-detail
							'image_size'	 =>	'fit-400x320',
						) );
					// ----------------------------END ITEM BLOCK  ----------------------------

				} // ---------------------------------- END OF POSTS ------------------------------------
			?>

			<?php
				// -------------------- PREV/NEXT PAGE LINKS (POST LIST MODE) --------------------
				mainlist_page_links( array(
						'block_start' => '<p class="paginator"><strong>',
						'block_end' => '</strong></p>',
					'prev_text' => '&lt;&lt;',
					'next_text' => '&gt;&gt;',
					) );
				// ------------------------- END OF PREV/NEXT PAGE LINKS -------------------------
			?>


			<?php
				// -------------- MAIN CONTENT TEMPLATE INCLUDED HERE (Based on $disp) --------------
				skin_include( '$disp$', array(
						'disp_posts'  => '',		// We already handled this case above
						'disp_single' => '',		// We already handled this case above
						'disp_page'   => '',		// We already handled this case above
					) );
				// Note: you can customize any of the sub templates included here by
				// copying the matching php file into your skin directory.
				// ------------------------- END OF MAIN CONTENT TEMPLATE ---------------------------
			?>

		</div>
		<!-- end #content -->
        <div id="sidebar-en">
		<div id="sidebar">
			<ul>
				<?php
					// ------------------------- "Sidebar" CONTAINER EMBEDDED HERE --------------------------
					// Display container contents:
					skin_container( NT_('Sidebar'), array(
							// The following (optional) params will be used as defaults for widgets included in this container:
							// This will enclose each widget in a block:
							'block_start' => '<li class="$wi_class$">',
							'block_end' => '</li>',
							// This will enclose the title of each widget:
							'block_title_start' => '<h2>',
							'block_title_end' => '</h2>',
							// If a widget displays a list, this will enclose that list:
							'list_start' => '<ul>',
							'list_end' => '</ul>',
							// This will enclose each item in a list:
							'item_start' => '<li>',
							'item_end' => '</li>',
							// This will enclose sub-lists in a list:
							'group_start' => '<ul>',
							'group_end' => '</ul>',
							// This will enclose (foot)notes:
							'notes_start' => '<div class="notes">',
							'notes_end' => '</div>',
							// Search block:
							'disp_search_options' => false,
						) );
					// ----------------------------- END OF "Sidebar" CONTAINER -----------------------------
					//
					//

					
				?>
			</ul>
		</div><!-- end #sidebar -->
        </div> <!-- end #sidebar-en -->
	</div><!-- end #page -->
	<div id="footer" class="clearfix">
	
    <p class="ftr">
	  <?php
      // Display additional credits:
      // If you can add your own credits without removing the defaults, you'll be very cool :))
      // Please leave this at the bottom of the page to make sure your blog gets listed on b2evolution.net
    	echo '<a class="tnone" href="http://www.ptemplates.com" target="_blank">Design</a> by <a href="http://www.web-designers-directory.org" target="_blank">WDD</a> ~ Converted by: <a href="http://www.dirbuzz.com/" target="_blank">DirBuzz</a> </p>';
		?>
			
      <p class="ftl"><?php
          // Display footer text (text can be edited in Blog Settings):
          $Blog->footer_text( array(
                  'before'      => '',
                  'after'       => ' ~ ',
              ) );
      ?>

	  <?php
          // Display additional credits:
          // If you can add your own credits without removing the defaults, you'll be very cool :))
          // Please leave this at the bottom of the page to make sure your blog gets listed on b2evolution.net        
      echo 'Powered by: <a href="http://b2evolution.net/" target="_blank">b2evolution</a> ~ <a href="http://b2evolution.net/web-hosting/top-quality-best-webhosting.php" target="_blank">web hosting</a> ~ <a href="http://b2evolution.net/about/monetize-blog-money.php" target="_blank">advertising</a>';
      ?>
			
		</p>
	</div>
	<!-- end #footer -->
</div> <!-- end .page-wrapper -->
<?php
// ------------------------- HTML FOOTER INCLUDED HERE --------------------------
skin_include( '_html_footer.inc.php' );
// Note: You can customize the default HTML footer by copying the
// _html_footer.inc.php file into the current skin folder.
// ------------------------------- END OF FOOTER --------------------------------
?>
