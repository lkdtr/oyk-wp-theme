<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>
  <?php
    global $page, $paged;
    wp_title( '|', true, 'right' );
    bloginfo( 'name' );
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
      echo " | $site_description";
    if ( $paged >= 2 || $page >= 2 )
      echo ' | ' . sprintf( _( 'Page %s', 'sipsi' ), max( $paged, $page ) );
    ?>
  </title>
  <meta charset="UTF-8">
  <meta name="description" content="Mustafa Akgül Özgür Yazılım Kış Kampı 2023 4-8 Şubat tarihleri arasında Eskişehir Osmangazi Üniversitesinde. Başvurular 10-15 Ocak tarihlerinde.">
  <meta property="og:title" content="<?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?>" />
  <meta property="og:description" content="Mustafa Akgül Özgür Yazılım Kış Kampı 2023 4-8 Şubat tarihleri arasında Eskişehir Osmangazi Üniversitesinde. Başvurular 10-15 Ocak tarihlerinde." />
  <meta property="og:url" content="<?=home_url( $wp->request )?>" />
  <meta property="og:image" content="<?php bloginfo("template_url"); ?>/assets/images/ozgur-yazilim-yaz-kampi-2018.jpg" />
  <meta content="width=device-width,initial-scale=1" name="viewport">
  <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/assets/css/jquery.fancybox.min.css" />
  <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/assets/css/main.min.css">
  <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/style.css">
  <link rel="icon" type="image/png" href="<?php bloginfo("template_url"); ?>/assets/images/favicon.png" />
  <?php wp_head(); ?>
</head>

<body>

<header>
  <div class="container">
    <div class="row">
      <div class="header-logo col-md-6 col-xs-12">
        <a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo("template_url"); ?>/assets/images/oyk2023kis-logo.png" alt=""></a>
      </div>
      <div class="header-logo-list col-md-6 col-xs-12">
        <div class="pull-right pull-right-xs">
          <a href="http://www.lkd.org.tr/" target="_blank">
            <img src="<?php bloginfo("template_url"); ?>/assets/images/tlkd.png" height="74" width="74" alt="">
          </a>
          <a href="http://www.ogu.edu.tr/" target="_blank">
            <img src="<?php bloginfo("template_url"); ?>/assets/images/ogu.png"  height="74" width="74" alt="">
          </a>
        </div>
      </div>
    </div>
  </div>
</header>
<nav class="header-menu hidden-xs">
  <div class="container">
    <?php wp_nav_menu( array( 'theme_location' => 'menu', 'items_wrap' => '<ul id="menu-header">%3$s</ul>', 'menu_id' => 'menu-header')); ?>
  </div>
</nav>
