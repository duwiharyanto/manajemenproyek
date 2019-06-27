$(document).ready(function(){
    //AJAX UPGRADE CUTI BY ID
    $('.upgradecuti').click(function(){
      var link=$(this).attr('link');
      var id=$(this).attr('id');
      //alert(link);
      $.ajax({
        type:'POST',
        url:link,
        data:{id:id},
        success:function(data){
          $("#upgradecutibyid").html(data);
          $("#upgradecutibyid").modal('show',{backdrop:'true'});
        }
      })      
    }); 	
})