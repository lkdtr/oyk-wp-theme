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
                <tr class="<?=getCalendarRowClass("11-07-2024", "19-07-2024")?>">
                  <td class="calendar-date-title">Eğitmen Başvuruları</td>
                  <td>11-19 Temmuz 2024</td>
                </tr>
                <tr class="<?=getCalendarRowClass("20-07-2024", "21-07-2024")?>">
                  <td class="calendar-date-title">Eğitimlerin Belirlenmesi</td>
                  <td>20-21 Temmuz 2024</td>
                </tr>
                <tr class="<?=getCalendarRowClass("22-07-2024", "04-08-2024")?>">
                  <td class="calendar-date-title">Katılımcı Başvuruları</td>
                  <td>22 Temmuz - 4 Ağustos 2024</td>
                </tr>
                <tr class="<?=getCalendarRowClass("05-08-2024", "07-08-2024")?>">
                  <td class="calendar-date-title">1. Tur Yerleştirmeler</td>
                  <td>5-7 Ağustos 2024</td>
                </tr>
                <tr class="<?=getCalendarRowClass("08-08-2024", "11-08-2024")?>">
                  <td class="calendar-date-title">2. Tur Yerleştirmeler</td>
                  <td>8-11 Ağustos 2024</td>
                </tr>
                <tr class="<?=getCalendarRowClass("24-08-2024", "31-08-2024")?>">
                  <td class="calendar-date-title">KAMP</td>
                  <td>24-31 Ağustos 2024</td>
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
