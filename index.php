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

                <tr class="<?=getCalendarRowClass("19.12.2023", "27.12.2023")?>">
                  <td class="calendar-date-title">Eğitmen Başvuruları</td>
                  <td>19 - 28 Aralık 2023</td>
                </tr>
                <tr class="<?=getCalendarRowClass("29.12.2023", "02.01.2024")?>">
                  <td class="calendar-date-title">Eğitimlerin Belirlenmesi</td>
                  <td>29 Aralık 2023 - 2 Ocak 2024</td>
                </tr>
                <tr class="<?=getCalendarRowClass("03.01.2024", "12.01.2024")?>">
                  <td class="calendar-date-title">Katılımcı Başvuruları</td>
                  <td>3 - 12 Ocak 2024</td>
                </tr>
                <tr class="<?=getCalendarRowClass("13.01.2024", "15.01.2024")?>">
                  <td class="calendar-date-title">1. Tur Yerleştirmeler</td>
                  <td>13 - 15 Ocak 2024</td>
                </tr>
                <tr class="<?=getCalendarRowClass("16.01.2024", "19.01.2024")?>">
                  <td class="calendar-date-title">2. Tur Yerleştirmeler</td>
                  <td>16 - 19 Ocak 2024</td>
                </tr>
                <tr class="<?=getCalendarRowClass("30.01.2024", "02.02.2024")?>">
                  <td class="calendar-date-title">KAMP</td>
                  <td>30 Ocak - 2 Şubat 2024</td>
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
