$(document).ready(function (){
   
    loadcount();
    wishCount();
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadcount()
    {
        $.ajax({
            method:"GET",
            url:"/load-cart-data",
            success:function(response){
               $('.cart-count').html('');
               $('.cart-count').html(response.count);
            }
        });

       
    }

    function wishCount()
    {
        $.ajax({
            method:"GET",
            url:"/load-wishlist-data",
            success:function(response){
               $('.wishlist-count').html('');
               $('.wishlist-count').html(response.count);
            }
        });
    }
   
        
    $('.addToCart').click(function(e){
        e.preventDefault();
        var product_id=$(this).closest('.product_data').find('.product_id').val();
        var product_qty=$(this).closest('.product_data').find('.qty-input').val();
       
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method:"POST",
            url:"/add-to-cart",
            data:{
                'product_id':product_id,
                'product_qty':product_qty,
            },
            success: function(response){
                swal(response.status);
            }
        });
        loadcount();
        
    });

    // delete cart item
    $(document).on('click','.delete-cart-item', function () {
        
   
    // $('.delete-cart-item').click(function(){
        var p_id=$(this).closest('.product_data').find('.product_id').val();
        
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method:'POST',
            url:'/d_cartItem',
            data:{
                'prd_id':p_id,
            },
            success:function(response){
                // window.location.reload();
                loadcount();
                $('.cartitem').load(location.href +" .cartitem");
                swal("",response.status,"success");
            }

        });
        
    });
   
   $(document).on('click','.delete-wishlist-item', function () {
    
 
    // $('.delete-wishlist-item').click(function(){
        var p_id=$(this).closest('.product_data').find('.product_id').val();
        
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method:'POST',
            url:'/d_wishItem',
            data:{
                'prd_id':p_id,
            },
            success:function(response){
                // window.location.reload();
                wishCount();
                $('.wishlistitem').load(location.href +" .wishlistitem");
                swal("",response.status,"success");
            }

        });
        
    });
   
    $(document).on('click','.increment-btn', function (e) {
    // $('.increment-btn').click(function (e){
       e.preventDefault();
    //    var inc_val=$('.qty-input').val();
       var inc_val=$(this).closest('.product_data').find('.qty-input').val();
       var value=parseInt(inc_val,10);
       value=isNaN(value) ? 0 : value;
       if(value<10)
       {
        value ++;
        // $('.qty-input').val(value);
        $(this).closest('.product_data').find('.qty-input').val(value);
       }
    });
    $(document).on('click','.decrement-btn', function (e) {
        
   
    // $('.decrement-btn').click(function (e){
       e.preventDefault();
    //    var dec_val=$('.qty-input').val();
       var dec_val=$(this).closest('.product_data').find('.qty-input').val();
       var value=parseInt(dec_val,10);
       value=isNaN(value) ? 0 : value;
       if(value>1)
       {
        value --;
        // $('.qty-input').val(value);
        $(this).closest('.product_data').find('.qty-input').val(value);
       }
    });

     // change cart quantity
     $(document).on('click','.changeQuantity', function (e) {
    
        e.preventDefault();
        var prod_id=$(this).closest('.product_data').find('.product_id').val();
        var prod_qty=$(this).closest('.product_data').find('.qty-input').val();
        
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method:'POST',
            url:'/update_cartQty',
            data:{
                'prd_id':prod_id,
                'prd_qty':prod_qty,
            },
            success:function(response){
                // window.location.reload();
                $('.cartitem').load(location.href +" .cartitem");
              
            }

        });
        
    });
   
    $('.addToWishlist').click(function(e){
        e.preventDefault();
        var prod_id=$(this).closest('.product_data').find('.product_id').val();
        var prod_qty=$(this).closest('.product_data').find('.qty-input').val();
        
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method:'POST',
            url:'/add-to-wishlist',
            data:{
                'prd_id':prod_id,
                'prd_qty':prod_qty,
            },
            success:function(response){
                wishCount();
              swal("",response.status,"success");
              
            }

        });

    });
   

  
});