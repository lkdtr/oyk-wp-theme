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
                <tr class="<?=getCalendarRowClass("09-01-2026", "14-01-2026")?>">
                  <td class="calendar-date-title">Eğitim Düzenleme Başvurusu</td>
                  <td>09 - 14 Ocak 2026</td>
                </tr>
                <tr class="<?=getCalendarRowClass("15-01-2026", "17-01-2026")?>">
                  <td class="calendar-date-title">Eğitimlerin Belirlenmesi</td>
                  <td>15 - 17 Ocak 2026</td>
                </tr>
                <tr class="<?=getCalendarRowClass("19-01-2026", "26-01-2026")?>">
                  <td class="calendar-date-title">Katılımcı Başvuruları</td>
                  <td>19 - 26 Ocak 2026</td>
                </tr>
                <tr class="<?=getCalendarRowClass("27-01-2026", "28-01-2026")?>">
                  <td class="calendar-date-title">1. Tur Yerleştirmeler</td>
                  <td>27 - 28 Ocak 2026</td>
                </tr>
                <tr class="<?=getCalendarRowClass("29-01-2026", "31-01-2026")?>">
                  <td class="calendar-date-title">2. Tur Yerleştirmeler</td>
                  <td>29 - 31 Ocak 2026</td>
                </tr>
                <tr class="<?=getCalendarRowClass("04-02-2026", "08-02-2026")?>">
                  <td class="calendar-date-title">KAMP</td>
                  <td>04 - 08 Şubat 2026</td>
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
