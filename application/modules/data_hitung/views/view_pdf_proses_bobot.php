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

   
    <h5>Proses Bobot Perhitungan Per Kategori</h5>
    <table id="tbl_content" class="table table-bordered table-hover" cellspacing="0" width="100%" border="1">
      <tbody>
      <?php $is_first_header = true; ?>
      <?php $flag_kode = ''; ?>
      <?php $flag_tahun = $data_bobot[0]->tahun; ?>

      <?php foreach ($data_bobot as $k => $v) { ?>
        <?php if($flag_kode != $v->kode) { ?>
          <?php if($is_first_header == false) { ?>
            <tr>
              <th colspan="5"></th>
            </tr>
          <?php } ?>
          <tr>
            <th><?=$v->kode;?></th>
            <th>MAX</th>
            <th>MIN</th>
            <th>MAX-MIN</th>
            <th>BOBOT (W)</th>
          </tr>
        <?php } ?>
        <tr>
          <th scope="row"><?=$v->nilai_awal;?></td>
          <td class="text-right"><?=$v->max;?></td>
          <td class="text-right"><?=$v->min;?></td>
          <td class="text-right"><?=$v->max_min;?></td>
          <td class="text-right"><?=number_format((float)$v->bobot, 10,',','.');?></td>
        </tr>
        <?php 
          $flag_kode = $v->kode;
          $is_first_header = false; 
        ?>
      <?php } ?>
      </tbody>
    </table>
    
  </div>
</body>

</html>