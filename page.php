<?php

  get_header();

  while(have_posts()) {
    the_post(); ?>
    
    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg')?>)"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title();?></h1>
        <div class="page-banner__intro">
          <p>DONT FORGET TO REPLACE ME LATER</p>
        </div>
      </div>
    </div>

    <!-- SHOWS THE BREADCRUMB MENU ONLY IF THE PAGE IS A CHILD PAGE -->
    <?php
      // GETS THE ID OF THE PARENT PAGE OR, IF THE PAGE IS A PARENT PAGE ITSELF, RETURNS 0, OR FALSE
      $theParent = wp_get_post_parent_id(get_the_ID());

      if($theParent) {
        ?>
        <div class="container container--narrow page-section">
          <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
              <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent)?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent)?></a> <span class="metabox__main"><?php the_title();?></span>
            </p>
          </div>
        <?php
      };
    ?>

    <!-- SHOW THE SIDEBAR LINKS MENU ONLY IF THE PAGE IS A PARENT PAGE OR A CHILDREN PAGE -->
    <?php
    // CHECK IF A PAGE IS A PARENT PAGE
    // IF GET_PAGES() RETURN SOMETHING, THAT IS A PARENT PAGE, ELSE IT WILL RETURN 0
    $isAParent = get_pages(array(
      'child_of' => get_the_ID()
    ));

    if($theParent || $isAParent) { ?>
    <!-- SHOWS A SIDEBAR WITH THE PARENT PAGE AND RELATED CHILDREN PAGES -->
    <div class="page-links">
      <!-- IF $THEPARENT RETURNS ZERO, GET_THE_TITLE() WILL KNOW THAT WE'RE SEARCHING THE TITLE FOR THE CURRENT PAGE, OR IT WILL GET THE CHILD PAGE TITLE -->
      <h2 class="page-links__title"><a href="<?php the_permalink($theParent)?>"><?php echo get_the_title($theParent)?></a></h2>
      <ul class="min-list">
        <?php
          if($theParent){
            // IF IT RETURNS AN ID, IT'S A CHILDREN PAGE, SO GET THE RELATED PARENT PAGE
            $findChildrenOf = $theParent;
          } else {
            // IF RETURN 0 IT'S A PARENT PAGE, SO JUST GET THE ID
            $findChildrenOf = get_the_ID();
          }

          wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $findChildrenOf
          ));
        ?>
      </ul>
    </div>
    <?php } ?>

      <div class="generic-content">
        <?php the_content(); ?>
      </div>
    </div>
    
  <?php }

  get_footer();

?>