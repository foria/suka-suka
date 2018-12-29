<?php
/**
 * @package 	WordPress
 * @subpackage 	Music Band
 * @version		1.0.0
 *
 * Website Footer Template
 * Created by CMSMasters
 *
 */


$cmsms_option = cmsmasters_get_global_options();


if (is_singular()) {
	$cmsms_page_id = get_the_ID();
} elseif (CMSMS_WOOCOMMERCE && is_shop()) {
	$cmsms_page_id = wc_get_page_id('shop');
}


if (
	is_singular() ||
	(CMSMS_WOOCOMMERCE && is_shop())
) {
	$cmsms_bottom_sidebar = get_post_meta($cmsms_page_id, 'cmsms_bottom_sidebar', true) !== '' ? get_post_meta($cmsms_page_id, 'cmsms_bottom_sidebar', true) : ($cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar'] == 1 ? 'true' : 'false');

	$cmsms_bottom_sidebar_layout = get_post_meta($cmsms_page_id, 'cmsms_bottom_sidebar_layout', true) !== '' ? get_post_meta($cmsms_page_id, 'cmsms_bottom_sidebar_layout', true) : $cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar_layout'];
} else {
	$cmsms_bottom_sidebar = $cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar'] == 1 ? 'true' : 'false';

	$cmsms_bottom_sidebar_layout = $cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar_layout'];
}


echo '</div>' . "\r" .
	'</div>' . "\n" .
'</div>' . "\n" .
'<!-- _________________________ Finish Middle _________________________ -->' . "\n\n\n";


if (
	!is_home() &&
	!is_404() &&
	$cmsms_bottom_sidebar &&
	$cmsms_bottom_sidebar == 'true'
) {
	echo '<!-- _________________________ Start Bottom _________________________ -->' . "\n" .
	'<div id="bottom" class="cmsms_color_scheme_' . $cmsms_option[CMSMS_SHORTNAME . '_bottom_scheme'] . '">' . "\n" .
		'<div class="bottom_bg">' . "\n" .
			'<div class="bottom_outer">' . "\n" .
				'<div class="bottom_inner sidebar_layout_' . $cmsms_bottom_sidebar_layout . '">' . "\n";

	get_sidebar('bottom');

	echo '</div>' . "\r" .
			'</div>' . "\r" .
		'</div>' . "\r" .
	'</div>' . "\r" .
	'<!-- _________________________ Finish Bottom _________________________ -->' . "\n\n";
}


echo '<a href="javascript:void(0);" id="slide_top" class="cmsms_theme_icon_slide_top"></a>' . "\n";
?>
	</div>
<!-- _________________________ Finish Main _________________________ -->

<!-- _________________________ Start Footer _________________________ -->
	<footer id="footer" role="contentinfo" class="<?php echo 'cmsms_color_scheme_' . $cmsms_option[CMSMS_SHORTNAME . '_footer_scheme'] . ($cmsms_option[CMSMS_SHORTNAME . '_footer_type'] == 'default' ? ' cmsms_footer_default' : ' cmsms_footer_small');
	?>">
		<div class="footer_bg">
			<div class="footer_inner">
		<?php
			if (
				$cmsms_option[CMSMS_SHORTNAME . '_footer_type'] == 'default' &&
				$cmsms_option[CMSMS_SHORTNAME . '_footer_logo']
			) {
				cmsmasters_footer_logo();
			}


			if (
				has_nav_menu('footer') &&
				(
					(
						$cmsms_option[CMSMS_SHORTNAME . '_footer_type'] == 'default' &&
						$cmsms_option[CMSMS_SHORTNAME . '_footer_nav']
					) || (
						$cmsms_option[CMSMS_SHORTNAME . '_footer_type'] == 'small' &&
						$cmsms_option[CMSMS_SHORTNAME . '_footer_additional_content'] == 'nav'
					)
				)
			) {
				echo '<nav>';


				wp_nav_menu(array(
					'theme_location' => 'footer',
					'menu_id' => 'footer_nav',
					'menu_class' => 'footer_nav'
				));


				echo '</nav>';
			}


			if (
				isset($cmsms_option[CMSMS_SHORTNAME . '_social_icons']) &&
				(
					(
						$cmsms_option[CMSMS_SHORTNAME . '_footer_type'] == 'default' &&
						$cmsms_option[CMSMS_SHORTNAME . '_footer_social']
					) || (
						$cmsms_option[CMSMS_SHORTNAME . '_footer_type'] == 'small' &&
						$cmsms_option[CMSMS_SHORTNAME . '_footer_additional_content'] == 'social'
					)
				)
			) {
				cmsmasters_social_icons();
			}


			if (
				(
					$cmsms_option[CMSMS_SHORTNAME . '_footer_type'] == 'default' &&
					$cmsms_option[CMSMS_SHORTNAME . '_footer_html'] !== ''
				) || (
					$cmsms_option[CMSMS_SHORTNAME . '_footer_type'] == 'small' &&
					$cmsms_option[CMSMS_SHORTNAME . '_footer_additional_content'] == 'text' &&
					$cmsms_option[CMSMS_SHORTNAME . '_footer_html'] !== ''
				)
			) {
				echo '<div class="footer_custom_html">' .
					do_shortcode(stripslashes($cmsms_option[CMSMS_SHORTNAME . '_footer_html'])) .
				'</div>';
			}


			echo '<span class="copyright">' . stripslashes($cmsms_option[CMSMS_SHORTNAME . '_footer_copyright']) . '</span>' . "\n";
		?>
			</div>
		</div>
	</footer>
<!-- _________________________ Finish Footer _________________________ -->

</div>
<!-- _________________________ Finish Page _________________________ -->

<?php wp_footer(); ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-128106300-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-128106300-1');
</script>

</body>
</html>
