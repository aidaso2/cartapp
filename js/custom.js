function addToCart(ip, prod_id) {
    var amount = document.getElementById(prod_id+"-amount").value;
    var currency_id = document.getElementById(prod_id+"-currencies").value;
    $.ajax({
         type: "POST",
         url: '../src/ajax.php',
         data:{
             action:'add_to_cart',
             ip:ip,
             amount:amount,
             currency_id:currency_id,
             id:prod_id
            },
         success:function(html) {
           alert(html);
         }

    });
}

function removeFromCart(row_id) {
    $.ajax({
         type: "POST",
         url: '../src/ajax.php',
         data:{
             action:'remove_from_cart',
             id:row_id
            },
         success:function(html) {
           alert(html);
           location.reload();
         }

    });
    // location.reload(); 
}