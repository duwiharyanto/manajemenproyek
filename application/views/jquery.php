
var sum = 0;
$('.totalprice').each(function(){
    sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
});
-----------------------------
var sum = 0;
$('.totalprice').each(function(){
    sum += parseFloat(this.value);
});

-----------------------------------
$(document).ready(function () {

     $("#contactform").validate({
         ignore: ":hidden",
         rules: {
             name: {
                 required: true,
                 minlength: 3
             },
             cognome: {
                 required: true,
                 minlength: 3
             },
             subject: {
                 required: true
             },
             message: {
                 required: true,
                 minlength: 10
             }
         },
         submitHandler: function (form) {
             $.ajax({
                 type: "POST",
                 url: "formfiles/submit.php",
                 data: $(form).serialize(),
                 success: function () {
                     $(form).html("<div id='message'></div>");
                     $('#message').html("<h2>Your request is on the way!</h2>")
                         .append("<p>someone</p>")
                         .hide()
                         .fadeIn(1500, function () {
                         $('#message').append("<img id='checkmark' src='images/ok.png' />");
                     });
                 }
             });
             return false; // required to block normal submit since you used ajax
         }
     });

 });