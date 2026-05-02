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
   
  <?php
    $oyk_aciklama = esc_attr( get_option( ‘oyk_site_aciklama’, ‘’ ) );
    $oyk_amblem   = esc_url( get_option( ‘oyk_amblem_url’, get_template_directory_uri() . ‘/assets/images/oyk2026kis-logo-kare.png’ ) );
    $oyk_baslik   = esc_attr( get_option( ‘oyk_site_baslik’, ‘’ ) ?: get_bloginfo( ‘name’ ) );
    $oyk_url      = esc_url( home_url( $wp->request ) );
    $oyk_domain   = parse_url( home_url(), PHP_URL_HOST );
  ?>
  <meta name="description" content="<?= $oyk_aciklama ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta property="twitter:title" content="<?= $oyk_baslik ?>" />
  <meta property="twitter:description" content="<?= $oyk_aciklama ?>" />
  <meta property="twitter:image" content="<?= $oyk_amblem ?>" />
  <meta property="twitter:url" content="<?= $oyk_url ?>" />
  <meta property="twitter:domain" content="<?= esc_attr( $oyk_domain ) ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= $oyk_baslik ?>" />
  <meta property="og:description" content="<?= $oyk_aciklama ?>" />
  <meta property="og:url" content="<?= $oyk_url ?>" />
  <meta property="og:image" content="<?= $oyk_amblem ?>" />
  <meta content="width=device-width,initial-scale=1" name="viewport">
  <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/assets/css/jquery.fancybox.min.css" />
  <?php $oyk_stili = get_option( 'oyk_tema_stili', 'kis' ); ?>
  <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/assets/css/main-<?= esc_attr( $oyk_stili ) ?>.css?<?= esc_attr( $oyk_stili ) ?>-v1">
  <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/style.css">
  <link rel="icon" type="image/png" href="<?php bloginfo("template_url"); ?>/assets/images/favicon.png" />
  <?php wp_head(); ?>
</head>

<body>

<header>
  <div class="container">
    <div class="row">
      <div class="header-logo col-md-6 col-xs-12">
        <?php
          $oyk_logo = get_option( 'oyk_logo_url', '' );
          $oyk_logo_src = $oyk_logo
            ? esc_url( $oyk_logo )
            : get_template_directory_uri() . '/assets/images/oyk2026kis-logo.png';
        ?>
        <a href="<?php bloginfo('url'); ?>"><img src="<?= $oyk_logo_src ?>" width="429" height="auto" alt="<?php bloginfo('name'); ?>"></a>
      </div>
      <div class="header-logo-list col-md-6 col-xs-12">
        <div class="pull-right pull-right-xs">
          <?php foreach ( get_option( 'oyk_partner_logolar', array() ) as $partner ) : ?>
            <?php if ( empty( $partner['gorsel'] ) ) continue; ?>
            <?php if ( ! empty( $partner['link'] ) ) : ?>
              <a href="<?= esc_url( $partner['link'] ) ?>" target="_blank">
                <img src="<?= esc_url( $partner['gorsel'] ) ?>" height="100" width="100" alt="<?= esc_attr( $partner['alt'] ?? '' ) ?>">
              </a>
            <?php else : ?>
              <img src="<?= esc_url( $partner['gorsel'] ) ?>" height="100" width="100" alt="<?= esc_attr( $partner['alt'] ?? '' ) ?>">
            <?php endif; ?>
          <?php endforeach; ?>
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
