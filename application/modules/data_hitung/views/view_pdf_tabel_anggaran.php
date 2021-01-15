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
    
    <p style="font-size: 16px;" class="head-left"><strong> Tahun Proyek : <?= $tahun_proyek; ?> </strong></p>
    <hr>
    <?php foreach ($kategori as $k => $v) { ?>
      <?php 
        $no = 1; 
        $grand_total_kat = 0;
      ?>
      <p style="font-size: 16px; padding-top:10px;" class="head-left"><strong><?= $v->nama; ?> </strong></p>
      <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
        <thead>
          <tr align="center">
          <th style="text-align:center;">#</th>
          <th style="text-align:center;">Uraian</th>
          <th style="text-align:center;">Satuan</th>
          <th style="text-align:center;">qty</th>
          <th style="text-align:center;">Harga Satuan</th>
          <th style="text-align:center;">Harga Total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $kk => $vv) { ?>
            <?php 
              $kat_ini = $data[$kk]->id_kategori;
              
              if(count($data)-1 == $kk) {
                $kat_next = $data[$kk]->id_kategori;
              }else{
                $kat_next = $data[$kk+1]->id_kategori;
              }

              if($kat_ini != $kat_next) {
                $is_kolom_total = true;
              }else{
                if(count($data)-1 == $kk) {
                  $is_kolom_total = true;
                }else{
                  $is_kolom_total = false;
                }
              }
            ?>

            <?php if($v->id == $vv->id_kategori) { ?>
              <?php $grand_total_kat += $vv->harga_total;?>
              <tr>
                <th scope="row"><?=$no++;?></th>
                <td width="40%"><?=$vv->nama_kriteria;?></td>
                <td width="10%"><?=$vv->kode_satuan;?></td>
                <td width="8%" align="right">
                  <?=number_format((float)$vv->qty, 2,',','.');?>
                </td>
                <td width="20%">
                  <span class="pull-left">Rp. </span>
                  <span class="pull-right"><?=number_format((float)$vv->harga_satuan, 2,',','.');?></span>
                </td>
                <td width="25%">
                  <span class="pull-left">Rp. </span>
                  <span class="pull-right"><?=number_format((float)$vv->harga_total, 2,',','.');?></span>
                </td>
              </tr>
              <?php if($is_kolom_total) { ?>
                <tr>
                  <th scope="row" colspan="5">Total </th>
                  <td>
                    <span class="pull-left">Rp. </span>
                    <span class="pull-right"><?=number_format((float)$grand_total_kat, 2,',','.');?></span>
                  </td>
                </tr>
              <?php } ?>
            <?php } ?>   
                     
          <?php } ?>
        </tbody>
      </table>
    <?php } ?>
  </div>
</body>

</html>