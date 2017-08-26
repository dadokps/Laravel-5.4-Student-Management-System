<style type="text/css">

    .academic_details {
        white-space: normal;
        width: 400px;
    }

</style>

<table class="table table-hover table-striped table-condensed table-bordered" id="table_class_info">
    <thead>
        <tr>
            <th>Program</th>
            <th>Level</th>
            <th>Shift</th>
            <th>Time</th>
            <th>Academic Detail</th>
            <th hidden="hidden">Action</th>\
            <th>
                <input type="checkbox" id="checkAll">
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($classes as $key => $class)
            <tr>
                <td>{{ $class->program }}</td>
                <td>{{ $class->level }}</td>
                <td>{{ $class->shift }}</td>
                <td>{{ $class->time }}</td>
                <td class="academic_details">
                    <a href="#" data-id="{{ $class->class_id }}" id="edit_class">
                        Program: {{ $class->program }} /
                        Level:   {{ $class->level }} /
                        Shift:   {{ $class->shift }} /
                        Time:   {{ $class->time }} /
                        Batch:   {{ $class->batch }} /
                        Group:   {{ $class->group }} /
                        Start Date:   {{ date("d-M-y", strtotime($class->start_date)) }}  /
                        End Date:   {{ date("d-M-y", strtotime($class->end_date)) }}  /
                    </a>
                </td>
                <td class="text-center" id="hidden">
                    <button value="{{ $class->class_id }}" class="btn btn-danger btn-sm delete_class">Delete</button>
                </td>
                <td>
                    <input type="checkbox" name="checkAll[]" value="{{ $class->class_id }}" class="check_all">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>