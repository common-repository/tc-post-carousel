<?php
/**
 * public view functionality.
 *
 * @link       http://themescode.com
 * @since      1.0.0
 *
 * @package    TC Post Carousel
 * tc  is used as short for themescode.com
 **/
 function tc_post_carousel_get_option( $option, $section, $default = '' ) {

     $options = get_option( $section );

     if ( isset( $options[$option] ) ) {
         return $options[$option];
     }

     return $default;
 }
 function tc_post_carousel_trigger(){
 ?>
 <style media="screen">
 .tc-pc-theme .owl-controls .owl-buttons div {

   background-color:<?php echo tc_post_carousel_get_option('navigation-color', 'tc_post_carousel_styling', 'true' ); ?>;
 }
 .tc-pc-theme .owl-controls .owl-page span {
   background-color:<?php echo tc_post_carousel_get_option('pagination-color', 'tc_post_carousel_styling', 'true' ); ?>;
 }

.tc-pc-theme .owl-controls .owl-page span.owl-numbers{
   background-color:<?php echo tc_post_carousel_get_option('pagination-color', 'tc_post_carousel_styling', 'true' ); ?>;

 }

 </style>
 <?php
 }
 add_action('wp_footer','tc_post_carousel_trigger');


add_shortcode('tc-post-carousel', 'tc_post_carousel_view' );


function tc_post_carousel_view($atts) {

	// Attributes
extract( shortcode_atts(
	array(
		'posts_num' => "-1",
		'order' => 'DESC',
		'orderby' => '',
		 'post_cat'=>'',

	), $atts )
);


  $args = array(
 		 'orderby' => 'date',
 			'order' => $order,
 				'numberposts' => $posts_num,
  );
 	 $tc_post_loop = new WP_Query($args);

 	 $output = '<div class="tc-post-container1">';
 	 $output .= '<div class="tc-post-carousel">';

 	 if($tc_post_loop->have_posts()){
 			 while($tc_post_loop->have_posts()) {
 					 $tc_post_loop->the_post();

 					 $tc_post_thumbnail = get_the_post_thumbnail(get_the_ID());

            $output .= '<div class="post-one-box">';
 					 $output .= '<div class="item-post-one">';
 							$output .='<a href="'.get_the_permalink().'">'.$tc_post_thumbnail.'</a>';
            $output .= '</div>';

 					 $output .= '<div class="item-title">';

 						 $output .='<h3 class="tc-post-title"> <a href="'.get_the_permalink().'">'.get_the_title() .'</a></h3>';

 						 $output .='<p class="tc-post-text">'.substr(get_the_excerpt(), 0,180). '</p>';
 						 $output .='<a class="btn tc-post-btn" href="'.get_the_permalink(). '"> Read More </a>';

 					 $output .= '</div>';

 			       $output .= '</div>';


 			 }
 	 } else {
 			 echo 'No Blog Post Was Found.';
 	 }
 	 wp_reset_postdata();
 	 wp_reset_query();
 	 $output .= '</div>';
 	 $output .= '</div>';

 	 ?>


 	 <?php
 	 return $output;



}

add_action('wp_footer','tc_post_carouse_trigger');

function tc_post_carouse_trigger(){
?>

 	 <script type="text/javascript">

 	 jQuery(document).ready(function(){
 			 jQuery(".tc-post-carousel").owlCarousel({
          // control

        autoPlay:<?php echo tc_post_carousel_get_option('auto-play', 'tc_post_carousel_basics', 'true' ); ?>,
        stopOnHover:<?php  echo tc_post_carousel_get_option('stop-onhover','tc_post_carousel_basics', 'true' ); ?>,

        // Items

        items :<?php echo tc_post_carousel_get_option('large-item-val', 'tc_post_carousel_basics','4'); ?>,
        itemsDesktop : [1199,<?php echo tc_post_carousel_get_option('items-desktop-val', 'tc_post_carousel_basics','4'); ?>],
        itemsDesktopSmall : [979,<?php echo tc_post_carousel_get_option('items-desktop-small-val', 'tc_post_carousel_basics','4'); ?>],

        // advanced Settings
        navigation :<?php echo tc_post_carousel_get_option('navigation-val', 'tc_post_carousel_advanced','true'); ?>,
        navigationText : ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        pagination:<?php echo tc_post_carousel_get_option('pagination', 'tc_post_carousel_advanced','false'); ?>,
        paginationNumbers:<?php echo tc_post_carousel_get_option('pagination-numbr', 'tc_post_carousel_advanced','false'); ?>,

        autoHeight:<?php echo tc_post_carousel_get_option('autoheight', 'tc_post_carousel_advanced','false'); ?>,

        theme : "tc-pc-theme",
        margin:5
      });
 	 });


 	 </script>
<?php
}


 ?>
