<?php
/* Index Page */

get_header()

?>


<?php


global $current_user;



if (is_user_logged_in()) {


$article_terms = get_terms( array(
    'taxonomy' => 'projecttype',
    'hide_empty' => true,

) );
// echo '<pre>';
// print_r($article_terms);

if ( empty( $article_terms ) || ! is_array( $article_terms ) ) {
    return;
}
$links = array();
    $project_type = array(
    'post_type' => 'project',
    'taxonomy' => 'projecttype',
    'posts_per_page' => 3 , 
    'order' => 'DSC', 
    'post_status' => 'publish',
    'fields' => 'slug',
    'slug' => '$article_term->slug'


);

$post_num = new WP_Query($project_type); ?>
<div class="top"><div> 
<div class="container blog ">
<div class="row mt-5" >
<div class="block text-center"></div>

<?php

while ( $post_num->have_posts() ) { $post_num->the_post();?>

     <div class="col-md-4 col-sm-12">
            <div class="service-item mb-4">
             <?php the_post_thumbnail('thumbi'); ?>
             <div class="text">
                <?php foreach ( $article_terms as $key => $article_term ) {?>
             <p class="content mt-3"><a href="<?php the_permalink();?>">
                <?php  the_title();?> </a></br><h6> <?php echo $article_term->name;?></h6></p> </div>
             <div class="excerpt"> <?php the_excerpt() ?></div>
            </div>
            </div>
              <?php }?>



<?php }
 




}



else { 

$article_terms = get_terms( array(
    'taxonomy' => 'projecttype',
    'hide_empty' => false,
) );
// echo '<pre>';
// print_r($article_terms);

if ( empty( $article_terms ) || ! is_array( $article_terms ) ) {
    return;
}

    $project_type = array(
    'post_type' => 'project',
    'taxonomy' => 'projecttype',
    'posts_per_page' => 6 , 
    'order' => 'ASC', 
    'paged' => get_query_var('paged', 1),
    'post_status' => 'publish');

$post_num = new WP_Query($project_type); ?>
<div class="top"><div> 
<div class="container blog ">
<div class="row mt-5" >
<div class="block text-center"></div>

<?php

while ( $post_num->have_posts() ) { $post_num->the_post();?>

                     <div class="col-md-4 col-sm-12">
                            <div class="service-item mb-4">

                             <?php the_post_thumbnail('thumbi'); ?>
                             <div class="text">
                        <?php  foreach ( $article_terms as $key => $article_term ) {?>
                             <p class="content mt-3"><a href="<?php the_permalink();?>"> <?php echo the_title(); ?></a></br><h6> <?php echo $article_term->name;?></h6></p> </div>
                             <div class="excerpt"> <?php the_excerpt() ?></div>
                             <?php }?>
                        </div>
                        </div>
     
     
 

    <?php }

     echo paginate_links(array(
    'total' => $post_num->max_num_pages )); 


}

?>

 




  

      

 