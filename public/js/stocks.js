$(document).ready(function(){
    $('#stocks-table').DataTable({
        serverSide: true,
        processing: true,
        ajax:{
            url:  stock_list,
            type: 'GET',
        },
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50, 75, 100],
        columns: [
            {
                data: 'item_code'
            },
            {
                data: 'item_name'
            },
            {
                data: 'quantity'
            },
            {
                data: 'location'
            },
            {
                data: 'store_name'
            },
            {
                data: 'in_stock_date'
            },
            {
                data: 'stock_no',
                render: function(data, row){
                    return "<a href="+data+"><button type='button' class='btn btn-danger'>X</button></a>"
                }
            },
        ],
        "columnDefs": [
            {
                "className": "text-center",
                "targets": "_all"
            }
        ],
    });
});
