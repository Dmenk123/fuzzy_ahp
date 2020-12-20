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
      </div>

      <div class="kt-portlet__body" id="vektor_area">
        <h4>Tabel Vektor</h4>
        <div class="col-lg-12 row table-responsive"> 
          <table class="table table-bordered table-hover">
            <thead>
              <tr align="center">
                <th valign="top"></th>
                <?php foreach ($data_kat as $k => $v) {
                  echo "<th>";
                  echo "<div class='col-12'>$v->nama</div>";
                  echo "<div class='col-12'>$v->kode_kategori</div>";
                  echo "</th>";
                } ?>
              </tr>
            </thead>
            <tbody>
              <?php 
                $idx = 0; 
                $counter_kolom = 0;
                $total_min = 0;
              ?>
              
              <?php foreach ($data_kat as $kk => $vv) {
                echo '<tr style="text-align:center;">';
                ## counter untuk colspan
                $counter_kolom = 0; 
                foreach ($data as $key => $val) {
                  if($val->kode_kategori == $vv->kode_kategori) {
                    if($idx == 0){
                      echo '<th>'.$val->kode_kategori.'</th>';
                    }

                    if($val->kode_kategori_tujuan == $vv->kode_kategori){
                      echo '<td style="color:red;">'.$val->nilai.'</td>';
                    }else{
                      echo '<td>'.$val->nilai.'</td>';
                    }

                    if($val->kode_kategori_tujuan == 'C1') {
                      $total_min += (float)$val->nilai;
                    }
                    
                    ## increment biar ga kenek kondisi
                    $idx++;
                    $counter_kolom++;
                    continue;
                  }
                  ## reset
                  $idx = 0;
                }

                echo '</tr>';

              } ?>
            </tbody>
          </table>    
        </div>
      </div>
      
      <div class="kt-portlet__body" id="sintesis_area">
        <h4>Tabel Defuzzifikasi</h4>
        <div class="col-lg-12 row table-responsive"> 
          <table class="table table-bordered table-hover">
            <thead>
              <tr align="center">
                <th></th>
                <th>DEFUZZIFIKASI</th>
                <th>W=NORMALISASI</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $kkk => $vvv) { 
                if($vvv->kode_kategori_tujuan == 'C1') {
                  echo "<tr>";
                    if($kkk == 0) {
                      echo "<th rowspan='".$counter_kolom."'>MIN</th>";
                    }

                    echo "<td>$vvv->nilai</td>";
                    echo "<td>".number_format((float)$vvv->nilai/(float)$total_min, 4)."</td>";
                  echo "</tr>";
                }
                
              } ?>
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



