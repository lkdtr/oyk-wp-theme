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
                <tr class="<?=getCalendarRowClass("28-12-2024", "09-01-2025")?>">
                  <td class="calendar-date-title">Eğitmen Başvuruları</td>
                  <td>28 Aralık 2024 - 09 Ocak 2025</td>
                </tr>
                <tr class="<?=getCalendarRowClass("10-01-2025", "14-01-2025")?>">
                  <td class="calendar-date-title">Eğitimlerin Belirlenmesi</td>
                  <td>10 - 14 Ocak 2025</td>
                </tr>
                <tr class="<?=getCalendarRowClass("15-01-2025", "24-01-2025")?>">
                  <td class="calendar-date-title">Katılımcı Başvuruları</td>
                  <td>15 - 24 Ocak 2025</td>
                </tr>
                <tr class="<?=getCalendarRowClass("25-01-2025", "26-01-2025")?>">
                  <td class="calendar-date-title">1. Tur Yerleştirmeler</td>
                  <td>25 - 26 Ocak 2025</td>
                </tr>
                <tr class="<?=getCalendarRowClass("27-01-2025", "29-01-2025")?>">
                  <td class="calendar-date-title">2. Tur Yerleştirmeler</td>
                  <td>27 - 29 Ocak 2025</td>
                </tr>
                <tr class="<?=getCalendarRowClass("10-02-2025", "14-02-2025")?>">
                  <td class="calendar-date-title">KAMP</td>
                  <td>10 - 14 Şubat 2025</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
