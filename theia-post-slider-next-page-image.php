<?php
/*
Plugin Name: Theia Post Slider Next Page Image Linker
Plugin URI:
Description: Adds a simple script that adds a link to each image of a slideshow that links the user to the next page.
Author: Al Friedl (Made into a plugin by Tim Asp)
Version: 1.0.0
*/

add_action('wp_footer', 'TpsNextPageImage::wp_footer');

class TpsNextPageImage {
   public static function wp_footer() {
 ?>
      <script>
         jQuery(document).ready(function($){
            if ($('div.theiaPostSlider_slides').length > 0) {
               var nextSlide = $('div.theiaPostSlider_nav a[rel="next"]');
               var slideshowNext = $('._startSlideshowButtons a');
               var slideImgs = $('div.theiaPostSlider_slides img[src*="'+window.location.hostname+'"]');
               if ((nextSlide.length || slideshowNext.length) && slideImgs.length) {
                  var nextLink;
                  if (slideshowNext.length) {
                     nextLink = slideshowNext.attr('href');
                  } else {
                     nextLink = nextSlide.attr('href');
                  }
                  slideImgs.each(function() {
                     var $this = $(this);
                     var parentEl = $this.parent()
                     if (parentEl[0].tagName.toLowerCase() === 'a') {
                        parentEl.attr('href', nextLink);
                     } else {
                        $this.wrap('<a href="' + nextLink + '"></a>');
                     }
                  });
               }
            }
         });
      </script>
<?php
   }
}

