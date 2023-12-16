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
                <tr class="<?=getCalendarRowClass("20-07-2024", "28-07-2024")?>">
                  <td class="calendar-date-title">Eğitmen Başvuruları</td>
                  <td>20 - 28 Temmuz</td>
                </tr>
                <tr class="<?=getCalendarRowClass("29-07-2024", "30-07-2024")?>">
                  <td class="calendar-date-title">Eğitimlerin Belirlenmesi</td>
                  <td>29 - 30 Temmuz</td>
                </tr>
                <tr class="<?=getCalendarRowClass("31-07-2024", "13-08-2024")?>">
                  <td class="calendar-date-title">Katılımcı Başvuruları</td>
                  <td>31 Temmuz - 13 Ağustos</td>
                </tr>
                <tr class="<?=getCalendarRowClass("14-08-2024", "16-08-2024")?>">
                  <td class="calendar-date-title">1. Tur Yerleştirmeler</td>
                  <td>14 - 16 Ağustos</td>
                </tr>
                <tr class="<?=getCalendarRowClass("17-08-2024", "20-08-2024")?>">
                  <td class="calendar-date-title">2. Tur Yerleştirmeler</td>
                  <td>17 - 20 Ağustos</td>
                </tr>
                <tr class="<?=getCalendarRowClass("25-08-2024", "03-09-2024")?>">
                  <td class="calendar-date-title">KAMP</td>
                  <td>25 Ağustos - 3 Eylül</td>
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
