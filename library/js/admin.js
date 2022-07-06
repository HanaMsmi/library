function edit(id){
    document.getElementById("info").style.display = "block";
    document.getElementById("add-info").innerHTML = "ویرایش";
    document.getElementById("info_id").value = id;
    document.getElementById("info_name").value = document.getElementById("card_name_"+id).innerHTML;
    document.getElementById("info_image1").value = document.getElementById("card_image1_"+id).src;
    document.getElementById("info_type").value = document.getElementById("card_type_"+id).innerHTML;
    document.getElementById("info_publisher").value = document.getElementById("card_publisher_"+id).innerHTML;
    document.getElementById("info_author").value = document.getElementById("card_author_"+id).innerHTML;
    document.getElementById("info_code").value = document.getElementById("card_code_"+id).innerHTML;
    document.getElementById("info_stock").value = document.getElementById("card_stock_"+id).innerHTML;
    document.getElementById("info_cost").value = document.getElementById("card_cost_"+id).innerHTML;
    document.getElementById("info_description").value = document.getElementById("card_description_"+id).innerHTML;
}

function add(){
    document.getElementById("info").style.display = "block";
    document.getElementById("add-info").innerHTML = "اضافه کردن";
    document.getElementById("info_id").value = 0;
}