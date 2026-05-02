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

  $rows       = get_option( 'oyk_takvim', array() );
  $tema_stili = get_option( 'oyk_tema_stili', 'kis' );
  $logo_url   = get_option( 'oyk_logo_url', '' );
  $notice     = '';

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

      <!-- ── Logo ────────────────────────────────────────────────── -->
      <h2 class="title">Site Logosu</h2>
      <table class="form-table" role="presentation">
        <tr>
          <th scope="row">Logo</th>
          <td>
            <div id="oyk-logo-preview" style="margin-bottom:8px">
              <?php if ( $logo_url ) : ?>
                <img src="<?= esc_url( $logo_url ) ?>" style="max-height:80px;display:block;margin-bottom:6px" id="oyk-logo-img">
              <?php else : ?>
                <img src="" style="max-height:80px;display:none;margin-bottom:6px" id="oyk-logo-img">
              <?php endif; ?>
            </div>
            <input type="hidden" name="logo_url" id="oyk-logo-url" value="<?= esc_attr( $logo_url ) ?>">
            <button type="button" class="button" id="oyk-logo-sec">Logo Seç / Yükle</button>
            <?php if ( $logo_url ) : ?>
              <button type="button" class="button button-link-delete" id="oyk-logo-kaldir">Logoyu Kaldır</button>
            <?php else : ?>
              <button type="button" class="button button-link-delete" id="oyk-logo-kaldir" style="display:none">Logoyu Kaldır</button>
            <?php endif; ?>
            <p class="description">PNG veya SVG önerilir. Header'da gösterilecektir.</p>
          </td>
        </tr>
      </table>

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

    function reindex() {
      $('#oyk-takvim-rows .oyk-row').each(function(i) {
        $(this).find('input').each(function() {
          var name = $(this).attr('name').replace(/takvim\[\d+\]/, 'takvim[' + i + ']');
          $(this).attr('name', name);
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
      $(this).closest('tr').remove();
      reindex();
    });

    $(document).on('click', '.oyk-move-up', function() {
      var row = $(this).closest('tr');
      var prev = row.prev('.oyk-row');
      if (prev.length) { row.insertBefore(prev); reindex(); }
    });

    $(document).on('click', '.oyk-move-down', function() {
      var row = $(this).closest('tr');
      var next = row.next('.oyk-row');
      if (next.length) { row.insertAfter(next); reindex(); }
    });

    /* ── Logo media uploader ── */
    var mediaFrame;

    $('#oyk-logo-sec').on('click', function(e) {
      e.preventDefault();
      if (mediaFrame) { mediaFrame.open(); return; }
      mediaFrame = wp.media({
        title: 'Logo Seç',
        button: { text: 'Bu logoyu kullan' },
        multiple: false,
        library: { type: 'image' }
      });
      mediaFrame.on('select', function() {
        var attachment = mediaFrame.state().get('selection').first().toJSON();
        $('#oyk-logo-url').val(attachment.url);
        $('#oyk-logo-img').attr('src', attachment.url).show();
        $('#oyk-logo-kaldir').show();
      });
      mediaFrame.open();
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

  // Logo
  $logo_url = isset( $_POST['logo_url'] ) ? esc_url_raw( $_POST['logo_url'] ) : '';
  update_option( 'oyk_logo_url', $logo_url );

  // Takvim
  $raw  = isset( $_POST['takvim'] ) ? (array) $_POST['takvim'] : array();
  $data = array();
  foreach ( $raw as $row ) {
    $baslik    = sanitize_text_field( $row['baslik'] ?? '' );
    $baslangic = sanitize_text_field( $row['baslangic'] ?? '' );
    $bitis     = sanitize_text_field( $row['bitis'] ?? '' );
    if ( $baslik === '' || $baslangic === '' || $bitis === '' ) continue;
    $data[] = array( 'baslik' => $baslik, 'baslangic' => $baslangic, 'bitis' => $bitis );
  }
  update_option( 'oyk_takvim', $data );

  wp_redirect( add_query_arg( 'oyk_saved', '1', wp_get_referer() ) );
  exit;
}
add_action( 'admin_post_oyk_tema_save', 'oyk_tema_save' );
