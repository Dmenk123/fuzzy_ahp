var save_method;
var table;

$(document).ready(function() {

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

    $('#btn_next').click(function (e) { 
        e.preventDefault();
        //let step_kriteria = $('#step_kriteria').val();
        let form = $('#form_hitung_kategori')[0];
        let data = new FormData(form);
        //data.append('step_kriteria', step_kriteria);
        swalConfirm.fire({
            title: 'Konfirmasi',
            text: "Lanjut Ke Langkah Berikutnya ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya !',
            cancelButtonText: 'Tidak !',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: base_url+'hitung_kategori/next_step',
                    data: data,
                    dataType: "JSON",
                    processData: false,
                    contentType: false, 
                    cache: false,
                    timeout: 600000,
                    success: function (response) {
                        if(response.status){
                            if(response.data_step.next_step != 'false') {
                                swalConfirm.fire(
                                    'Sukses !', 
                                    response.pesan, 
                                    'success'
                                ).then(function() {
                                    window.location.href = base_url+"hitung_kategori/formulir_hitung/"+response.data_step.id_hitung+'?kategori='+response.data_step.id_kategori+'&kriteria='+response.data_step.next_step_kode;
                                });
                            }
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swalConfirm.fire('Terjadi Kesalahan');
                    }
                });
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalConfirm.fire(
                'Dibatalkan',
                'Aksi Dibatalakan',
                'error'
              )
            }
        });
    });

    $('#btn_next_proyek').click(function (e) { 
        e.preventDefault();
        //let step_kriteria = $('#step_kriteria').val();
        let form = $('#form_hitung_proyek')[0];
        let data = new FormData(form);
        //data.append('step_kriteria', step_kriteria);
        swalConfirm.fire({
            title: 'Konfirmasi',
            text: "Lanjut Ke Langkah Berikutnya ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya !',
            cancelButtonText: 'Tidak !',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: base_url+'hitung_kategori/next_step_proyek',
                    data: data,
                    dataType: "JSON",
                    processData: false,
                    contentType: false, 
                    cache: false,
                    timeout: 600000,
                    success: function (response) {
                        if(response.status){
                            swalConfirm.fire(
                                'Sukses !', 
                                response.pesan, 
                                'success'
                            ).then(function() {
                                window.location.href = base_url+"hitung_kategori/formulir_hitung/"+response.id_hitung+'?kategori='+response.id_kategori+'&kriteria=C1';
                            });
                        }else{
                            for (var i = 0; i < response.inputerror.length; i++) 
                            {
                                if (response.inputerror[i] != 'proyek') {
                                    //ikut style global
                                    $('[name="'+response.inputerror[i]+'"]').addClass('is-invalid');
                                    $('[name="'+response.inputerror[i]+'"]').next().text(response.error_string[i]).addClass('invalid-feedback'); 
                                }else{
                                    //select span help-block class set text error string
                                    $('[name="'+response.inputerror[i]+'"]').next().next().text(response.error_string[i]).addClass('invalid-feedback-select');
                                }
                            }
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swalConfirm.fire('Terjadi Kesalahan');
                    }
                });
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalConfirm.fire(
                'Dibatalkan',
                'Aksi Dibatalakan',
                'error'
              )
            }
        });
    });


    $('#btn_finish').click(function (e) { 
        e.preventDefault();
        //let step_kriteria = $('#step_kriteria').val();
        let form = $('#form_hitung_kategori')[0];
        let data = new FormData(form);
        //data.append('step_kriteria', step_kriteria);
        swalConfirm.fire({
            title: 'Konfirmasi',
            text: "Selesai Melakukan Perhitungan ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya !',
            cancelButtonText: 'Tidak !',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: base_url+'hitung_kategori/finish_step',
                    data: data,
                    dataType: "JSON",
                    processData: false,
                    contentType: false, 
                    cache: false,
                    timeout: 600000,
                    success: function (response) {
                        if(response.status){
                            swalConfirm.fire(
                                'Sukses !', 
                                response.pesan, 
                                'success'
                            ).then(function() {
                                window.location.href = base_url+"hitung_kategori/list_perhitungan/"+response.id_hitung;
                            });
                            
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swalConfirm.fire('Terjadi Kesalahan');
                    }
                });
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalConfirm.fire(
                'Dibatalkan',
                'Aksi Dibatalakan',
                'error'
              )
            }
        });
    });

    $('.step_kriteria').click(function (e) { 
        e.preventDefault();
        let step_kriteria = $(this).data('kriteria');
        let step_kategori = $(this).data('kategori');
        let id_hitung = $(this).data('idhitung');
       
        if(id_hitung != false){
            window.location.href = base_url+"hitung_kategori/formulir_hitung/"+id_hitung+"?kategori="+step_kategori+"&kriteria="+step_kriteria;
        }else{
            window.location.href = base_url+"hitung_kategori/formulir_hitung?kategori="+step_kategori+"&kriteria="+step_kriteria;
        }
        
    });

    $('#btn_prev').click(function (e) { 
        e.preventDefault();
        let step_kriteria = $('#step_kriteria').val();
        let step_kategori = $('#id_kategori').val();
        let pattern = /\d+/;
        let pattern2 = /\w/;
        let angka = step_kriteria.match(pattern);
        let huruf = step_kriteria.match(pattern2);
        window.location.href = base_url+"hitung_kategori/formulir_hitung/"+step_kategori+'?kriteria='+huruf+(parseInt(angka) - 1);
    });

    /////////////////////////////////////////////////////////

	//datatables
    table = $('#tabel_data').DataTable();
    
    $(".modal").on("hidden.bs.modal", function(){
        reset_modal_form();
    });
});

function add_menu()
{
    reset_modal_form();
    save_method = 'add';
	$('#modal_kriteria_form').modal('show');
	$('#modal_title').text('Tambah Kriteria Baru'); 
}

function edit_data(id)
{
    reset_modal_form();
    save_method = 'update';
    //Ajax Load data from ajax
    $.ajax({
        url : base_url + 'master_kriteria/edit_data',
        type: "POST",
        dataType: "JSON",
        data : {id:id},
        success: function(data)
        {
            $('[name="id"]').val(data.old_data.id);
            $('[name="nama"]').val(data.old_data.nama);
            $('[name="kategori"]').val(data.old_data.id_kategori);
            $('#modal_kriteria_form').modal('show');
	        $('#modal_title').text('Edit Kriteria'); 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    var url;
    var txtAksi;

    if(save_method == 'add') {
        url = base_url + 'master_kriteria/add_data_kriteria';
        txtAksi = 'Tambah kriteria';
    }else{
        url = base_url + 'master_kriteria/update_data_kriteria';
        txtAksi = 'Edit kriteria';
    }
    
    var form = $('#form-kriteria')[0];
    var data = new FormData(form);
    
    $("#btnSave").prop("disabled", true);
    $('#btnSave').text('Menyimpan Data'); //change button text
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: url,
        data: data,
        dataType: "JSON",
        processData: false, // false, it prevent jQuery form transforming the data into a query string
        contentType: false, 
        cache: false,
        timeout: 600000,
        success: function (data) {
            if(data.status) {
                swal.fire("Sukses!!", "Aksi "+txtAksi+" Berhasil", "success");
                $("#btnSave").prop("disabled", false);
                $('#btnSave').text('Simpan');
                
                reset_modal_form();
                $(".modal").modal('hide');
                
                reload_table();
            }else {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    if (data.inputerror[i] != 'pegawai') {
                        $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback'); //select span help-block class set text error string
                    }else{
                        //ikut style global
                        $('[name="'+data.inputerror[i]+'"]').next().next().text(data.error_string[i]).addClass('invalid-feedback-select');
                    }
                }

                $("#btnSave").prop("disabled", false);
                $('#btnSave').text('Simpan');
            }
        },
        error: function (e) {
            console.log("ERROR : ", e);
            $("#btnSave").prop("disabled", false);
            $('#btnSave').text('Simpan');

            reset_modal_form();
            $(".modal").modal('hide');
        }
    });
}

function delete_data(id){
    swalConfirmDelete.fire({
        title: 'Hapus Data ?',
        text: "Data Akan dihapus permanen ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Data !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'master_kriteria/delete_data',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Hapus Data!', data.pesan, 'success');
                    table.ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    Swal.fire('Terjadi Kesalahan');
                }
            });
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalConfirm.fire(
            'Dibatalkan',
            'Aksi Dibatalakan',
            'error'
          )
        }
    });
}

function reset_modal_form()
{
    $('#form-kriteria')[0].reset();
    $('.append-opt').remove(); 
    $('div.form-group').children().removeClass("is-invalid invalid-feedback");
    $('span.help-block').text('');
}