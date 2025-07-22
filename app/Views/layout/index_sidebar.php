<li class="menu-item active">
    <a href="<?= base_url('/') ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Beranda</div>
    </a>
</li>

<!-- Layouts -->
<li class="menu-item">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-collection"></i>
        <div data-i18n="Basic">Penugasan</div>
    </a>

    <ul class="menu-sub">
        <li class="menu-item">
            <a href="javascript:void(0);" onclick="detailPK()" class="menu-link">
                <div data-i18n="Without navbar">Penjamin Kualitas</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="layouts-container.html" class="menu-link">
                <div data-i18n="Container">Penilaian Leveling</div>
            </a>
        </li>
    </ul>
</li>
<li class="menu-item">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-copy"></i>
        <div data-i18n="Extended UI">SPI/SKI</div>
    </a>

    <ul class="menu-sub">
        <li class="menu-item">
            <a href="<?= base_url('/pm') ?>" class="menu-link">
                <div data-i18n="Without menu">Penilaian Mandiri</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="layouts-without-navbar.html" class="menu-link">
                <div data-i18n="Without navbar">Penjamin Kualitas</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="layouts-container.html" class="menu-link">
                <div data-i18n="Container">Penilaian Leveling</div>
            </a>
        </li>
    </ul>
</li>

<li class="menu-item">
    <a href="index.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div data-i18n="Analytics">Nilai Maturitas SPIP</div>
    </a>
</li>
<li class="menu-item">
    <?php
    $a = session()->get('role');
    $link = in_array($a, [3, 4]) ? '/pm' : (in_array($a, [10, 11]) ? '/pk' : (in_array($a, [12, 13]) ? '/lvl' : 'index.html'));
    ?>
    <a href="<?= $link; ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-detail"></i>
        <div data-i18n="Form Elements">Dashboard</div>
    </a>
</li>

<li class="menu-item">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-file"></i>
        <div data-i18n="Documentation">Laporan</div>
    </a>

    <ul class="menu-sub">
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
                <div data-i18n="Without menu">Berita Acara PM</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
                <div data-i18n="Without navbar">Laporan PK</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
                <div data-i18n="Container">Laporan Leveling</div>
            </a>
        </li>
    </ul>
</li>

<li class="menu-header small text-uppercase">
    <span class="menu-header-text">Petunjuk</span>
</li>
<li class="menu-item">
    <a href="index.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <div data-i18n="Analytics">Pedoman Penilaian SPI/SKI</div>
    </a>
</li>
<li class="menu-item">
    <a href="index.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <div data-i18n="Analytics">Petunjuk Penggunaan</div>
    </a>
</li>
<li class="menu-header small text-uppercase">
    <span class="menu-header-text">Pengaturan</span>
</li>
<li class="menu-item">
    <a href="index.html" class="menu-link">
        <i class="bx bx-cog me-2"></i>
        <div data-i18n="Analytics">Maintenance</div>
    </a>
</li>

<script>
    function detailPK() {
        // alert('detail pk')
        window.location.href = '<?= base_url('/riwayat') ?>'
    }
</script>