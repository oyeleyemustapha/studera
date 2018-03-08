$(document).ready(function(){

var base_url=location.protocol+"//"+location.host+"/studera/administrator/";

$('.slimscrollsidebar').slimScroll({
  height: '570px',
  color:  '#FFFFFF'
});

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
          base_url+"admin/search_student", 
          {search:$(this).val()}, 
          function(data){
              $(".searchresult").html(data);
          }
      );
      $(document).ajaxSend(function(event, xhr, settings) {$(".loading").fadeIn();});
      $(document).ajaxComplete(function(event, xhr, settings) {$(".loading").fadeOut();});
		}
	});


	//TOGGLE EDIT STUDENT INFORMATION
	$('.toggleeditStudent').click(function(){
		$('.studentprofile').hide();
		$('.editstudentform').show();
	});

	
	//TOGGLE CREATE STUDENT RECORD
	$('.TogglecreateRecord').click(function(){
		$(this).hide();
		$('.searchStudent').hide();
		$('#addStudent').show();
	});


  //DISPLAY SUBJECTS AND CLASS LIST IN DATATABLE
	 $('.subjects, .classList').DataTable({
        "info": false,
        "iDisplayLength" : 5,
        "lengthMenu" : [5, 10, 20, 30, 40, 50],
        "drawCallback": function( settings ) {

        	  //FETCH SUBJECT INFORMATION
            $('.editSubject').click(function(){
                $.post( 
                    base_url+"admin/fetch_subject_info", 
                    {subject_id:$(this).attr('id')}, 
                    function(data){
                        $("#modal-id").modal('show');
                        $("#modal-id .modal-body").html(data);
                    }
                );
                 $(document).ajaxSend(function(event, xhr, settings) {$(".loading").fadeIn();});
                 $(document).ajaxComplete(function(event, xhr, settings) {$(".loading").fadeOut();});
            });

             //FETCH ADMINISTRATOR INFORMATION FOR EDITING
             $('.EditAdmin').click(function(){
                $.post( 
                    base_url+"admin/fetch_admin_info", 
                    {admin_id:$(this).attr('id')}, 
                    function(data){
                        $("#teacherMOdal").modal('show');
                        $("#teacherMOdal .modal-title").text('Update Admnistrator Account');
                        $("#teacherMOdal .modal-body").html(data);
                    }
                );
                $(document).ajaxSend(function(event, xhr, settings) {$(".loading").fadeIn();});
                $(document).ajaxComplete(function(event, xhr, settings) {$(".loading").fadeOut();});
            });
        }       
    });

    //PREVIEW PICTURE BEFORE UPLOAD
    $('#picture').on('change', function(){
            if(typeof (FileReader) !="undefined"){
                var image_holder=$('.picture_holder');
                image_holder.empty();

                var reader= new FileReader();
                reader.onload=function(e){
                    $("<img />",{
                        "src": e.target.result,
                        "class": "img-responsive"
                    }).appendTo(image_holder);
                }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
            }
            else{
                
            }
    });

    $("#studentslist").select2({
        placeholder: "Type Name",
        allowClear: true, 
        theme: "classic",
        //FETCH SUBJECT FROM THE DATABASE
        ajax: {
                url: base_url+"admin/get_students_list_select",
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

    $("#subjects, .subjectslist").select2({
      placeholder: "Type Subject",
      allowClear: true, 
      theme: "classic",
      //FETCH SUBJECT FROM THE DATABASE
      ajax: {
              url: base_url+"admin/get_seubjects_list",
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


    //RESOURCES
    $('.getCategoryform').change(function(){
      var category=$('.getCategoryform').val();
        if(category!=""){
            if(category=='5'){
              var form='<form method="post" action="addLink"><input type="hidden" value="'+category+'" name="category">';
              form+='<div class="form-group"><input type="text" class="form-control input-lg"  name="title" placeholder="Link Title" required></div>';
              form+='<div class="form-group"><input type="text" class="form-control input-lg"  name="link" placeholder="Link" required></div>';
              form+='<button class="btn btn-warning btn-block">Add</button></form>';
              $('#resourcesinputform').html(form);
            }
            else{
              var form='<form method="post" action="addResource" enctype="multipart/form-data"><input type="hidden" value="'+category+'" name="category">';
              form+='<div class="form-group"><input type="text" class="form-control input-lg"  name="title" placeholder="Title" required></div>';
              form+='<div class="form-group"><input type="file" class="form-control input-lg"  name="file" placeholder="file" required></div>';
              form+='<button class="btn btn-warning btn-block">Add</button></form>';
              $('#resourcesinputform').html(form);
            }
        }
    });


    //=====================
    //=====================
    //------SCORES---------
    //=====================
    //=====================

    //SHOW EDIT SCORE BUTTON
    $('.EditscoreBtn').click(function(){
        $(this).hide();
        $('.toggleEditscore').show();
    });

    //TOGGLE EDIT SCORE
    $('.toggleEditscore').click(function(){
        $.post( 
          base_url+"admin/fetch_score_detail", 
          {score_id:$(this).attr('id')}, 
            function(data){
              $('#editScoreModal').modal('show');
              $("#editScoreModal .modal-body").html(data);
              $('#updatescoreForm').submit(function(){
                  $.post( 
                    base_url+"admin/update_score_info", 
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

    //GET STUDENTLIST FOR REPORT CARD GENERATION
    $('#reportcardform').submit(function(){
        $.post( 
          base_url+"admin/fetch_studentlist", 
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

    //GET BEHAIVOUR REPORT FORM
    $('#getBehaivourReportform').submit(function(){
        $.post( 
          base_url+"admin/getListforBehaivour", 
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

    //GET SCORE ENTRY FORM
    $('#addscoresform').submit(function(){
        $.post( 
          base_url+"admin/getListforscoresEntry", 
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

    //DELETE SCORE
    $('.toggleDeletescore').click(function(){
      if(confirm('Are you sure you want to delete this score')){
        $.post( 
          base_url+"admin/delete_score", 
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

    //GET PROMOTION LIST
    $('#promotionForm').submit(function(){
        $.post( 
          base_url+"admin/get_promotion_list", 
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

    
});