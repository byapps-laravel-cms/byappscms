formData = new FormData();
formData.append('test','test');
var temp;
function asdf(){
    temp = $('form').request('onTest', {
        success: function(data) {
            console.log(data.result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText)
        }
    })
    return null;
}