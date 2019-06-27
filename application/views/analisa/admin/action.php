<script type="text/javascript">
$(document).ready(function(){
  edit(); 
  validasi();
  hapus_();
  $('.tutup').click(function(){
    $(".modal").modal('hide');
  })
  $('.hapus').click(function(){
    var url=$(this).attr('url');
    swal({
      title:'Perhatian',
      text:'Hapus Data',
      html:true,
      ConfirmButtonColor:'#d9534F',
      showCancelButton:true,
      type:'warning'
    },function(){
      window.location.href=url    
    });
    return false
  }) 
  $("#addtafsiran").click(function(){
    var url=$(this).attr('url');
    var id=$(this).attr("value");
    //alert(url);
    $.ajax({
      type:'POST',
      url:url,
      data:{id:id},
      success:function(data){
        $("#tafsiran").html(data);
        // $("#modal-tafsiran").modal({show:true});  
        // $(".modaltafsiran").modal('show');
        alert('dwadaw');     
      }
    })
    return false; 
  })          
  $('.datatabel').DataTable();
  $('.datepicker').datepicker({
      autoclose: true,
      todayHighlight: true,
      format: "dd-mm-yyyy",
      todayBtn: true,
  });
  $(".selectdata").select2();            
  $('.price').priceFormat({
    prefix:'Rp ',
    thousandsSeparator:'.',
    centsLimit:'0',
  }); 
  $('.volume').priceFormat({
    prefix:'',
    thousandsSeparator:'.',
    centsLimit:'0',
  });      
})
function add(){
  var url=$("#add").attr('url');   
  $("#view").load(url);      
}
function hapus_(){
  $('.hapus_').click(function(){
    var url=$(this).attr('url');
    var id=$(this).attr('id');
    var idpekerjaan=$(this).attr('idpekerjaan');
    swal({
      title:'Perhatian',
      text:'Hapus Data',
      html:true,
      ConfirmButtonColor:'#d9534F',
      showCancelButton:true,
      type:'warning'
    },function(){
      // window.location.href=url
        $.ajax({
          url:url,
          type:'POST',
          dataType:'json',
          data:{id:id,idpekerjaan:idpekerjaan},
          success:function(data){
            notifikasi(data);
            loaddata(idpekerjaan);
            console.log(data.success);
          }
        })      
    });
    return false
  })   
}
function edit(){   
  $('.edit').click(function(){
    var url=$(this).attr('url');
    var id=$(this).attr('id');
    //alert(id);
    $.ajax({
      type:'POST',
      url:url,
      data:{id:id},
      success:function(data){
        $("#view").html(data);       
      }
    })
    return false;        
  })
}
function validasi(){
  $("form").validate({
  errorPlacement: function ( error, element ) {
    if ( element.prop( "type" ) === "checkbox" ) {
      error.insertAfter( element.parent( "label" ) );
    } else {
      error.insertAfter( element );
    }
    // Add the `help-block` class to the error element
    error.addClass( "help-block" );
    $('.error').css('font-weight', 'normal');
  },    
  highlight: function ( element, errorClass, validClass ) {
    $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
  },
  unhighlight: function (element, errorClass, validClass) {
    $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
  },
  submitHandler: function (form) {
    var url = $('form').attr('url');
    //var idpekerjaan = $('[name=pekerjaan_id]').attr('url');
    // var base_url="<?= base_url($global->url.'tabel')?>";
    //alert(idpekerjaan);
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: $('form').serialize(),
      data: new FormData($('form')[0]),
      processData: false,
      contentType: false,
      encode: true,
      cache: false,
      secureuri: false,
      cache: false,
      mimeType: 'multipart/form-data',
      success: function (data) {
        $(".modal").modal('hide');
        notifikasi(data);
        //alert(data.success);
        //window.location.href='<?= base_url($global->url)?>';
        //loaddata(data.id_pekerjaan);
        console.log(data);

      },
      error: function () {
        $.notify({
          title: '<strong>Perhatian </strong>',
          message: 'Fatal Error, Contact Admin',
        }, {
          type: 'danger'
        });
        console.log(data.upload);
      }
    })
  }       
  });    
}
function loaddata(idpekerjaan){
  var url='<?= base_url($global->url."tabel/")?>'+idpekerjaan;
  $("#tabel").load(url);     
  //alert('Data tersimpan');
}
function notifikasi(data){
  if (data.success) {
    $.notify({
      title: '<strong class="fa fa-check"></strong>',
      message: data.success,
    }, {
      type: 'success'
    });
  } else {
    $.notify({
      title: '<strong class="fa fa-warning"></strong>',
      message: data.error,
    }, {
      type: 'danger'
    });
  } 
}
function tambahtafsiran(){
    var url=$('#tafsirantmbl').attr('url');
    var id=$('#tafsirantmbl').attr("value");
    //alert(url);
    $.ajax({
      type:'POST',
      url:url,
      data:{id:id},
      success:function(data){
        $("#tafsiran").html(data);
        // $("#modal-tafsiran").modal({show:true});  
        $(".modaltafsiran").modal('show');
        //alert('dwadaw');     
      }
    })
    return false; 
}   
</script>