<?php
$obj_date = new DateTime();
$data_kat = $this->db->from('m_kategori')->where(['deleted_at' => null])->order_by('urut', 'ASC')->get()->result();
?>
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $this->template_view->nama('judul'); ?>
        </h3>
      </div>
    </div>
  </div>
  <!-- end:: Content Head -->

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
          <h3 class="kt-portlet__head-title">
            <?= $title; ?>
          </h3>
        </div>

        <div class="kt-portlet__head-toolbar">
          <div class="kt-portlet__head-wrapper">
            <div class="kt-portlet__head-actions">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Download / Cetak</button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" target="_blank" href="<?= base_url().$this->uri->segment(1).'/download_excel_hasil_rangking/'.$this->uri->segment(3);?>">
                    <i class="la la-arrow-circle-o-down"></i> Excel Hasil Rangking
                  </a>
                 
                  <a class="dropdown-item" target="_blank" href="<?= base_url().$this->uri->segment(1).'/cetak_hasil_rangking/'.$this->uri->segment(3);?>">
                    <i class="la la-print"></i> Hasil Rangking
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="kt-portlet__body" id="anggaran_area">
        <div class="col-lg-12 row table-responsive">
          <?php 
            $no = 1; 
            $jumlah_kolom = (count($data_bobot) / 2);
            $grand_total_thn = 0;
          ?>
          <h5>Tabel Normalisasi</h5>
          <hr>
          <table class="table table-bordered table-hover">
            <thead>
              <?php 
                $arr_kode = [];
                $kode_bobot = '';
                echo '<th>#</th>'; 
                ## hapus duplicate array
                foreach ($data_bobot as $kk => $vv) {
                  $arr_kode[] = $vv->kode;
                }
                $arr_kode = array_unique($arr_kode);
                ## end hapus duplicate array

                foreach ($arr_kode as $key => $value) {  
                    echo '<th >'.$value.'</th>';
                } ?>
            </thead>
            <tbody>
              <?php $flag_tahun = $tahun; ?>
              <?php $arr_total = []; ?>
              <?php for ($i=0; $i < count($hasil_bobot)-1; $i++) { ?> 
                <tr>
                  <td scope="row"><?=$no++;?></td>
                  <?php for ($z=0; $z < count($hasil_bobot[$i]); $z++) { ?>
                    <?php $arr_total[$i][$z] = (float)$hasil_bobot[$i][$z] / $hasil_bobot[count($hasil_bobot)-1][$z]; ?>
                    <td align="right"><?=number_format((float)$hasil_bobot[$i][$z] / $hasil_bobot[count($hasil_bobot)-1][$z], 4,',','.');?></td>
                  <?php } ?>  
                </tr>
              <?php } ?>
              <!-- baris total  -->
              <tr>
                <?php
                  $final_total_array = [];
                  
                  foreach ($arr_total as $kkk => $vvv) {
                    foreach ($vvv as $id => $value) {
                      //$final_total_array[$id] += $value;
                      array_key_exists( $id, $final_total_array ) ? $final_total_array[$id] += $value : $final_total_array[$id] = $value;
                    }
                  }

                  echo '<td>Jumlah</td>';
                  foreach ($final_total_array as $kkkk => $vvvv) {
                    echo '<td align="right">'.number_format((float)$vvvv, 4,',','.').'</td>';
                  }
                ?>
                
              </tr>
            </tbody>
          </table> 
         
        </div>
      </div>

      <div class="kt-portlet__body" id="proses_bobot_area">
        <div class="col-lg-12 row table-responsive">
          <h5>Proses Perhitungan Rangking</h5>
          <hr>
          <table class="table table-bordered table-hover">
            <thead>
              <?php 
                $kode_bobot = '';
                $no = 1;
                echo '<th>#</th>'; 
                foreach ($arr_kode as $key => $value) {  
                    echo '<th style="text-align:center">'.$value.'</th>';
                } ?>
            </thead>
            <tbody>
              <td scope="row">W</td>
              <?php foreach ($fuzzy as $k => $v) { ?>
                <td align="right"><?=number_format((float)$v, 4,',','.');?></td>
              <?php } ?>

              <?php for ($i=0; $i < count($hasil_bobot)-1; $i++) { ?> 
                <tr>
                  <td scope="row"><?='A'.$no++;?></td>
                  <?php for ($z=0; $z < count($hasil_bobot[$i]); $z++) { ?>
                    <td align="right"><?=number_format((float)$hasil_bobot[$i][$z] / $hasil_bobot[count($hasil_bobot)-1][$z], 4,',','.');?></td>
                  <?php } ?>  
                </tr>
              <?php } ?>
            </tbody>
          </table> 
        </div>
      </div>

      <div class="kt-portlet__body" id="hasil_rangking">
        <div class="col-lg-12 row table-responsive">
        <?php 
            $no = 1; 
            $grand_total_thn = 0;
          ?>
          <h5>Hasil Rangking</h5>
          <hr>
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">TOTAL SKOR</th>
                <th style="text-align: center;">RANGKING</th>
              </tr>
            </thead>
            <tbody>
              
              <?php for ($i=0; $i < count($hasil_bobot)-1; $i++) {  
                // assign array rangking untuk di sorting
                $skor_raw = 0;
               
                for ($z=0; $z < count($hasil_bobot[$i]); $z++) {
                  $skor_raw += (((float)$hasil_bobot[$i][$z] / $hasil_bobot[count($hasil_bobot)-1][$z]) * $fuzzy[$z]);
                }

                $arr_skor[] = $skor_raw;
              } 
              
              //sorting
              asort($arr_skor);
              // buat array, pakai value sebagai key untuk mencari rangking
              $nomor = 1;
              foreach ($arr_skor as $key => $value) {
                $arr_rangking[number_format((float)$value, 4,',','.')] = $nomor++;
              }
              
              ?>
              
              <?php for ($i=0; $i < count($hasil_bobot)-1; $i++) { ?> 
                <?php $skor = 0; ?>
                <tr>
                  <td scope="row" align="center"><?='A'.$no++;?></td>
                  <td align="center">

                    <?php for ($z=0; $z < count($hasil_bobot[$i]); $z++) { ?>
                      <?php $skor += (((float)$hasil_bobot[$i][$z] / $hasil_bobot[count($hasil_bobot)-1][$z]) * $fuzzy[$z]); ?>
                    <?php } ?>
                    
                    <?=number_format((float)$skor, 4,',','.');?>
                  </td>
                  <td align="center"><strong><?= $arr_rangking[number_format((float)$skor, 4,',','.')]; ?></strong></td>
                </tr>
              <?php } ?>
            </tbody>
          </table> 
        </div>
      </div>
  
    </div>  

    <div class="col-12">
      <a href="<?=base_url('data_hitung');?>" class="btn btn-bold btn-label-brand btn-sm"><i class="la la-arrow-left"></i>Kembali Ke Menu Utama</a>
    </div>
  </div>
</div>



