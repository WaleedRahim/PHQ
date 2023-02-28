$('.myform').on('submit', function(event) {
   
    event.preventDefault();
    
   

    var link = " <?php echo admin_url('admin-ajax.php')?> ";

    var form = jQuery('.myform').serialize();
    var doc = new jsPDF();
    $.each(form, function(i, field){
        doc.text(field.value, 10, 10*(i+1));
    });

    doc.save('form.pdf');
    var score = $('#PHQ9txt').text();
    var points = $('#PHQ9points').text();

   var forms = form+'&Score='+score+'&points='+points;
    var formData = new FormData;
   formData.append('action','contact_us');
   formData.append('contact_us',forms);
//    formData.append('Score',score);
//    formData.append('points',points);
  

   jQuery.ajax({
    type: 'post',
    url: link,
    data: formData,
    processData:false,
    contentType:false,
    success: function (result) {
        alert (result);
    }
   });

   this.reset();

   
});
