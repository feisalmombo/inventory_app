$(document).ready(function(){
	//console.log('Imepita');

  // $('#addPrice').mouseenter(function(){
  // alert("Add price!");
  // });

    reloadData();
    //loadRequest();
    //loadAddPrice();

    // setTimeout(function() {
    //     loadRequest();
    //     loadAddPrice();
    // }, 2000);

  $('.dah').click(function(){
     document.location.href = '/home';
  });


  $('#requestCount').click(function(){
      $.ajax({
        url:"/requestedProduct/loadRequestView",
        success: function(data){
        requestData = JSON.parse(data);
        //console.log("Imekubali");
        //console.log(requestData);
        $("#proConf").empty();
        $.each(requestData,function(key,value){
             $("#proConf").append('<li><a href="/manage-request/single/'+value.id+'"><i class="fa fa-chevron-right text-aqua"></i>'+value.product_name+'</a></li>');
         });

      }
    });
  });


    $('#addPrice').click(function(){
      $.ajax({
        url:"/add-product-price/loadRequestView",
        success: function(data){
        requestData = JSON.parse(data);
        //console.log("Imekubali Price");
        //console.log(requestData);
        $("#proPrice").empty();
        $.each(requestData,function(key,value){

             $("#proPrice").append('<li><a href="/manage-prices/single/'+value.id+'"><i class="fa fa-chevron-right text-aqua"></i>'+value.product_name+'</a></li>');
         });

      }
    });
  });



  $('#storeId').change(function(){
                var select = $(this).attr('id');
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();
            if($(this).val() != ''){
                $.ajax({
                    url:"/manage-products/store-categories-load",
                    method:"GET",
                    data:{select:select, value:value, _token:_token, dependent:dependent},
                    success: function(data){
                      //console.log(data.id);
                      // $.each(JSON.parse(data), function(key,value){

                      //   $.each(value,function(key,value){
                      //     console.log(value.category_name);
                      //   });
                      // });
                        if(data){
                            $("#categoryId").empty();
                            $("#categoryId").append('<option> -- Select Category --</option>');
                            $.each(JSON.parse(data),function(key,value){
                                //console.log(value.category);
                                //console.log(value.id);
                                $.each(value.category,function(key,value){
                                      $("#categoryId").append('<option value="'+value.id+'">'+value.category_name+'</option>');
                                    //console.log(value.category_name);
                                 });


                            });

                        }else{
                           $("#categoryId").empty();
                            $("#categoryId").append('<option> It has no corresponding category!!</option>');

                        }
                    }
                });
            }
        });

    $('.activeUser').on('click',function(){
                var value = $(this).val();
                //console.log('Active: '+value);
            if($(this).val() != ''){
                $.ajax({
                    url:"/manage-users/change-status-load",
                    method:"GET",
                    data:{value:value},
                    success: function(data){
                      //console.log(data);
                      location.reload();
                    }
                });
            }
        });


    $('.inactiveUser').on('click',function(){
                var value = $(this).val();
                //console.log('In active: '+value);
            if($(this).val() != ''){
                $.ajax({
                    url:"/manage-users/change-status-load",
                    method:"GET",
                    data:{value:value},
                    success: function(data){
                      //console.log(data);
                      location.reload();
                    }
                });
            }
        });




   $('#user').change(function() {

        url="/manage-permissions/user-permissions-load";
        user=document.getElementById('user').value;
         //console.log(user);
       $.get(url,{user:user},function(data,status){
        jsonData = JSON.parse(data);
             //console.log(status);
             //console.log(jsonData[0]);

             //console.log('Done');
           var html1="";
           var x=[];
           html1 +="<h4>Privilege</h4>"
            if (jsonData.length >0) {
             //console.log(jsonData.permissions.length);
                 //console.log(jsonData[0]);
                   html1 +="<input hidden='hidden' name='userId' value='"+jsonData[0].id+"'/>";

                    for (var i = 0; i < jsonData[0].permissions.length; i++) {
                      //console.log(jsonData[0].permissions[i].permission_slug);
                        x.push(jsonData[0].permissions[i].permission_name)
                            html1 += "<input class='checkbox-inline col-sm-1' type='checkbox' name='permission[]' checked value='" + jsonData[0].permissions[i].id + "'>"  +"<label class='col-sm-3'>"+jsonData[0].permissions[i].permission_name +"</label>";
                    }
             //console.log(x)
            for (var i = 0; i < jsonData[1].length; i++) {
                 //console.log(x.indexOf(jsonData[1][i].permission_slug));
                 if(x.indexOf(jsonData[1][i].slug)==-1){
                     //console.log(jsonData[1][i].permission_slug)
                    html1 += "<input class='checkbox-inline col-sm-1' type='checkbox' name='permission[]' value='" + jsonData[1][i].id + "'>" +"<label class='col-sm-3'>"+jsonData[1][i].permission_name +"</label> </td></tr></table>";

                 }
            }

                    // console.log("<option value='" + jsonData[i].areas_type_id + "'>" + jsonData[i].name + "</option>");
                }
             else {
                html1 += "<td><option>-Empty-</option></table>";
            }
             //console.log(html1)
            $('#permission').html(html1);
       });
    });

$('#role').change(function() {
        url="/manage-permissions/role-permissions-load";
        role=document.getElementById('role').value;
       //console.log(role);
       $.get(url,{role:role},function(data,status){
        jsonData=JSON.parse(data);
           //console.log(jsonData[1][1].permission_slug);
           var html1="";
           var x=[];
           html1+="<h4>Privilege</h4>"
            if (jsonData.length >0) {
            // console.log(jsonData.permissions.length);
             //console.log(jsonData[0].permissions.length);
                // console.log('hapa');


                    for (var i = 0; i < jsonData[0].permissions.length; i++) {
                        x.push(jsonData[0].permissions[i].permission_name)

                            html1 += "<input class='checkbox-inline col-sm-1' type='checkbox' name='permission[]' checked value='" + jsonData[0].permissions[i].id + "'>" +"<label class='col-sm-3'>"+jsonData[0].permissions[i].permission_name +"</label> ";
                    }
             //console.log(x)
            for (var i = 0; i < jsonData[1].length; i++) {
                 //console.log(x.indexOf(jsonData[1][i].permission_name));
                 if(x.indexOf(jsonData[1][i].permission_name)==-1){
                    // console.log(jsonData[1][i].permission_name)
                    html1 += "<input class='checkbox-inline col-sm-1' type='checkbox' name='permission[]' value='" + jsonData[1][i].id + "'>" +"<label class='col-sm-3'>"+jsonData[1][i].permission_name +"</label>";

                 }
            }

                    //console.log("<option value='" + jsonData[i].areas_type_id + "'>" + jsonData[i].permission_name + "</option>");
                }
             else {
                html1 += "<option>-Empty-</option>";
            }
            // console.log(html1)
            $('#permission').html(html1);
       });
    });

});


function reloadData(){
  setTimeout(function() {
        loadRequest();
        loadAddPrice();
        reloadData();
    }, 2000);
}


function loadRequest(){
  //console.log('Leo ni leo');
  $.ajax({
        url:"/requestedProduct/loadRequest",
        success: function(data){
        requestData = JSON.parse(data);
        //console.log(requestData);
        $("#requestCountSpan").empty();
        if (requestData[0].request_count == 0) {
          $("#requestCountSpan").empty();
        } else {
          $("#requestCountSpan").append(requestData[0].request_count);
        }
      }
    });
}



function loadAddPrice(){
  //console.log('Itagoma sasa');
  $.ajax({
        url:"/add-product-price/loadPrice",
        success: function(data){
        addPriceData = JSON.parse(data);
        //console.log(addPriceData);
        $("#addPriceSpan").empty();
        if (addPriceData[0].addPriceCount == 0) {
          $("#addPriceSpan").empty();
        } else {
          $("#addPriceSpan").append(addPriceData[0].addPriceCount);
        }
      }
    });
}
