<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/* --------------------------------------------------------------------------
 * Varsayılan veri — seçenekler henüz yoksa yükle
 * -------------------------------------------------------------------------- */
function oyk_takvim_default_data() {
  if ( get_option( 'oyk_takvim' ) === false ) {
    add_option( 'oyk_takvim', array(
      array( 'baslik' => 'Eğitim Düzenleme Başvurusu', 'baslangic' => '2026-01-09', 'bitis' => '2026-01-14' ),
      array( 'baslik' => 'Eğitimlerin Belirlenmesi',   'baslangic' => '2026-01-15', 'bitis' => '2026-01-17' ),
      array( 'baslik' => 'Katılımcı Başvuruları',      'baslangic' => '2026-01-19', 'bitis' => '2026-01-26' ),
      array( 'baslik' => '1. Tur Yerleştirmeler',      'baslangic' => '2026-01-27', 'bitis' => '2026-01-28' ),
      array( 'baslik' => '2. Tur Yerleştirmeler',      'baslangic' => '2026-01-29', 'bitis' => '2026-01-31' ),
      array( 'baslik' => 'KAMP',                       'baslangic' => '2026-02-04', 'bitis' => '2026-02-08' ),
    ) );
  }
  if ( get_option( 'oyk_tema_stili' ) === false ) {
    add_option( 'oyk_tema_stili', 'kis' );
  }
  if ( get_option( 'oyk_amblem_url' ) === false ) {
    add_option( 'oyk_amblem_url', '' );
  }
  if ( get_option( 'oyk_partner_logolar' ) === false ) {
    add_option( 'oyk_partner_logolar', array(
      array(
        'gorsel' => get_template_directory_uri() . '/assets/images/tlkd.png',
        'link'   => 'http://www.lkd.org.tr/',
        'alt'    => 'LKD',
      ),
      array(
        'gorsel' => get_template_directory_uri() . '/assets/images/aku.png',
        'link'   => 'http://www.ibu.edu.tr/',
        'alt'    => 'AKÜ',
      ),
    ) );
  }
}
add_action( 'after_setup_theme', 'oyk_takvim_default_data' );

/* --------------------------------------------------------------------------
 * Admin menüsü — Görünüm > Tema Ayarları
 * -------------------------------------------------------------------------- */
function oyk_takvim_admin_menu() {
  add_theme_page(
    'Tema Ayarları',
    'Tema Ayarları',
    'edit_theme_options',
    'oyk-tema',
    'oyk_takvim_admin_page'
  );
}
add_action( 'admin_menu', 'oyk_takvim_admin_menu' );

/* --------------------------------------------------------------------------
 * Media uploader için script ekle
 * -------------------------------------------------------------------------- */
function oyk_tema_enqueue_scripts( $hook ) {
  if ( $hook !== 'appearance_page_oyk-tema' ) return;
  wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'oyk_tema_enqueue_scripts' );

/* --------------------------------------------------------------------------
 * Admin sayfası render
 * -------------------------------------------------------------------------- */
function oyk_takvim_admin_page() {
  if ( ! current_user_can( 'edit_theme_options' ) ) {
    wp_die( 'Yetkiniz yok.' );
  }

  $rows            = get_option( 'oyk_takvim', array() );
  $tema_stili      = get_option( 'oyk_tema_stili', 'kis' );
  $logo_url        = get_option( 'oyk_logo_url', '' );
  $amblem_url      = get_option( 'oyk_amblem_url', '' );
  $partner_logolar = get_option( 'oyk_partner_logolar', array() );
  $notice          = '';

  if ( isset( $_GET['oyk_saved'] ) ) {
    $notice = '<div class="notice notice-success is-dismissible"><p>Ayarlar kaydedildi.</p></div>';
  }
  ?>
  <div class="wrap">
    <h1>Tema Ayarları</h1>
    <?= $notice ?>

    <form method="post" action="<?= esc_url( admin_url( 'admin-post.php' ) ) ?>">
      <?php wp_nonce_field( 'oyk_tema_save', 'oyk_tema_nonce' ); ?>
      <input type="hidden" name="action" value="oyk_tema_save">

      <!-- ── Renk Teması ─────────────────────────────────────────── -->
      <h2 class="title">Renk Teması</h2>
      <table class="form-table" role="presentation">
        <tr>
          <th scope="row">Mevsim</th>
          <td>
            <label style="margin-right:20px">
              <input type="radio" name="tema_stili" value="kis" <?php checked( $tema_stili, 'kis' ); ?>>
              Kış (main-kis.css)
            </label>
            <label>
              <input type="radio" name="tema_stili" value="yaz" <?php checked( $tema_stili, 'yaz' ); ?>>
              Yaz (main-yaz.css)
            </label>
          </td>
        </tr>
      </table>

      <!-- ── Site Logosu ─────────────────────────────────────────── -->
      <h2 class="title">Site Logosu</h2>
      <table class="form-table" role="presentation">
        <tr>
          <th scope="row">Logo</th>
          <td>
            <div style="margin-bottom:8px">
              <?php if ( $logo_url ) : ?>
                <img src="<?= esc_url( $logo_url ) ?>" style="max-height:80px;display:block;margin-bottom:6px" id="oyk-logo-img">
              <?php else : ?>
                <img src="" style="max-height:80px;display:none;margin-bottom:6px" id="oyk-logo-img">
              <?php endif; ?>
            </div>
            <input type="hidden" name="logo_url" id="oyk-logo-url" value="<?= esc_attr( $logo_url ) ?>">
            <button type="button" class="button" id="oyk-logo-sec">Logo Seç / Yükle</button>
            <button type="button" class="button button-link-delete" id="oyk-logo-kaldir" <?php echo $logo_url ? '' : 'style="display:none"'; ?>>Logoyu Kaldır</button>
            <p class="description">PNG veya SVG önerilir. Header'da gösterilecektir.</p>
          </td>
        </tr>
      </table>

      <!-- ── Amblem ──────────────────────────────────────────────── -->
      <h2 class="title">Amblem (Kare Logo)</h2>
      <table class="form-table" role="presentation">
        <tr>
          <th scope="row">Amblem</th>
          <td>
            <div style="margin-bottom:8px">
              <?php if ( $amblem_url ) : ?>
                <img src="<?= esc_url( $amblem_url ) ?>" style="max-height:80px;display:block;margin-bottom:6px" id="oyk-amblem-img">
              <?php else : ?>
                <img src="" style="max-height:80px;display:none;margin-bottom:6px" id="oyk-amblem-img">
              <?php endif; ?>
            </div>
            <input type="hidden" name="amblem_url" id="oyk-amblem-url" value="<?= esc_attr( $amblem_url ) ?>">
            <button type="button" class="button" id="oyk-amblem-sec">Amblem Seç / Yükle</button>
            <button type="button" class="button button-link-delete" id="oyk-amblem-kaldir" <?php echo $amblem_url ? '' : 'style="display:none"'; ?>>Amblem Kaldır</button>
            <p class="description">Kare formatta PNG önerilir. Sosyal medya paylaşım önizlemelerinde (og:image, twitter:image) kullanılır.</p>
          </td>
        </tr>
      </table>

      <!-- ── Partner Logoları ────────────────────────────────────── -->
      <h2 class="title">Header Partner Logoları</h2>
      <p class="description" style="margin-bottom:12px">Sağ üstte gösterilecek logolar. İstediğin kadar ekleyebilirsin.</p>
      <table class="wp-list-table widefat fixed" id="oyk-partner-table">
        <thead>
          <tr>
            <th style="width:120px">Görsel</th>
            <th style="width:35%">Link</th>
            <th>Alt Metin</th>
            <th style="width:70px"></th>
            <th style="width:50px"></th>
          </tr>
        </thead>
        <tbody id="oyk-partner-rows">
          <?php foreach ( $partner_logolar as $i => $logo ) : ?>
          <tr class="oyk-partner-row">
            <td>
              <?php $gorsel = $logo['gorsel'] ?? ''; ?>
              <img src="<?= esc_url( $gorsel ) ?>"
                   class="oyk-partner-gorsel-img"
                   style="max-height:60px;max-width:100px;display:<?= $gorsel ? 'block' : 'none' ?>;margin-bottom:4px">
              <input type="hidden"
                     name="partner[<?= $i ?>][gorsel]"
                     class="oyk-partner-gorsel-url"
                     value="<?= esc_attr( $gorsel ) ?>">
              <button type="button" class="button button-small oyk-partner-gorsel-sec">Seç</button>
              <button type="button"
                      class="button-link-delete oyk-partner-gorsel-kaldir"
                      style="font-size:11px;<?= $gorsel ? '' : 'display:none' ?>">Kaldır</button>
            </td>
            <td>
              <input type="url"
                     name="partner[<?= $i ?>][link]"
                     value="<?= esc_attr( $logo['link'] ?? '' ) ?>"
                     class="regular-text"
                     placeholder="https://...">
            </td>
            <td>
              <input type="text"
                     name="partner[<?= $i ?>][alt]"
                     value="<?= esc_attr( $logo['alt'] ?? '' ) ?>"
                     class="regular-text"
                     placeholder="Logo adı / açıklaması">
            </td>
            <td>
              <button type="button" class="button oyk-partner-up" title="Yukarı">↑</button>
              <button type="button" class="button oyk-partner-down" title="Aşağı">↓</button>
            </td>
            <td>
              <button type="button" class="button button-link-delete oyk-partner-remove">Sil</button>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <p><button type="button" class="button" id="oyk-add-partner">+ Logo Ekle</button></p>

      <!-- ── Takvim ───────────────────────────────────────────────── -->
      <h2 class="title">Takvim</h2>
      <table class="wp-list-table widefat fixed" id="oyk-takvim-table">
        <thead>
          <tr>
            <th style="width:40%">Başlık</th>
            <th style="width:22%">Başlangıç</th>
            <th style="width:22%">Bitiş</th>
            <th style="width:8%"></th>
            <th style="width:8%"></th>
          </tr>
        </thead>
        <tbody id="oyk-takvim-rows">
          <?php foreach ( $rows as $i => $row ) : ?>
          <tr class="oyk-row">
            <td>
              <input type="text"
                     name="takvim[<?= $i ?>][baslik]"
                     value="<?= esc_attr( $row['baslik'] ) ?>"
                     class="regular-text"
                     placeholder="Etkinlik adı"
                     required>
            </td>
            <td>
              <input type="date"
                     name="takvim[<?= $i ?>][baslangic]"
                     value="<?= esc_attr( $row['baslangic'] ) ?>"
                     required>
            </td>
            <td>
              <input type="date"
                     name="takvim[<?= $i ?>][bitis]"
                     value="<?= esc_attr( $row['bitis'] ) ?>"
                     required>
            </td>
            <td>
              <button type="button" class="button oyk-move-up" title="Yukarı taşı">↑</button>
              <button type="button" class="button oyk-move-down" title="Aşağı taşı">↓</button>
            </td>
            <td>
              <button type="button" class="button button-link-delete oyk-remove-row">Sil</button>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <p><button type="button" class="button" id="oyk-add-row">+ Satır Ekle</button></p>

      <?php submit_button( 'Kaydet' ); ?>
    </form>
  </div>

  <script>
  (function($) {

    /* ── Takvim repeater ── */
    var rowIndex = <?= count( $rows ) ?>;

    function reindexTakvim() {
      $('#oyk-takvim-rows .oyk-row').each(function(i) {
        $(this).find('input').each(function() {
          $(this).attr('name', $(this).attr('name').replace(/takvim\[\d+\]/, 'takvim[' + i + ']'));
        });
      });
      rowIndex = $('#oyk-takvim-rows .oyk-row').length;
    }

    $('#oyk-add-row').on('click', function() {
      var row = '<tr class="oyk-row">' +
        '<td><input type="text" name="takvim[' + rowIndex + '][baslik]" class="regular-text" placeholder="Etkinlik adı" required></td>' +
        '<td><input type="date" name="takvim[' + rowIndex + '][baslangic]" required></td>' +
        '<td><input type="date" name="takvim[' + rowIndex + '][bitis]" required></td>' +
        '<td>' +
          '<button type="button" class="button oyk-move-up" title="Yukarı taşı">↑</button>' +
          '<button type="button" class="button oyk-move-down" title="Aşağı taşı">↓</button>' +
        '</td>' +
        '<td><button type="button" class="button button-link-delete oyk-remove-row">Sil</button></td>' +
        '</tr>';
      $('#oyk-takvim-rows').append(row);
      rowIndex++;
    });

    $(document).on('click', '.oyk-remove-row', function() {
      $(this).closest('tr').remove(); reindexTakvim();
    });
    $(document).on('click', '.oyk-move-up', function() {
      var r = $(this).closest('tr'), p = r.prev('.oyk-row');
      if (p.length) { r.insertBefore(p); reindexTakvim(); }
    });
    $(document).on('click', '.oyk-move-down', function() {
      var r = $(this).closest('tr'), n = r.next('.oyk-row');
      if (n.length) { r.insertAfter(n); reindexTakvim(); }
    });

    /* ── Partner logoları repeater ── */
    var partnerIndex = <?= count( $partner_logolar ) ?>;

    function reindexPartner() {
      $('#oyk-partner-rows .oyk-partner-row').each(function(i) {
        $(this).find('input').each(function() {
          $(this).attr('name', $(this).attr('name').replace(/partner\[\d+\]/, 'partner[' + i + ']'));
        });
      });
      partnerIndex = $('#oyk-partner-rows .oyk-partner-row').length;
    }

    function newPartnerRow(i) {
      return '<tr class="oyk-partner-row">' +
        '<td>' +
          '<img src="" class="oyk-partner-gorsel-img" style="max-height:60px;max-width:100px;display:none;margin-bottom:4px">' +
          '<input type="hidden" name="partner[' + i + '][gorsel]" class="oyk-partner-gorsel-url" value="">' +
          '<button type="button" class="button button-small oyk-partner-gorsel-sec">Seç</button> ' +
          '<button type="button" class="button-link-delete oyk-partner-gorsel-kaldir" style="font-size:11px;display:none">Kaldır</button>' +
        '</td>' +
        '<td><input type="url" name="partner[' + i + '][link]" class="regular-text" placeholder="https://..."></td>' +
        '<td><input type="text" name="partner[' + i + '][alt]" class="regular-text" placeholder="Logo adı / açıklaması"></td>' +
        '<td>' +
          '<button type="button" class="button oyk-partner-up" title="Yukarı">↑</button>' +
          '<button type="button" class="button oyk-partner-down" title="Aşağı">↓</button>' +
        '</td>' +
        '<td><button type="button" class="button button-link-delete oyk-partner-remove">Sil</button></td>' +
        '</tr>';
    }

    $('#oyk-add-partner').on('click', function() {
      $('#oyk-partner-rows').append(newPartnerRow(partnerIndex));
      partnerIndex++;
    });

    $(document).on('click', '.oyk-partner-remove', function() {
      $(this).closest('tr').remove(); reindexPartner();
    });
    $(document).on('click', '.oyk-partner-up', function() {
      var r = $(this).closest('tr'), p = r.prev('.oyk-partner-row');
      if (p.length) { r.insertBefore(p); reindexPartner(); }
    });
    $(document).on('click', '.oyk-partner-down', function() {
      var r = $(this).closest('tr'), n = r.next('.oyk-partner-row');
      if (n.length) { r.insertAfter(n); reindexPartner(); }
    });

    /* Görsel seçici — her satır için ayrı wp.media frame */
    $(document).on('click', '.oyk-partner-gorsel-sec', function(e) {
      e.preventDefault();
      var row = $(this).closest('tr');
      var frame = wp.media({
        title: 'Logo Görseli Seç',
        button: { text: 'Bu görseli kullan' },
        multiple: false,
        library: { type: 'image' }
      });
      frame.on('select', function() {
        var att = frame.state().get('selection').first().toJSON();
        row.find('.oyk-partner-gorsel-url').val(att.url);
        row.find('.oyk-partner-gorsel-img').attr('src', att.url).show();
        row.find('.oyk-partner-gorsel-kaldir').show();
      });
      frame.open();
    });

    $(document).on('click', '.oyk-partner-gorsel-kaldir', function() {
      var row = $(this).closest('tr');
      row.find('.oyk-partner-gorsel-url').val('');
      row.find('.oyk-partner-gorsel-img').attr('src', '').hide();
      $(this).hide();
    });

    /* ── Amblem media uploader ── */
    var amblemFrame;
    $('#oyk-amblem-sec').on('click', function(e) {
      e.preventDefault();
      if (amblemFrame) { amblemFrame.open(); return; }
      amblemFrame = wp.media({
        title: 'Amblem Seç',
        button: { text: 'Bu amblemi kullan' },
        multiple: false,
        library: { type: 'image' }
      });
      amblemFrame.on('select', function() {
        var att = amblemFrame.state().get('selection').first().toJSON();
        $('#oyk-amblem-url').val(att.url);
        $('#oyk-amblem-img').attr('src', att.url).show();
        $('#oyk-amblem-kaldir').show();
      });
      amblemFrame.open();
    });
    $('#oyk-amblem-kaldir').on('click', function() {
      $('#oyk-amblem-url').val('');
      $('#oyk-amblem-img').attr('src', '').hide();
      $(this).hide();
    });

    /* ── Site logosu media uploader ── */
    var mainLogoFrame;
    $('#oyk-logo-sec').on('click', function(e) {
      e.preventDefault();
      if (mainLogoFrame) { mainLogoFrame.open(); return; }
      mainLogoFrame = wp.media({
        title: 'Logo Seç',
        button: { text: 'Bu logoyu kullan' },
        multiple: false,
        library: { type: 'image' }
      });
      mainLogoFrame.on('select', function() {
        var att = mainLogoFrame.state().get('selection').first().toJSON();
        $('#oyk-logo-url').val(att.url);
        $('#oyk-logo-img').attr('src', att.url).show();
        $('#oyk-logo-kaldir').show();
      });
      mainLogoFrame.open();
    });

    $('#oyk-logo-kaldir').on('click', function() {
      $('#oyk-logo-url').val('');
      $('#oyk-logo-img').attr('src', '').hide();
      $(this).hide();
    });

  })(jQuery);
  </script>
  <?php
}

/* --------------------------------------------------------------------------
 * Form kaydetme
 * -------------------------------------------------------------------------- */
function oyk_tema_save() {
  if ( ! current_user_can( 'edit_theme_options' ) ) {
    wp_die( 'Yetkiniz yok.' );
  }

  check_admin_referer( 'oyk_tema_save', 'oyk_tema_nonce' );

  // Renk teması
  $tema_stili = ( isset( $_POST['tema_stili'] ) && $_POST['tema_stili'] === 'yaz' ) ? 'yaz' : 'kis';
  update_option( 'oyk_tema_stili', $tema_stili );

  // Site logosu
  $logo_url = isset( $_POST['logo_url'] ) ? esc_url_raw( $_POST['logo_url'] ) : '';
  update_option( 'oyk_logo_url', $logo_url );

  // Amblem
  $amblem_url = isset( $_POST['amblem_url'] ) ? esc_url_raw( $_POST['amblem_url'] ) : '';
  update_option( 'oyk_amblem_url', $amblem_url );

  // Partner logoları
  $raw_partner = isset( $_POST['partner'] ) ? (array) $_POST['partner'] : array();
  $partners    = array();
  foreach ( $raw_partner as $item ) {
    $gorsel = esc_url_raw( $item['gorsel'] ?? '' );
    $link   = esc_url_raw( $item['link']   ?? '' );
    $alt    = sanitize_text_field( $item['alt'] ?? '' );
    if ( $gorsel === '' && $link === '' ) continue;
    $partners[] = array( 'gorsel' => $gorsel, 'link' => $link, 'alt' => $alt );
  }
  update_option( 'oyk_partner_logolar', $partners );

  // Takvim
  $raw  = isset( $_POST['takvim'] ) ? (array) $_POST['takvim'] : array();
  $data = array();
  foreach ( $raw as $row ) {
    $baslik    = sanitize_text_field( $row['baslik']    ?? '' );
    $baslangic = sanitize_text_field( $row['baslangic'] ?? '' );
    $bitis     = sanitize_text_field( $row['bitis']     ?? '' );
    if ( $baslik === '' || $baslangic === '' || $bitis === '' ) continue;
    $data[] = array( 'baslik' => $baslik, 'baslangic' => $baslangic, 'bitis' => $bitis );
  }
  update_option( 'oyk_takvim', $data );

  wp_redirect( add_query_arg( 'oyk_saved', '1', wp_get_referer() ) );
  exit;
}
add_action( 'admin_post_oyk_tema_save', 'oyk_tema_save' );
