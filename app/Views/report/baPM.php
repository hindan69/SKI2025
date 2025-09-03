<?= $this->extend('layout/index'); ?>
<?= $this->section('page_content'); ?>

<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/mn6j4svi1abtvt3xxtgbu9qtcak96j93929j2l70hp9u7ue7/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>
<textarea>

    <div style="margin-left: 20pt;margin-right:20pt; margin-bottom:30pt; font-family: arial, helvetica, sans-serif;">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>/
            <p style="text-align: center;line-height: 110%;"><b>PERNYATAAN TANGGUNG JAWAB<br>
                    HASIL PENILAIAN MANDIRI (PM) EFEKTIVITAS EVALUASI SPI/SKI<br>
                    <?= $satkerx->satker; ?><br>
                    Tahun <?= $ta; ?></b></p>
            <br>
            <p style="text-align: justify;text-indent: 8%;">Bersama ini kami menyatakan bahwa kami telah melakukan Penilaian Mandiri (PM) Efektivitas Evaluasi peran SPI/SKI <b><?= $satkerx->satker; ?></b> Tahun
                    <b><?= $ta; ?></b>.
                Dengan Skor hasil Penilaian Mandiri Efektifitas <b>  <?php foreach ($nilai_pm as $a) : ?>
                                    <?php
                                                                            $J = $a->nilai_pm;
                                                                            if (empty($J)) {
                                                                                echo '0.0';
                                                                            } else {
                                                                                echo $J;
                                                                            }
                                    ?>
                                    <?php endforeach; ?>%</b>
                <?php foreach ($simpulan as $a) : ?>
                    <?php
                    $J = $a->nilai;
                    if (empty($J)) {
                        echo 'karena belum melakukan penilaian.';
                    } elseif ($J <= 20) {
                        echo 'kriteria <b>Tidak Efektif</b>.';
                    } elseif ($J >= 20.01 && $J <= 40) {
                        echo 'kriteria <b>Kurang Efektif</b>.';
                    } elseif ($J >= 40.01 && $J <= 60) {
                        echo 'kriteria <b>Cukup Efektif</b>.';
                    } elseif ($J >= 60.01 && $J <= 80) {
                        echo 'kriteria <b>Efektif</b>.';
                    } elseif ($J >= 80.01 && $J <= 100) {
                        echo 'kriteria <b>Sangat Efektif.</b>';
                    } else {
                        echo 'Wadaw';
                    }
                    ?>
                <?php endforeach; ?>
            </p>
            <p style="text-align: justify;text-indent: 8%;">Dengan rincian hasil penilaian mandiri sebagai berikut:</p>
            <table style="font-size: 10px; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="1" width="750px">
                <tbody>
                    <tr style="background-color: gray;text-align:center;">
                        <th style="border-width: 1px; border-color: initial;">No</th>
                        <th style="border-width: 1px; border-color: initial;">FAKTOR PENILAIAN</th>
                        <th style="border-width: 1px; border-color: initial;">BOBOT</th>
                        <th style="border-width: 1px; border-color: initial;">SKOR</th>
                        <th style="border-width: 1px; border-color: initial;">NILAI RATA-RATA</th>
                    </tr>
                    <tr style="background-color: lightgray;text-align:center;">
                        <td style="border-width: 1px; border-color: initial;"><b>A</b></td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;"><b>KOMPONEN PENGUNGKIT</b></td>
                        <td style="border-width: 1px; border-color: initial;"><b>
                                <?php foreach ($Ax as $a) : ?>
                                    <?php
                                    $J = $a->bobot;
                                    if (empty($J)) {
                                        echo '30.0';
                                    } else {
                                        echo $J;
                                    }
                                    ?>
                                <?php endforeach; ?></b>
                        </td>
                        <td style="border-width: 1px; border-color: initial;"><b>
                                <?php foreach ($Bx as $a) : ?>
                                    <?php
                                    $J = $a->skor;
                                    if (empty($J)) {
                                        echo '30.0';
                                    } else {
                                        echo $J;
                                    }
                                    ?>
                                <?php endforeach; ?></b>
                        </td>
                        <td style="border-width: 1px; border-color: initial;"><b>
                                <?php foreach ($Cx as $a) : ?>
                                    <?php
                                    $J = $a->nilai;
                                    if (empty($J)) {
                                        echo '0.0';
                                    } else {
                                        echo $J;
                                    }
                                    ?>
                                    <?php endforeach; ?>%</b>
                        </td>
                    </tr>
                    <tr style="background-color:bisque; text-align:center;">
                        <td style="border-width: 1px; border-color: initial;">1</td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Dukungan Sumber Daya Manusia, Akses Data & Informasi, serta Komunikasi</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A11 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '15.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B11 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '15.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C11 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <tr style="background-color:linen; text-align:center;">
                        <td style="border-width: 1px; border-color: initial;"></td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Dukungan Sumber Daya Manusia</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A1 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '5.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B1 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C1 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <tr style="background-color:linen; text-align:center;">
                        <td style="border-width: 1px; border-color: initial;"></td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Akses Data & Informasi</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A2 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '5.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B2 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C2 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <tr style="background-color:linen; text-align:center;">
                        <td style="border-width: 1px; border-color: initial;"></td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Komunikasi</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A3 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '5.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B3 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C3 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <tr style="background-color:bisque; text-align:center;">
                        <td style="border-width: 1px; border-color: initial;">2</td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Pemantauan dan Evaluasi Tata Kelola Organisasi</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A12 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '20.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B12 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '20.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C12 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <tr style="background-color:linen;text-align:center;">
                        <td style="border-width: 1px; border-color: initial;"></td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Pengelolaan Keuangan</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A4 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '5.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B4 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C4 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <tr style="background-color:linen; text-align:center;">
                        <td style="border-width: 1px; border-color: initial;"></td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Kinerja</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A5 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '5.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B5 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C5 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <tr style="background-color:linen; text-align:center;">
                        <td style="border-width: 1px; border-color: initial;"></td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Kedisiplinan Pegawai</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A6 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '5.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B6 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C6 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <tr style="background-color:linen; text-align:center;">
                        <td style="border-width: 1px; border-color: initial;"></td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Reformasi Birokrasi/WBK/WBBM</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A7 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '5.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B7 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C7 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <tr style="background-color:bisque; text-align:center;">
                        <td style="border-width: 1px; border-color: initial;">3</td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Pemantauan dan Evaluasi Manajemen Risiko</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A13 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '17.5';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B13 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '17.5';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C13 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <tr style="background-color:bisque; text-align:center;">
                        <td style="border-width: 1px; border-color: initial;">4</td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Pemantauan dan Evaluasi Pengendalian Intern</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A14 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '17.5';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B14 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '17.5';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C14 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <tr style="background-color: lightgray;text-align:center;">
                        <td style="border-width: 1px; border-color: initial;"><b>B</b></td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;"><b>KOMPONEN HASIL</b></td>
                        <td style="border-width: 1px; border-color: initial;"><b>
                                <?php foreach ($Ay as $a) : ?>
                                    <?php
                                    $J = $a->bobot;
                                    if (empty($J)) {
                                        echo '30.0';
                                    } else {
                                        echo $J;
                                    }
                                    ?>
                                <?php endforeach; ?></b>
                        </td>
                        <td style="border-width: 1px; border-color: initial;"><b>
                                <?php foreach ($By as $a) : ?>
                                    <?php
                                    $J = $a->skor;
                                    if (empty($J)) {
                                        echo '30.0';
                                    } else {
                                        echo $J;
                                    }
                                    ?>
                                <?php endforeach; ?></b>
                        </td>
                        <td style="border-width: 1px; border-color: initial;"><b>
                                <?php foreach ($Cy as $a) : ?>
                                    <?php
                                    $J = $a->nilai;
                                    if (empty($J)) {
                                        echo '0.0';
                                    } else {
                                        echo $J;
                                    }
                                    ?>
                                    <?php endforeach; ?>%</b>
                        </td>
                    </tr>
                    <tr style="background-color:bisque; text-align:center;">
                        <td style="border-width: 1px; border-color: initial;">1</td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Akuntabilitas Keuangan</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A15 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '6.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B15 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '6.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C15 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <tr style="background-color:bisque; text-align:center;">
                        <td style="border-width: 1px; border-color: initial;">2</td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Akuntabilitas Kinerja</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A16 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '6.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B16 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '6.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C16 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <tr style="background-color:bisque; text-align:center;">
                        <td style="border-width: 1px; border-color: initial;">3</td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Reformasi Birokrasi/WBK/WBBM</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A17 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '6.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B17 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '6.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C17 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <tr style="background-color:bisque; text-align:center;">
                        <td style="border-width: 1px; border-color: initial;">4</td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Kepatuhan terhadap perundang-undangan</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A18 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '6.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B18 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '6.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C18 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <tr style="background-color:bisque; text-align:center;">
                        <td style="border-width: 1px; border-color: initial;">5</td>
                        <td style="border-width: 1px; border-color: initial;text-align:left;">Kepuasan Pelanggan</td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($A18 as $a) : ?>
                                <?php
                                $J = $a->bobot;
                                if (empty($J)) {
                                    echo '6.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($B18 as $a) : ?>
                                <?php
                                $J = $a->skor;
                                if (empty($J)) {
                                    echo '6.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                            <?php endforeach; ?>
                        </td>
                        <td style="border-width: 1px; border-color: initial;">
                            <?php foreach ($C18 as $a) : ?>
                                <?php
                                $J = $a->nilai;
                                if (empty($J)) {
                                    echo '0.0';
                                } else {
                                    echo $J;
                                }
                                ?>
                                <?php endforeach; ?>%
                        </td>
                    </tr>
                    <p>&nbsp;</p>
                    <tr style="background-color: gray;text-align:center;">
                        <td style="border-width: 1px; border-color: initial;text-align:left;" colspan="4"><b>RATA-RATA SKOR KOMPONEN PENGUNGKIT</b></td>
                        <td style="border-width: 1px; border-color: initial;"><b>
                                <?php foreach ($Cx as $a) : ?>
                                    <?php
                                    $J = $a->nilai;
                                    if (empty($J)) {
                                        echo '0.0';
                                    } else {
                                        echo $J;
                                    }
                                    ?>
                                    <?php endforeach; ?>%
                            </b></td>
                    </tr>
                    <tr style="background-color: gray;text-align:center;">
                        <td style="border-width: 1px; border-color: initial;text-align:left;" colspan="4"><b>RATA-RATA SKOR KOMPONEN HASIL</b></td>
                        <td style="border-width: 1px; border-color: initial;"><b>
                                <?php foreach ($Cy as $a) : ?>
                                    <?php
                                    $J = $a->nilai;
                                    if (empty($J)) {
                                        echo '0.0';
                                    } else {
                                        echo $J;
                                    }
                                    ?>
                                    <?php endforeach; ?>%
                            </b></td>
                    </tr>
                    <tr style="background-color: gray;text-align:center;">
                        <td style="border-width: 1px; border-color: initial;text-align:left;" colspan="4"><b>TOTAL SKOR</b></td>
                        <td style="border-width: 1px; border-color: initial;"><b>
                                <?php foreach ($nilai_pm as $a) : ?>
                                    <?php
                                    $J = $a->nilai_pm;
                                    if (empty($J)) {
                                        echo '0.0';
                                    } else {
                                        echo $J;
                                    }
                                    ?>
                                    <?php endforeach; ?>%
                            </b></td>
                    </tr>
                    <tr style="background-color: gray;text-align:center;">
                        <td style="border-width: 1px; border-color: initial;text-align:left;" colspan="4"><b>KESIMPULAN</b></td>
                        <td style="border-width: 1px; border-color: initial;"><b>
                                <?php foreach ($simpulan as $a) : ?>
                                    <?php
                                    $J = $a->nilai;
                                    if (empty($J)) {
                                        echo '-';
                                    } elseif ($J <= 20) {
                                        echo 'Tidak Efektif';
                                    } elseif ($J >= 20.01 && $J <= 40) {
                                        echo 'Kurang Efektif';
                                    } elseif ($J >= 40.01 && $J <= 60) {
                                        echo 'Cukup Efektif';
                                    } elseif ($J >= 60.01 && $J <= 80) {
                                        echo 'Efektif';
                                    } elseif ($J >= 80.01 && $J <= 100) {
                                        echo 'Sangat Efektif';
                                    } else {
                                        echo 'Wadaw';
                                    }
                                    ?>
                                <?php endforeach; ?>
                            </b></td>
                    </tr>
                </tbody>
            </table>
            <p style="text-align: justify;text-indent: 8%;">Kami telah membangun infrastruktur dan mengimplementasikan setiap komponen pengungkit dan hasil secara berkelanjutan selaras dengan Permenkes No. 84 Tahun 2019 sehingga terwujud peran SPI/SKI yang efektif.</p>
            <p><span style="font-size: 11pt; font-family: arial, helvetica, sans-serif;"><!-- pagebreak --></span></p>
            <p style="text-align: justify;text-indent: 8%;">Dalam upaya meningkatkan efektivitas peran SPI/SKI <b><?= $satkerx->satker; ?></b>, kami berkomitmen untuk terus menerus melaksanakan dan menginternalisasi dengan baik seluruh infrastruktur yang didukung dengan evidence pemenuhan skor efektivitas peran SPI/SKI secara berkesinambungan dalam rangka bertanggungjawab memastikan penerapan Tata Kelola Organisasi, Manajemen Risiko dan Pengendalian di <b><?= $satkerx->satker; ?></b> berjalan dengan baik. Atas hasil penilaian mandiri yang sudah kami lakukan, kami memohon kepada Inspektorat Jenderal untuk melakukan penjaminan kualitas hasil penilaian mandiri efektivitas peran SPI/SKI <b><?= $satkerx->satker; ?></b>.
                Demikian pernyataan ini dibuat, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
            <div class="row" style="margin-left: 450px;">
                <div class="col-6"><span style="font-size: 11pt; font-family: arial, helvetica, sans-serif;"><?php foreach ($umum as $j) : ?>
                            <?= $j->kota_satker; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($tanggal as $j) : ?>
                                <?=
                                date('d F Y', strtotime($j->created_at));
                                ?>
                            <?php endforeach; ?>
                    </span></div>
                <div class="col-6"><span style="font-size: 11pt; font-family: arial, helvetica, sans-serif;"><?php foreach ($umum as $j) : ?>
                            <?= $j->nama_jabatan; ?>
                        <?php endforeach; ?></span></div>
                <br><br><br><br><br>
                <div class="col-6"><span style="font-size: 11pt; font-family: arial, helvetica, sans-serif;"><strong><?php foreach ($umum as $j) : ?>
                                <?= $j->nama_pimpinan; ?>
                            <?php endforeach; ?></strong></span></div>
                <div class="col-6"><span style="font-size: 11pt; font-family: arial, helvetica, sans-serif;">(NIP.<?php foreach ($umum as $j) : ?>
                        <?= $j->nip_pimpinan; ?>
                        <?php endforeach; ?>)</span></div>
            </div>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
    </div>

</textarea>

<?= $this->endSection(); ?>