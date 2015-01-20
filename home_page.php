<?php
/*
* Template Name: Home Page
* */

get_header();

$template_type = get_post_custom_values('template_type');
$args = array(
  'posts_per_page' => '-1',
  'post_type' => $template_type,
);
$myItems = new WP_Query( $args );
$i = 0;
$total = $myItems->found_posts;
?>


<!-- Get the content of the page itself
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        if( '' !== get_post()->post_content ) { ?>
                <?php $page_content = the_content(); ?>
<?php } endwhile; else:
    // no posts found
endif;
?>
 -->


 <!-- Get latest press post -->

<!-- Functions -->
<?php function create_item() { ?>
    <div class="home_item">
        <div class="arrow_right"> </div>
        <span> <?php the_title(); ?> </span>
    </div>
<?php } ?>


<!-- Start making the page -->

<!-- Home Title -->
<?php if (has_post_thumbnail( $post->ID )) : ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
<div class="home_title_container" style="background-image: url(' <?php echo $image[0]; ?> ')">
<?php endif; ?>
    <div class="title_text">
        <h1> Learning the Past, Building the Future </h1>
    </div>

    <div class="press_window">
        <?php
        $args = array(
          'posts_per_page' => '1',
          'post_type' => 'post',
        );
        $home_items = new WP_Query( $args );
        if( $home_items->have_posts() ) : while( $home_items->have_posts() ) : $home_items->the_post();  ?>

        <div class="press_window_text">
            <?php echo the_date(); ?> <br>
            <b> <?php the_title(); ?> </b> <br>
            <?php the_content( 'Read More' , true ); ?>
        </div>

        <?php endwhile; endif; ?>
        ?>
    </div>
</div>

<!-- Content -->
<div class="custom_page_padding">
            <?php
            while($i < $total) : $myItems->the_post();
                create_item();
                $i++;
            endwhile;
            ?>
</div>


<?php
wp_reset_postdata();

get_sidebar();
get_footer(); ?>
