

function selectUpdate(id, data , selected) {
    
    var item = $(id);
    item.empty();

    $.each(data, function(key, value){
        
        var strsl = '';
        
        if (selected==value){
             strsl = "selected='selected'"; 
        }

        item.append("<option value='"+ value +"' "+strsl+">"+ key + "</option>");
    });
    
   // item.trigger('change');

}




