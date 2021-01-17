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
    <h5>Nilai Bobot Per Kategori</h5>
    <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
          <th style="text-align:center;">#</th>
          <?php for ($i=1; $i <= $counter_kolom; $i++) { 
            echo '<th class="text-center">C'.$i.'</th>';
          } ?>
        </tr>
      </thead>
      <tbody>
        <?php for ($z=0; $z < count($arr_tahun); $z++) { ?>
          <tr>
            <th class="text-center">A<?=$z+1;?></th>

            <?php foreach ($data_bobot as $k => $v) { ?>
              <?php if($arr_tahun[$z] == $v->tahun) { ?>
                <td class="text-center"><?=number_format((float)$v->bobot, 4,',','.');?></td>                    
              <?php } ?>
            <?php } ?>
            
          </tr>
        <?php } ?>

        <tr>
          <th class="text-center">JUMLAH</th>
          <?php 
            $kode_bobot = $data_bobot[0]->kode; 
            $jumlah_bobot = 0;
            foreach ($data_bobot as $k => $v) {
              if($kode_bobot == $v->kode) {
                $jumlah_bobot += $v->bobot;
              }else{
            ?>
              <td class="text-center"><?=number_format((float)$jumlah_bobot, 4,',','.');?></td>  
              <?php 
                //reset
                $jumlah_bobot = 0;
                //assign bobot
                $jumlah_bobot += $v->bobot;
              ?>
            <?php } ?>

            <?php $kode_bobot = $v->kode; ?>
          <?php } ?>
          
          <!-- tambahan kolom -->
          <td class="text-center"><?=number_format((float)$jumlah_bobot, 4,',','.');?></td>  
        </tr>
      </tbody>
    </table>
    
  </div>
</body>

</html>