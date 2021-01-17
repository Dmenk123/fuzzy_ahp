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
      $jumlah_kolom = (count($data) / 2);
      $grand_total_thn = 0;
    ?>
    
    <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
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
          <td width="10%" class="text-center"><?=$tahun;?></td>
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
              <td width="15%" class="text-right">
                <span class="text-right"><?=number_format((float)$vv->total, 2,',','.');?></span>
              </td>

              <?php if($is_kolom_akhir == true) { ?>
                <td width="25%" class="text-right">
                  <span class="text-right"><strong><?=number_format((float)$grand_total_thn, 2,',','.');?></strong></span>
                </td>
              <?php } ?>

            <?php }else{ ?>
              <?php $flag_tahun = $vv->tahun; ?>
              <?php $grand_total_thn = 0; ?>
              </tr>
              <tr>
                <th scope="row"><?='A'.$no++;?></th>
                <td width="10%" class="text-center"><?=$vv->tahun;?></td>
                <td width="15%" class="text-right">
                  <span class="text-right"><?=number_format((float)$vv->total, 2,',','.');?></span>
                </td>
            <?php } ?>       
        <?php } ?>
      </tbody>
    </table>
    
  </div>
</body>

</html>