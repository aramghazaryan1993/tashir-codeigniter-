var tableToExcel = (function () {
    var uri = 'data:application/vnd.ms-excel;base64,',
        template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta charset="UTF-8"></head><body><table>{table}</table></body></html>',
        base64 = function (s) {
            return window.btoa(unescape(encodeURIComponent(s)))
        }, format = function (s, c) {
            return s.replace(/{(\w+)}/g, function (m, p) {
                return c[p];
            })
        }
    return function (table, name, filename) {
        if (!table.nodeType) //table = document.getElementById(table)
            MyTable = $("#"+table);

            
            var tableClone =MyTable.clone();
            //tableClone.find('#payment_date').remove();
            //tableClone.find('#payment_price').remove();
            tableClone.find('.deleteFromExcel').remove();
            tableClone.find('th:last-child').remove();
            tableClone.find('th:last-child').remove();
            tableClone.find('td:last-child').remove();
            tableClone.find('td:last-child').remove();


        var ctx = {
            worksheet: name || 'Worksheet',
            table: tableClone[0].innerHTML
        }
   document.getElementById("dlink").href = uri + base64(format(template, ctx));
            document.getElementById("dlink").download = filename;
            document.getElementById("dlink").click();
    }
})()