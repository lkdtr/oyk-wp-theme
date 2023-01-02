<?php
/*
Template Name: Hakkında
*/
?>

<?php get_header(); ?>
<section class="page about">
  <div class="container">
    <div class="row">
      <div class="about-text col-md-6 col-sm-6 col-xs-12">
        <h1><?php the_title(); ?></h1>
        <?php if (function_exists('the_breadcrumb')) the_breadcrumb(); ?>
        <?php if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();
            the_content();
            ?>
          <?php endwhile; else: ?>
          <p><?php _e('Sonuç Bulunamadı.'); ?></p>
        <?php endif; ?>
      </div>
      <div class="about-image col-xs-9 col-md-push-2 col-xs-push-1 col-md-3 col-sm-6 col-sm-push-0">
        <img src="<?php bloginfo("template_url"); ?>/assets/images/oyk2023kis-logo-kare.png" alt="">
      </div>
    </div>
  </div>
</section>

<section class="past-years">
  <div class="container">
    <h1>Geçmiş Yıllar</h1>
    <div class="row">
      <div class="past-years-slider col-md-5 col-xs-12 col-sm-5">
        <div class="owl-carousel owl-theme">
          <div class="item">
            <a data-fancybox="gallery" href="<?php bloginfo("template_url"); ?>/assets/images/kis2020-1.jpg"><img src="<?php bloginfo("template_url"); ?>/assets/images/kis2020-1.jpg"></a>
          </div>
          <div class="item">
            <a data-fancybox="gallery" href="<?php bloginfo("template_url"); ?>/assets/images/kis2020-2.jpg"><img src="<?php bloginfo("template_url"); ?>/assets/images/kis2020-2.jpg"></a>
          </div>
          <div class="item">
            <a data-fancybox="gallery" href="<?php bloginfo("template_url"); ?>/assets/images/kis2020-3.jpg"><img src="<?php bloginfo("template_url"); ?>/assets/images/kis2020-3.jpg"></a>
          </div>
          <div class="item">
            <a data-fancybox="gallery" href="<?php bloginfo("template_url"); ?>/assets/images/kis2020-4.jpg"><img src="<?php bloginfo("template_url"); ?>/assets/images/kis2020-4.jpg"></a>
          </div>
        </div>
      </div>
      
      <div class="col-md-2 col-xs-12 col-sm-5"></div>
      
      <div class="past-years-slider col-md-5 col-xs-12 col-sm-5">
        <div class="owl-carousel owl-theme">
          <div class="item">
            <a data-fancybox="gallery" href="<?php bloginfo("template_url"); ?>/assets/images/yaz2022-1.jpg"><img src="<?php bloginfo("template_url"); ?>/assets/images/yaz2022-1.jpg"></a>
          </div>
          <div class="item">
            <a data-fancybox="gallery" href="<?php bloginfo("template_url"); ?>/assets/images/yaz2022-2.jpg"><img src="<?php bloginfo("template_url"); ?>/assets/images/yaz2022-2.jpg"></a>
          </div>
          <div class="item">
            <a data-fancybox="gallery" href="<?php bloginfo("template_url"); ?>/assets/images/yaz2022-3.jpg"><img src="<?php bloginfo("template_url"); ?>/assets/images/yaz2022-3.jpg"></a>
          </div>
          <div class="item">
            <a data-fancybox="gallery" href="<?php bloginfo("template_url"); ?>/assets/images/yaz2022-4.jpg"><img src="<?php bloginfo("template_url"); ?>/assets/images/yaz2022-4.jpg"></a>
          </div>
        </div>
      </div>
   </div>
   <div class="row">
      <div class="past-years-list col-md-6 col-xs-12 col-sm-5">
        <ul>
	  <li><a href="https://kamp.linux.org.tr/2022/">Mustafa Akgül Özgür Yazılım Yaz Kampı 2022</a> / Bolu Abant İzzet Baysal Üniversitesi</li>
          <li>Mustafa Akgül Özgür Yazılım Kış Kampı 2020 / Anadolu Üniversitesi</li>
          
	  <li>Mustafa Akgül Özgür Yazılım Yaz Kampı 2019 / Bolu Abant İzzet Baysal Üniversitesi</li>
	  <li>Mustafa Akgül Özgür Yazılım Kış Kampı 2019 / Ordu Üniversitesi</li>
	  
	  <li>Özgür Yazılım Yaz Kampı 2018 / Bolu Abant İzzet Baysal Üniversitesi</li>
    	  <li>Konferans Öncesi Kurslar 2018 / Karabük Üniversitesi</li>
          
          <li>Linux Yaz Kampı 2017 / Bolu Abant İzzet Baysal Üniversitesi</li>
    	  <li>Konferans Öncesi Kurslar 2017 / Aksaray Üniversitesi</li>
    	  
          <li>Linux Yaz Kampı 2016 / Bolu Abant İzzet Baysal Üniversitesi</li>
          <li>Konferans Öncesi Kurslar 2016 / Aydın Adnan Menderes Üniversitesi</li>
              
          <li>Linux Yaz Kampı 2015 / Bolu Abant İzzet Baysal Üniversitesi</li>
          <li>Konferans Öncesi Kurslar 2015 / Eskişehir Anadolu Üniversitesi</li>
              
          <li>Linux Yaz Kampı 2014 / Bolu Abant İzzet Baysal Üniversitesi</li>
          <li>Konferans Öncesi Kurslar  2014 / Mersin Üniversitesi</li>            
        </ul>
     </div>
     
      <div class="past-years-list col-md-6 col-xs-12 col-sm-5">
        <ul>

          <li>Linux Yaz Kampı 2013 / Bolu Abant İzzet Baysal Üniversitesi</li>
          <li>Konferans Öncesi Kurslar  2013 / Antalya Akdeniz Üniversitesi</li>
              
          <li>Linux Yaz Kampı 2012 / Bolu Abant İzzet Baysal Üniversitesi</li>
          <li>Konferans Öncesi Kurslar  2012 / Uşak Üniversitesi</li>
         
          <li>Linux Yaz Kampı 2011 / Düzce Üniversitesi</li>
          <li>Konferans Öncesi Kurslar  2011 / Malatya İnönü Üniversitesi</li>
              
          <li>Linux Yaz Kampı 2010 / Işık Üniversitesi Şile Yerleşkesi</li>
          <li>Konferans Öncesi Kurslar 2010 / Muğla Üniversitesi</li>
          
          <hr>
          
          <li>Konferans Öncesi Kurslar 2009 / Urfa Harran Üniversitesi</li>
          <li>Konferans Öncesi Kurslar 2008 / Çanakkale Onsekiz Mart Üniversitesi</li>
          <li>Konferans Öncesi Kurslar 2007 / Kütahya Dumlupınar Üniversitesi</li>
          <li>Konferans Öncesi Kurslar 2006 / Denizli Pamukkale Üniversitesi</li>
          <li>Konferans Öncesi Kurslar 2005 / Gaziantep Üniversitesi</li>
          <li>Konferans Öncesi Kurslar 2002 / Konya Selçuk Üniversitesi</li>
          <li>Konferans Öncesi Kurslar 2001 / Samsun Ondokuz Mayıs Üniversitesi</li>
          <li>Konferans Öncesi Kurslar 1999 / Orta Doğu Teknik Üniversitesi</li>
          
          
          
        </ul>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
