$(document).ready(function(){

var base_url=location.protocol+"//"+location.host+"/studera/teacher/";


//=======================
//=======================
//-------CLASS-----------
//=======================
//=======================

setTimeout(function(){$('.alert-info').fadeOut();}, 3000);

	//SEARCH STUDENT RECORD
	$('input[name=searchStudent]').keyup(function(){
		if($(this).val().length>4){
			$.post( 
          base_url+"teacher/search_student", 
          {search:$(this).val()}, 
          function(data){
              $(".searchresult").html(data);
          }
      );
      $(document).ajaxSend(function(event, xhr, settings) {$(".loading").fadeIn();});
      $(document).ajaxComplete(function(event, xhr, settings) {$(".loading").fadeOut();});
		}
	});

    $("#studentslist").select2({
        placeholder: "Type Name",
        allowClear: true, 
        theme: "classic",
        //FETCH SUBJECT FROM THE DATABASE
        ajax: {
                url: base_url+"teacher/get_students_list_select",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
        },
        minimumInputLength: 3
    });

    $(".classes").select2({
      theme:"classic"
    });
    
     
   
    //=====================
    //=====================
    //------SCORES---------
    //=====================
    //=====================

    //GET SCORE ENTRY FORM
    $('#addscoresform').submit(function(){
        $.post( 
          base_url+"teacher/getListforscoresEntry", 
          $('#addscoresform').serialize(), 
          function(data){
            $(".studentList").html(data);
            $('#addScoresModal').modal('hide');
          }
        ); 
        $(document).ajaxSend(function(event, xhr, settings) {$(".loading").fadeIn();});
        $(document).ajaxComplete(function(event, xhr, settings) {$(".loading").fadeOut();});
        return false;            
    });
  
    //CA SCORE ENTRY FORM
    $('#scoreType').change(function(){
        if($(this).val()=="CA"){
          var form_entry='<div class="form-group"><div class="input-group">';
              form_entry+='<div class="input-group-addon">1<sup>ST</sup> CA</div>';
              form_entry+=' <input type="text" class="form-control" name="CA1" required></div></div>';
              form_entry+='<div class="form-group"><div class="input-group">';
              form_entry+='<div class="input-group-addon">2<sup>ND</sup> CA</div>';
              form_entry+=' <input type="text" class="form-control" name="CA2" required></div></div>';
               $('.newForm').html(form_entry);           
        }
        else{
          var form_entry='<div class="form-group"><div class="input-group">';
              form_entry+='<div class="input-group-addon">3<sup>RD</sup> CA</div>';
              form_entry+=' <input type="text" class="form-control" name="CA3" required></div></div>';
              form_entry+='<div class="form-group"><div class="input-group">';
              form_entry+='<div class="input-group-addon">EXAM SCORE</div>';
              form_entry+=' <input type="text" class="form-control" name="EXAM" required></div></div>';
               $('.newForm').html(form_entry);           
        }
    });


   //GET PROMOTION LIST
    $('#promotionForm').submit(function(){
        $.post( 
          base_url+"teacher/get_promotion_list", 
          $('#promotionForm').serialize(), 
          function(data){
            $(".studentList").html(data);
            $('#promotionModal').modal('hide');
            //SELECT ALL CHECK BOX
            $('.selectAll').click(function(){
              if(!$('.checkbox').is(':checked')){
                $('.checkbox').attr("checked", "checked");
              }
              else{
                $('.checkbox').removeAttr("checked");
              }
            });
          }
        ); 
        $(document).ajaxSend(function(event, xhr, settings) {$(".loading").fadeIn();});
        $(document).ajaxComplete(function(event, xhr, settings) {$(".loading").fadeOut();});
        return false;            
    });


    //GET BEHAIVOUR REPORT FORM
    $('#getBehaivourReportform').submit(function(){
        $.post( 
          base_url+"teacher/getListforBehaivour", 
          $('#getBehaivourReportform').serialize(), 
          function(data){
            $(".studentList").html(data);
            $('#behaivioutReport').modal('hide');
          }
        ); 
        $(document).ajaxSend(function(event, xhr, settings) {$(".loading").fadeIn();});
        $(document).ajaxComplete(function(event, xhr, settings) {$(".loading").fadeOut();});
        return false;            
    });

     //GET STUDENTLIST FOR REPORT CARD GENERATION
    $('#reportcardform').submit(function(){
        $.post( 
          base_url+"teacher/fetch_studentlist", 
          $('#reportcardform').serialize(), 
          function(data){
            $(".studentList").html(data);
            $('#reportsheetModal').modal('hide');
          }
        ); 
        $(document).ajaxSend(function(event, xhr, settings) {$(".loading").fadeIn();});
        $(document).ajaxComplete(function(event, xhr, settings) {$(".loading").fadeOut();});
        return false;            
    });

    //SHOW EDIT SCORE BUTTON
    $('.EditscoreBtn').click(function(){
        $(this).hide();
        $('.toggleEditscore').show();
    });

    //TOGGLE EDIT SCORE
    $('.toggleEditscore').click(function(){
        $.post( 
          base_url+"teacher/fetch_score_detail", 
          {score_id:$(this).attr('id')}, 
            function(data){
              $('#editScoreModal').modal('show');
              $("#editScoreModal .modal-body").html(data);
              $('#updatescoreForm').submit(function(){
                  $.post( 
                    base_url+"teacher/update_score_info", 
                    $('#updatescoreForm').serialize(), 
                    function(data){
                      $(".alert-success").show().html(data);
                      $('#editScoreModal').modal('hide');
                    }
                  ); 
                  return false;            
              });

            }
        ); 
        $(document).ajaxSend(function(event, xhr, settings) {$(".loading").fadeIn();});
        $(document).ajaxComplete(function(event, xhr, settings) {$(".loading").fadeOut();});    
    });

     //DELETE SCORE
    $('.toggleDeletescore').click(function(){
      if(confirm('Are you sure you want to delete this score')){
        $.post( 
          base_url+"teacher/delete_score", 
          {score_id:$(this).attr('id')}, 
          function(data){
            $(".alert-success").html(data);
            setTimeout(function(){location.reload();}, 4000);
          }
        );
        $(document).ajaxSend(function(event, xhr, settings) {$(".loading").fadeIn();});
        $(document).ajaxComplete(function(event, xhr, settings) {$(".loading").fadeOut();}); 
      }
    });

   

});