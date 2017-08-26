<table class="table table-bordered table-hover table-striped table-condesed" id="student_info_table">
    <caption>{{ $classes[0]->program }}</caption>
    <thead>
        <tr>
            <td>#</td>
            <td>Student Id</td>
            <td>Name</td>
            <td>Sex</td>
            <td>Birth Date</td>
        </tr>
    </thead>
    <tbody>
        @foreach($classes as $key => $class)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ sprintf("%05d",$class->student_id) }}</td>
                <td>{{ $class->name }}</td>
                <td>{{ $class->sex }}</td>
                <td>{{ $class->dob }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('#student_info_table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>