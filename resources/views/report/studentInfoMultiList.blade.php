<table class="table table-bordered table-hover table-striped table-condesed" id="student_info_multi_table">
    <thead>
    <tr>
        <td>#</td>
        <td>Student Id</td>
        <td>Name</td>
        <td>Sex</td>
        <td>Birth Date</td>
        <td>Program</td>
        <td>Level</td>
        <td>Shift</td>
        <td>Time</td>
        <td>Batch</td>
        <td>Group</td>
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
            <td>{{ $class->program }}</td>
            <td>{{ $class->level }}</td>
            <td>{{ $class->shift }}</td>
            <td>{{ $class->time }}</td>
            <td>{{ $class->batch }}</td>
            <td>{{ $class->group }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('#student_info_multi_table').DataTable({
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