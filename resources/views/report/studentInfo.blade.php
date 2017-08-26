<table class="table table-bordered table-hover table-striped table-condesed">
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