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
                <tr class="<?=getCalendarRowClass("01-06-2025", "30-06-2025")?>">
                  <td class="calendar-date-title">Eğitim Düzenleme Başvurusu</td>
                  <td>01 - 30 Haziran 2025</td>
                </tr>
                <tr class="<?=getCalendarRowClass("01-07-2025", "10-07-2025")?>">
                  <td class="calendar-date-title">Eğitimlerin Belirlenmesi</td>
                  <td>01 - 10 Temmuz 2025</td>
                </tr>
                <tr class="<?=getCalendarRowClass("16-07-2025", "27-07-2025")?>">
                  <td class="calendar-date-title">Katılımcı Başvuruları</td>
                  <td>16 - 27 Temmuz 2025</td>
                </tr>
                <tr class="<?=getCalendarRowClass("28-07-2025", "01-08-2025")?>">
                  <td class="calendar-date-title">1. Tur Yerleştirmeler</td>
                  <td>28 Temmuz - 01 Ağustos 2025</td>
                </tr>
                <tr class="<?=getCalendarRowClass("02-08-2025", "06-08-2025")?>">
                  <td class="calendar-date-title">2. Tur Yerleştirmeler</td>
                  <td>02 - 06 Ağustos 2025</td>
                </tr>
                <tr class="<?=getCalendarRowClass("23-08-2025", "31-08-2025")?>">
                  <td class="calendar-date-title">KAMP</td>
                  <td>23 - 31 Ağustos 2025</td>
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
