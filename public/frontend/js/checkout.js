$(document).ready(function(){
    $('.razorpay-btn').click(function(e){
        e.preventDefault();
        
        var fname=$('.fname').val();
        var lname=$('.lname').val();
        var email=$('.email').val();
        var phone=$('.phone').val();
        var address1=$('.address1').val();
        var address2=$('.address2').val();
        var city=$('.city').val();
        var state=$('.state').val();
        var country=$('.country').val();
        var pincode=$('.pincode').val();
      
        if(!fname){
            fname_err="First Name is required.";
            $('#fname_err').html(fname_err);
        }else{
            fname_err='';
            $('#fname_err').html('');
        }
        if(!lname){
            lname_err="last Name is required.";
            $('#lname_err').html(lname_err);
        }else{
            lname_err='';
            $('#lname_err').html('');
        }
        if(!email){
            email_err="Email is required.";
            $('#email_err').html(email_err);
        }else{
            email_err='';
            $('#email_err').html('');
        }
        if(!phone){
            phone_err="Phone no is required.";
            $('#phone_err').html(phone_err);
        }else{
            phone_err='';
            $('#phone_err').html('');
        }
        if(!address1){
            add1_err="Address1 is required.";
            $('#add1_err').html(add1_err);
        }else{
            add1_err='';
            $('#add1_err').html('');
        }
        if(!address2){
            add2_err="Address2 is required.";
            $('#add2_err').html(add2_err);
        }else{
            add2_err='';
            $('#add2_err').html('');
        }
        if(!city){
            city_err=" City is required.";
            $('#city_err').html(city_err);
        }else{
            city_err='';
            $('#city_err').html('');
        }
        if(!state){
            state_err="State is required.";
            $('#state_err').html(state_err);
        }else{
            state_err='';
            $('#state_err').html('');
        }
        if(!country){
            country_err="Country is required.";
            $('#country_err').html(country_err);
        }else{
            country_err='';
            $('#country_err').html('');
        }
        if(!pincode){
            pincode_err="pincode is required.";
            $('#pincode_err').html(pincode_err);
        }else{
            pincode_err='';
            $('#pincode_err').html('');
        }
        
       if(fname_err !='' || lname_err !='' || email_err !='' || phone_err !=''|| add1_err !=''|| add2_err !=''|| city_err !=''|| state_err !=''|| country_err !=''|| pincode_err !='')
        {
            
        return false;
        }else{
          
            
            $.ajax({
                type: "POST",
                url: "/proceed-to-pay",
                data: {
                    'fname':fname,
                    'lname':lname,
                    'email':email,
                    'phone':phone,
                    'address1':address1,
                    'address2':address2,
                    'city':city,
                    'state':state,
                    'country':country,
                    'pincode':pincode,
                
                },
               
                success: function (response) {
                    
                }
            });
         }
    });
});