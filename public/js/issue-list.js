$(document).ready(function () {
    
    let targetsArray = [0, 3];
    
    $listIssue = $('#listIssue');
    $listIssue.find('th').length > 5 ? targetsArray.push(5) : '';
    
    $listIssue.DataTable({
        "aaSorting"    : [[1, "asc"]],
        "pageLength"   : 3,
        "lengthMenu"   : [[3, 10, 20, -1], [3, 10, 20, 'All']],
        "bLengthMenu"  : false,
        "bLengthChange": true,
        "searching"    : false,
        "stateSave"    : true,
        "pagingType"   : "simple_numbers",
        "columnDefs"   : [{
            "targets"  : targetsArray,
            "orderable": false
        }]
    });
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#issue-preview').attr('src', e.target.result);
            };
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
    
    $("#image[type='file']").change(function () {
        readURL(this);
    });
});