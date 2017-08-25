<div id="demo{{ $key }}" class="accordian-body collapse {{ $key==0 ? 'in' : null }}">
    <table>
        <thead>
            <tr>
                <th style="text-align: center;">#</th>
                <th>Transaction Date</th>
                <th>Cashier</th>
                <th>Paid ($)</th>
                <th>Remark</th>
                <th>Description</th>
                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($readStudentTransaction as $key => $studentTransaction)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $studentTransaction->transact_date }}</td>
                <td>{{ $studentTransaction->name }}</td>
                <td>{{ number_format($studentTransaction->paid, 2) }}</td>
                <td>{{ $studentTransaction->remark }}</td>
                <td>{{ $studentTransaction->description }}</td>
                <td style="text-align: center; width: 112px;">
                    <a href="#" class="btn btn-success btn-xs"><i class="fa fa-edit" title="Edit"></i></a>
                    <a href="{{ route('deleteTransaction', $studentTransaction->transact_id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i></a>
                    <a href="{{ route('printInvoice', $studentTransaction->receipt_id) }}" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-print" title="Print"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>