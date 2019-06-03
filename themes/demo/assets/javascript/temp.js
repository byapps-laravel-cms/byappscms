var asdf;
var tdCount = $('#example tr:first-child td').length;
for(var i = 0 ; i < $('#example td').length ; i += tdCount){
    var item = $('#example td a').eq(i);
    var temp = item.text().trim();
    if(temp.length > 30){
        item.text(`${temp.substr(0,28)}...`);
    }
}