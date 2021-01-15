<?php
$obj_date = new DateTime();
$data_kat = $this->db->from('m_kategori')->where(['deleted_at' => null])->order_by('urut', 'ASC')->get()->result();


// echo "<pre>";
// print_r ($data_kat);
// echo "</pre>";

// echo "<pre>";
// print_r ($data);
// echo "</pre>";
// exit;
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
                  <a class="dropdown-item" target="_blank" href="<?= base_url().$this->uri->segment(1).'/download_excel_anggaran/'.$this->uri->segment(3);?>">
                    <i class="la la-arrow-circle-o-down"></i> Excel Anggaran
                  </a>
                  <a class="dropdown-item" target="_blank" href="<?= base_url().$this->uri->segment(1).'/cetak_data_anggaran/'.$this->uri->segment(3);?>">
                    <i class="la la-print"></i> Cetak Anggaran
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="kt-portlet__body" id="vektor_area">
        <div class="col-lg-12 row table-responsive">
          <?php 
            $no = 1; 
            $jumlah_kolom = (count($data) / 2);
            $grand_total_thn = 0;
          ?>
          <h5>Tabel Perhitungan Anggaran</h5>
          <hr>
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style="text-align:center;">#</th>
                <th style="text-align:center;">Tahun</th>
                <?php 
                  for ($i=0; $i < $jumlah_kolom; $i++) { 
                    echo '<th style="text-align:center;">'.$data[$i]->kode_kategori.'</th>';
                  }
                ?>
                <th style="text-align:center;">Total</th>
              </tr>
            </thead>
            <tbody>
            <?php $flag_tahun = $tahun; ?>
            <?php $is_kolom_akhir = false; ?>
              <tr>
                <th scope="row"><?='A'.$no++;?></th>
                <td width="10%"><?=$tahun;?></td>
                <?php foreach ($data as $kk => $vv) { ?>
                  <?php if($flag_tahun == $vv->tahun) { ?>     
                    <?php
                      
                      ### cek apakah kolom terakhir. untuk kolom grand total
                      if($kk == (count($data)-1)){
                        $is_kolom_akhir = true;
                      }else{
                        ## jika tahun loop == tahun+1 loop
                        if($vv->tahun == $data[$kk+1]->tahun){
                          $is_kolom_akhir = false;
                        }else{
                          $is_kolom_akhir = true;
                        }
                      }

                    ?>

                    <?php $grand_total_thn += $vv->total; ?>     
                    <td width="15%">
                      <span class="pull-right"><?=number_format((float)$vv->total, 2,',','.');?></span>
                    </td>
                    
                    <?php if($is_kolom_akhir == true) { ?>
                      <td width="25%">
                        <span class="pull-right"><strong><?=number_format((float)$grand_total_thn, 2,',','.');?></strong></span>
                      </td>
                    <?php } ?>

                    <?php }else{ ?>
                      <?php $flag_tahun = $vv->tahun; ?>
                      <?php $grand_total_thn = 0; ?>
                      </tr>
                      <tr>
                        <th scope="row"><?='A'.$no++;?></th>
                        <td width="10%"><?=$vv->tahun;?></td>
                        <td width="15%">
                          <span class="pull-right"><?=number_format((float)$vv->total, 2,',','.');?></span>
                        </td>
                  <?php } ?>
                <?php } ?> 
              </tr>
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



