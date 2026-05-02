<?php
/*
Template Name: Ana sayfa
*/
?>

<?php get_header(); ?>

<section class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <?php if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();
            the_content();
            ?>
          <?php endwhile; else: ?>
          <p><?php _e('Sonuç Bulunamadı.'); ?></p>
        <?php endif; ?>
      </div>
      <div class="col-md-5">
        <div class="">
          <div class="calendar">
            <table class="table">
              <thead class="calendar-title">
                <tr>
                  <th colspan="2" class="text-center">Takvim</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ( get_option( 'oyk_takvim', array() ) as $row ) : ?>
                <tr class="<?= esc_attr( getCalendarRowClass( $row['baslangic'], $row['bitis'] ) ) ?>">
                  <td class="calendar-date-title"><?= esc_html( $row['baslik'] ) ?></td>
                  <td><?= esc_html( oyk_format_date_range_tr( $row['baslangic'], $row['bitis'] ) ) ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
