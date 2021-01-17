<html>

<head>
  <title><?php echo $title; ?></title>
  <style type="text/css">
    #outtable {
      padding: 10px;
      border: 1px solid #e3e3e3;
      width: 600px;
      border-radius: 5px;
    }

    .short {
      width: 50px;
    }

    .normal {
      width: 150px;
    }

    .tbl-outer {
      color: #070707;
    }

    .text-center {
      text-align: center;
    }

    .text-left {
      text-align: left;
    }

    .text-right {
      text-align: right;
    }

    .tebal {
      font-weight: bold;
    }

    .outer-left {
      border: 0px solid white;
      border-color: white;
      margin: 0px;
      background: white;
    }

    .head-left {
      padding-bottom: 0px;
      border: 0px solid white;
      border-color: white;
      margin: 0px;
      background: white;
    }

    .tbl-footer {
      width: 100%;
      color: #070707;
      border-top: 0px solid white;
      border-color: white;
      padding-top: 15px;
    }

    .head-right {
      padding-bottom: 0px;
      border: 0px solid white;
      border-color: white;
      margin: 0px;
    }

    .tbl-header {
      padding-top: 1px;
      width: 100%;
      color: #070707;
      border-color: #070707;
      border-top: 2px solid #070707;
    }

    #tbl_content {
      padding-top: 10px;
      margin-left: -15px;
    }

    .tbl-footer td {
      border-top: 0px;
      padding: 0px;
    }

    .tbl-footer tr {
      background: white;
    }

    .foot-center {
      padding-left: 70px;
    }

    .inner-head-left {
      padding-top: 20px;
      border: 0px solid white;
      border-color: white;
      margin: 0px;
      background: white;
    }

    .tbl-content-footer {
      width: 100%;
      color: #070707;
      padding-top: 0px;
    }

    table {
      border-collapse: collapse;
      font-family: arial;
      color: black;
      font-size: 12px;
    }

    thead th {
      text-align: center;
      font-style: bold;
    }

    .clear {
      clear: both;
    }

  </style>
</head>

<body>
  <div class="container">
    <table class="tbl-outer">
      <tr>
        
        <!-- <td align="left" class="outer-left">
          <img src="<?=base_url('files/img/app_img/').$data_klinik->gambar;?>" height="75" width="75">
        </td> -->

        <!-- <td align="right" class="outer-left" style="padding-top: 30px; padding-left:10px;">
          <p style="text-align: left; font-size: 14px" class="outer-left">
            <strong><?= $data_klinik->nama_klinik; ?></strong>
          </p>
          <p style="text-align: left; font-size: 12px" class="outer-left"><?= $data_klinik->alamat.' '.$data_klinik->kelurahan.' '.$data_klinik->kecamatan; ?></p>
          <p style="text-align: left; font-size: 12px" class="outer-left"><?= $data_klinik->kota.', '.$data_klinik->provinsi.' '.$data_klinik->kode_pos; ?></p>
        </td> -->
        
      </tr>
    </table>

    <table class="tbl-header">
      <tr>
        <td align="center" class="head-center">
          <p style="text-align: center; font-size: 16px; padding-top:10px;" class="head-left"><strong> <?= $title; ?> </strong></p>
        </td>
      </tr>
      <tr>
        <td align="center" class="head-center">
          <p style="text-align: center; font-size: 20px; padding-top:5px;" class="head-left"><strong> Proyek <?= $nama_proyek; ?> </strong></p>
        </td>
      </tr>
    </table>

      <?php 
        $no = 1; 
        ## hitung jumlah kolomnya
        $counter_kolom = 0;
        $kode_bobot = '';
        $arr_tahun = [];
        foreach ($data_bobot as $kkk => $vvv) {
          if($vvv->kode != $kode_bobot){
            $counter_kolom++;
          }

          $kode_bobot = $vvv->kode;
        }

        // assign kolom tahun
        foreach ($data_bobot as $kkk => $vvv) {
          if (!in_array($vvv->tahun, $arr_tahun)){
            array_push($arr_tahun, $vvv->tahun);
          }
        }

        // var_dump($arr_tahun);exit;
    ?>
    <h5>Tabel Normalisasi</h5>
    <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
      <thead>
        <?php 
          $kode_bobot = '';
          echo '<th>#</th>'; 
          foreach ($data_bobot as $key => $value) {  
            if($value->kode == $kode_bobot) {
              echo '<th>'.$value->kode.'</th>';
            }
            
            $kode_bobot = $value->kode;
          } 
        ?>
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
    

    <h5>Proses Perhitungan Rangking</h5>
    <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
      <thead>
        <?php 
          $kode_bobot = '';
          $no = 1;
          echo '<th>#</th>'; 
          foreach ($data_bobot as $key => $value) {  
            if($value->kode == $kode_bobot) {
              echo '<th style="text-align:center">'.$value->kode.'</th>';
            }
            
            $kode_bobot = $value->kode;
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

    <?php 
      $no = 1; 
      $grand_total_thn = 0;
    ?>
    <h5>Hasil Rangking</h5>
    <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
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
        foreach ($arr_skor as $key => $value) {
          $arr_rangking[number_format((float)$value, 4,',','.')] = $key+1;
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
</body>

</html>