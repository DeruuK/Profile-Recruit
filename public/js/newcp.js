$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// for test page and it success!!!!!!
$(document).ready(function(){
    $('#testform').submit(function(event){
        event.preventDefault();
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        //$.post('postTest',{fname:fname,lname:lname}, function(data){
        //    $('#postFormData').html(data);
        //});
        var dataString="fname="+fname+"&lname="+lname;
 //       alert(dataString);
        $.ajax({
            type: "POST",
            url: "testpage",
            data: dataString,
            dataType: 'JSON',
            success: function(data){
                console.log("success "+data.lname);
                //var i = 0;
                         var table = '<table class="mainTable"><tr><th width=70px>#</th><th width=70px>fname</th><th width=70px>lname</th></tr>';
                         //data = $.parseJSON(data)
                               $.each(data, function (idx, obj) {                                   
                                    table += ('<tr>');
                                    table += ('<td>' + idx + '</td>');
                                    table += ('<td>' + obj.fname + '</td>');
                                    table += ('<td>' + obj.lname + '</td>');              
                                    table += ('</tr>'); 
                              });
                         table += '</table>';
                $('#postFormData').html(table);
                    
            },
            error: function(data){
                console.log("failed "+data.fname);
           //     alert("failed..");
            }
        });
    });
    
    // auto fill edit-EXP form
    $('.ms-exp-edit').click(function(){
        var expid =  $(this).data('id');
    //    alert("eid="+eid);
        var dataString = "expid="+ encodeURIComponent(expid);
        var URL = "expedit/"+ expid;
        $.ajax({
            type: "POST",
            url: URL,
            data: dataString,
            dataType: 'JSON',
            success: function(data){
                console.log("success: "+data);
                //var i = 0;
                $("#eexp-org").val(data.orgnization);
                $("#eexp-ftime").val(data.ftime);
                $("#eexp-ttime").val(data.ttime);
                $("#eexp-role").val(data.role);
                $("#eexp-desc").val(data.desc);
                $("#eexp-video").val(data.video);
                $('#eexp-id').val(expid);
            },
            error: function(data){
                console.log("failed "+data);
           //     alert("failed..");
            }
        });
    });
    // delete exp
    $('.ms-exp-delete').click(function(){
        var expid = $(this).data('id');
        var dataString = "expid="+ encodeURIComponent(expid);
        var URL = "expdelete/"+ expid;
         $.ajax({
            type: "POST",
            url: URL,
            data: dataString,
            dataType: 'JSON',
            success: function(data){
                console.log("success: "+data.success);
                window.location.replace("myspace");
                //var i = 0;
                //alert("just delete a experience");
            },
            error: function(data){
                console.log("failed "+data);
           //     alert("failed..");
            }
        });
    });
        
        // auto fill edit-EDU form
    $('.ms-edu-edit').click(function(){
        var eduid =  $(this).data('id');
    //    alert("eid="+eid);
        var dataString = "eduid="+ encodeURIComponent(eduid);
        var URL = "eduedit/"+ eduid;
        $.ajax({
            type: "POST",
            url: URL,
            data: dataString,
            dataType: 'JSON',
            success: function(data){
                console.log("success: "+data);
                //var i = 0;
                $("#eedu-school").val(data.school);
                $("#eedu-ftime").val(data.ftime);
                $("#eedu-ttime").val(data.ttime);
                $("#eedu-major").val(data.major);
                $("#eedu-degree").val(data.degree);
                $('#eedu-id').val(eduid);
            },
            error: function(data){
                console.log("failed "+data);
           //     alert("failed..");
            }
        });
    });
    
    // delete edu
    $('.ms-edu-delete').click(function(){
        var eduid = $(this).data('id');
        var dataString = "expid="+ encodeURIComponent(eduid);
        var URL = "edudelete/"+ eduid;
         $.ajax({
            type: "POST",
            url: URL,
            data: dataString,
            dataType: 'JSON',
            success: function(data){
                console.log("success: "+data.success);
                window.location.replace("myspace");
                //var i = 0;
                //alert("just delete a experience");
            },
            error: function(data){
                console.log("failed "+data);
           //     alert("failed..");
            }
        });
    });
    
    // delete rec
    $('.ms-rec-delete').click(function(){
        var recid = $(this).data('id');
        var dataString = "recid="+ encodeURIComponent(recid);
        var URL = "recdelete/"+ recid;
         $.ajax({
            type: "POST",
            url: URL,
            data: dataString,
            dataType: 'JSON',
            success: function(data){
                console.log("success: "+data.success);
                window.location.replace("recruit");
                //var i = 0;
                //alert("just delete a experience");
            },
            error: function(data){
                console.log("failed "+data);
           //     alert("failed..");
            }
        });
    });
    
    //auto fill edit INFO form
    $('#ms-info-edit').click(function(){
        var userid =  $(this).data('id');
    //    alert("eid="+eid);
        var dataString = "userid="+ encodeURIComponent(userid);
        var URL = "infoedit/"+ userid;
        $.ajax({
            type: "POST",
            url: URL,
            data: dataString,
            dataType: 'JSON',
            success: function(data){
                console.log("success: "+data);
                //var i = 0;
                $("#einfo-name").html(data.name);
                $("#einfo-status").val(data.status);
                $("#einfo-major").val(data.major);
                $("#einfo-edulevel").val(data.edulevel);
                $("#einfo-language").val(data.language);

                $("#einfo-url").val(data.imgurl);
                // $('#eedu-id').val(eduid);

            },
            error: function(data){
                console.log("failed "+data);
           //     alert("failed..");
            }
        });
    });
    
     //auto fill edit RECRUIT form
    $('.ms-rec-edit').click(function(){
        var recid =  $(this).data('id');
    //    alert("eid="+eid);
        var dataString = "recid="+ encodeURIComponent(recid);
        var URL = "recedit/"+ recid;
        $.ajax({
            type: "POST",
            url: URL,
            data: dataString,
            dataType: 'JSON',
            success: function(data){
                console.log("success: "+data);
                //var i = 0;
                
                $("#erec-position").val(data.position);
                $("#erec-company").val(data.companyName);
                $("#erec-description").val(data.description);
                $("#erec-id").val(recid);

            },
            error: function(data){
                console.log("failed "+data);
           //     alert("failed..");
            }
        });
    });
    
    // add recruit
    $('#addRecruit').submit(function(){
        var company = $('#company').val();
        var position = $('#position').val();
        var desc = $('#description').val();
        
        dataString = "company="+company+"&position="+position+"&description="+desc;
        $.ajax({
            type: "GET",
            url: "addRecruit",
            data: dataString,
            dataType: 'JSON',
            success: function(data){
                console.log("success: "+data);
                window.location.replace("recruit");

            },
            error: function(data){
                console.log("failed "+data);
            }
        });
    
    });
    
    // send my cv
    $('.sendcv').click(function(){
        var recid =  $(this).data('id'); 
        var dataString = "recid="+ encodeURIComponent(recid);
        var URL = "sendcv/"+ recid;
        $.ajax({
            type: "POST",
            url: URL,
            data: dataString,
            dataType: 'JSON',
            success: function(data){
                console.log("success: "+data);
                if (data) {
                    //code
                    var address = data.sendto;
                    var title = data.subject;
                    var exps = data.exps;
                    var edus = data.edus;
                    var expc = "\n"+"Experience"+"\n\n";
                    var educ = "\n"+"Education"+"\n\n";
                    //var br = "/n";
                    var baseinfo = "\n"+data.name+"\n"+data.edulevel+" in "+data.major +"\n"+data.language+"\n"+"\n";
                    
                    $.each(exps, function(index, exp){
                        expc = expc +exp.company_program + "\n" +  exp.beginTime+" to "+ exp.endTime+"\n";
                        expc = expc + exp.description+"\n\n";
                    });
                    
                    $.each(edus, function(index, edu){
                        educ = educ +edu.school + "\n" +  edu.beginTime+" to "+ edu.endTime+"\n";
                        educ = educ + edu.major+"\n" +  edu.level+"\n\n";
                    });
                    
                    
                    var body = baseinfo+expc+educ;
                    
                    
                    var link = "mailto:"+address+"?subject="+title+"&body="+encodeURIComponent(body);
                    window.location.href = link;
                }
            
            },
            error: function(data){
                console.log("failed "+data);
           //     alert("failed..");
            }
        });
    });
    
    
    //submit add exp form
    
    //submit edit edu form
    
    //submit edit exp form
    
    //submit edit info form
    
    
});