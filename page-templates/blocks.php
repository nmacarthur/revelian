<?php

// check if the repeater field has rows of data
if( have_rows('blocks') ) {

  // loop through the rows of data
  while ( have_rows('blocks') ) { the_row();

    // Setup <section> for each content block
    get_template_part( 'page-templates/blocks/block-setup' );

    // check if the flexible content field has rows of data
    if( have_rows('section') ) {

      // loop through the rows of data
      while ( have_rows('section') ) { the_row();

         get_template_part( 'page-templates/blocks/text-block' );
         get_template_part( 'page-templates/blocks/50-50' );
         get_template_part( 'page-templates/blocks/text-image' );
         get_template_part( 'page-templates/blocks/cta' );
         get_template_part( 'page-templates/blocks/image' );
         get_template_part( 'page-templates/blocks/feature-columns' );
         get_template_part( 'page-templates/blocks/line-break' );
         get_template_part( 'page-templates/blocks/feature' );
         get_template_part( 'page-templates/blocks/testimonials' );
         get_template_part( 'page-templates/blocks/video' );
         get_template_part('page-templates/blocks/image-split');
         get_template_part('page-templates/blocks/code-block');
         get_template_part('page-templates/blocks/pricing-table');
         get_template_part('page-templates/blocks/text-code-block');
         get_template_part('page-templates/blocks/client-logos');
         get_template_part('page-templates/blocks/products');
         get_template_part('page-templates/blocks/team-block');
         get_template_part('page-templates/blocks/blog-posts');
         get_template_part('page-templates/blocks/amchart');
         get_template_part('page-templates/blocks/solutions');
         get_template_part('page-templates/blocks/skillstests');
         get_template_part('page-templates/blocks/counter');


      }

    }

    echo '</section>'; // Opened in block-setup.php

  }
}



?>


