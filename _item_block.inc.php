<?php
/**
 * This is the template that displays the item block
 *
 * This file is not meant to be called directly.
 * It is meant to be called by an include in the main.page.php template (or other templates)
 *
 * b2evolution - {@link http://b2evolution.net/}
 * Released under GNU GPL License - {@link http://b2evolution.net/about/license.html}
 * @copyright (c)2003-2009 by Francois PLANQUE - {@link http://fplanque.net/}
 *
 * @package evoskins
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

global $Item;

// Default params:
$params = array_merge( array(
		'feature_block'   => false,
		'content_mode'    => 'auto',		// 'auto' will auto select depending on $disp-detail
		'item_class'      => 'post',
		'image_size'	    => 'fit-400x320',
	), $params );

?>
<div id="<?php $Item->anchor_id() ?>" class="<?php $Item->div_classes( $params ) ?>" lang="<?php $Item->lang() ?>">

	<?php
	
	$Item->locale_temp_switch(); // Temporarily switch to post locale (useful for multilingual blogs)
	
	if( ! $Item->is_intro() )
	{ 
		if( $Skin->get_setting('display_metadata') )
		{ 
			if( ! $Item->is_featured()) 
			{ ?> 
	<div class="date">
	<?php
		$Item->issue_date( array(
				'before'    => '',
				'after'     => '',
				'date_format' => 'M',
			));
		
		$Item->issue_date( array(
				'before'    => '<span>',
				'after'     => '</span>',
				'date_format' => 'd',
			));
		?>
	</div>	 
	<?php 
			} 
		} 
	} ?>

    <div <?php if( ! $Item->is_intro() ){if( $Skin->get_setting('display_metadata') ){ if( ! $Item->is_featured()) { ?> class="posthead"<?php } } } ?>>
   
    <h2 class="title"><?php $Item->title(); ?></h2>

 	<?php if( ! $Item->is_intro() )
 	{
 		if( $Skin->get_setting('display_metadata') )
 		{ ?> 
		
			<p class="meta">
			<?php
				$Item->author( array(
						'before'    => T_('Posted by').' ',
						'after'     => ' ',
					) );

				$Item->issue_date( array(
					'before'      => T_('on').' ',
					'after'       => ' ',
					'date_format' => '#',
				) );
				
				$Item->categories( array(
					'before'          => ' &nbsp;~&nbsp; '. T_('Posted in: '),
					'after'           => '',
					'include_main'    => true,
					'include_other'   => true,
					'include_external'=> true,
					'link_categories' => true,
				) );
				
				// Link to comments, trackbacks, etc.:
				$Item->feedback_link( array(
					'type' => 'feedbacks',
					'link_before' => ' &nbsp;~&nbsp; ',
					'link_after' => '',
					'link_text_zero' => '#',
					'link_text_one' => '#',
					'link_text_more' => '#',
					'link_title' => '#',
					'use_popup' => false,
				) );
			?>
			</p>
			<?php 
		} 
	} ?>
    
    </div> <!-- end posthead -->
    
	<div class="entry">
		<?php
			// ---------------------- POST CONTENT INCLUDED HERE ----------------------
			skin_include( '_item_content.inc.php', $params );
			// Note: You can customize the default item feedback by copying the generic
			// /skins/_item_content.inc.php file into the current skin folder.
			// -------------------------- END OF POST CONTENT -------------------------
		?>
	</div>

	<?php
	if( ! $Item->is_intro() )
	{
		if( $Skin->get_setting('display_metadata') )
		{
		?>
			<p class="links">	
				<?php
					// List all tags attached to this post:
					$Item->tags( array(
							'before' =>         T_('Tags').': ',
							'after' =>          '',
							'separator' =>      ', ',
						) );
				?>
				<?php
					$Item->edit_link( array( // Link to backoffice for editing
							'before'    => ' &nbsp;~&nbsp; ',
							'after'     => '',
						) );
				?>
			</p>
		<?php
		}
	}
	?>
	<div class="feedback">
		<?php
			// ------------------ FEEDBACK (COMMENTS/TRACKBACKS) INCLUDED HERE ------------------
			skin_include( '_item_feedback.inc.php', array(
					'before_section_title' => '<h4>',
					'after_section_title'  => '</h4>',
				) );
			// Note: You can customize the default item feedback by copying the generic
			// /skins/_item_feedback.inc.php file into the current skin folder.
			// ---------------------- END OF FEEDBACK (COMMENTS/TRACKBACKS) ---------------------
		?>
	</div>
</div>

<?php
locale_restore_previous();	// Restore previous locale (Blog locale)