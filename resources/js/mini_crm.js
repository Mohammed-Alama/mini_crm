$(document).ready(function () {
    $('#company-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "companies",
        columns: [
            {
                "name": 'ID',
                "data": 'id',
                "title": "ID",
                "orderable": true,
                "searchable": true
            },
            {
                "data": 'name',
                "name": 'Name',
                "title": "Name",
                "orderable": true,
                "searchable": true
            },
            {
                "name": 'Email',
                "data": 'email',
                "title": "Email",
                "orderable": true,
                "searchable": true
            },
            {
                "name": "logo",
                "data": "logo",
                "render": function (data) {
                    return '<img src="' + data + '" height="50" alt="company"/>';
                },
                "title": "Logo",
                "orderable": true,
                "searchable": true
            },
            {
                "data": 'website',
                "name": 'Website',
                "title": "Website",
                "orderable": true,
                "searchable": true
            },
            {
                "data": 'action',
                "name": 'Action',
                "title": "Action"
            }
        ]
    });
    //hide session alert
    setTimeout(() => {
        $('#sessionMassage').fadeOut('fast');
    }, 3000);
    //ajax delete button for companies
    $('#destroyCompany').on('click', function (e) {
        e.preventDefault(); // Don't post the form, unless confirmed
        let company_id = $(this).data('id');
        let token = $('meta[name=csrf-token]').attr("content");

        alert('Are you sure to delete ' + company_id);

        $.ajax({
            url: "/companies/" + company_id,
            dataType: "JSON",
            method: 'POST',
            data: {
                '_token': token,
                '_method': 'DELETE',
                'id': company_id
            },
        }).done(function (data) {
            console.log(data.success);
            $('#company-' + company_id).fadeOut('slow').remove();
        }).fail(function (data) {
            console.log(data.failed);
        });
    });
    //ajax delete button for employees
    $('#destroyEmployee').on('click', function (e) {
        e.preventDefault(); // Don't post the form, unless confirmed
        let employee_id = $(this).data('id');
        let token = $('meta[name=csrf-token]').attr("content");

        alert('Are you sure to delete ' + employee_id);

        $.ajax({
            url: "/employees/" + employee_id,
            dataType: "JSON",
            method: 'POST',
            data: {
                '_token': token,
                '_method': 'DELETE',
                'id': employee_id
            },
        }).done(function (data) {
            console.log(data.success);
            $('#employee-' + employee_id).fadeOut('slow').remove();
        }).fail(function (data) {
            console.log(data.failed);
        });
    });


});