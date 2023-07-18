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
                <tr class="<?=getCalendarRowClass("02-01-2023", "06-01-2023")?>">
                  <td class="calendar-date-title">Eğitmen Başvuruları</td>
                  <td>2 - 6 Ocak</td>
                </tr>
                <tr class="<?=getCalendarRowClass("02-01-2023", "06-01-2023")?>">
                  <td class="calendar-date-title">Eğitimlerin Belirlenmesi</td>
                  <td>2 - 6 Ocak</td>
                </tr>
                <tr class="<?=getCalendarRowClass("10-01-2023", "15-01-2023")?>">
                  <td class="calendar-date-title">Katılımcı Başvuruları</td>
                  <td>10 - 15 Ocak</td>
                </tr>
                <tr class="<?=getCalendarRowClass("16-01-2023", "20-01-2023")?>">
                  <td class="calendar-date-title">1. Tur Yerleştirmeler</td>
                  <td>16 - 20 Ocak</td>
                </tr>
                <tr class="<?=getCalendarRowClass("21-01-2023", "22-01-2023")?>">
                  <td class="calendar-date-title">2. Tur Yerleştirmeler</td>
                  <td>21 - 22 Ocak</td>
                </tr>
                <tr class="<?=getCalendarRowClass("04-02-2023", "08-02-2023")?>">
                  <td class="calendar-date-title">KAMP</td>
                  <td>4 - 8 Şubat</td>
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
