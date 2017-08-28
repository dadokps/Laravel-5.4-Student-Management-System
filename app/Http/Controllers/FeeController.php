<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Academic;
use App\Program;
use App\Level;
use App\Shift;
use App\Time;
use App\Batch;
use App\Group;
use App\MyClass;
use App\Status;
use App\Fee;
use App\Receipt;
use App\Transaction;
use App\StudentFee;
use App\ReceiptDetail;
use App\FeeType;
use Illuminate\Support\Facades\DB;

class FeeController extends Controller
{
    public function getPayment()
    {
        return view('fee.searchPayment');
    }

    public function studentStatus($student_id)
    {
        return Status::latest('statuses.status_id')
                    ->join('students', 'students.student_id', '=', 'statuses.student_id')
                    ->join('classes', 'classes.class_id', '=', 'statuses.class_id')
                    ->join('academics', 'academics.academic_id', '=', 'classes.academic_id')
                    ->join('shifts', 'shifts.shift_id', '=', 'classes.shift_id')
                    ->join('times', 'times.time_id', '=', 'classes.time_id')
                    ->join('groups', 'groups.group_id', '=', 'classes.group_id')
                    ->join('batches', 'batches.batch_id', '=', 'classes.batch_id')
                    ->join('levels', 'levels.level_id', '=', 'classes.level_id')
                    ->join('programs', 'programs.program_id', '=', 'levels.program_id')
                    ->where('students.student_id', $student_id);
    }

    public function showSchoolFee($level_id)
    {
        return Fee::join('academics', 'academics.academic_id', '=', 'fees.academic_id')
            ->join('levels', 'levels.level_id', '=', 'fees.level_id')
            ->join('programs', 'programs.program_id', '=', 'levels.program_id')
            ->join('feetypes', 'feetypes.fee_type_id', '=', 'fees.fee_type_id')
            ->where('levels.level_id', $level_id)
            ->orderBy('fees.amount', 'DESC');
    }

    public function readStudentFee($student_id)
    {
        return StudentFee::join('fees', 'fees.fee_id', '=', 'studentfees.fee_id')
            ->join('students', 'students.student_id', '=', 'studentfees.student_id')
            ->join('levels', 'levels.level_id', '=', 'studentfees.level_id')
            ->join('programs', 'programs.program_id', '=', 'levels.program_id')
            ->select('levels.level_id', 'levels.level', 'programs.program', 'fees.amount as school_fee', 'students.student_id', 'studentfees.s_fee_id', 'studentfees.amount as student_amount', 'studentfees.discount')
            ->where('students.student_id', $student_id);
    }

    public function readStudentTransaction($student_id)
    {
        return ReceiptDetail::join('receipts', 'receipts.receipt_id', '=', 'receiptdetails.receipt_id')
            ->join('students', 'students.student_id', '=', 'receiptdetails.student_id')
            ->join('transactions', 'transactions.transact_id', '=', 'receiptdetails.transact_id')
            ->join('fees', 'fees.fee_id', '=', 'transactions.fee_id')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->where('students.student_id', $student_id);
    }

    public function payment($viewName, $student_id)
    {
        $status = $this->studentStatus($student_id)->first();
        $programs = Program::where('program_id', $status->program_id)->get();
        $levels = Level::where('program_id', $status->program_id)->get();
        $studentfee = $this->showSchoolFee($status->level_id)->first();
        $readStudentFee = $this->readStudentFee($student_id)->get();
        $readStudentTransaction = $this->readStudentTransaction($student_id)->get();
        $feeTypes = FeeType::all();
        $receipt_id = ReceiptDetail::where('student_id', $student_id)->max('receipt_id');

        return view($viewName, compact('status',
            'programs',
            'levels',
            'studentfee',
            'receipt_id',
            'readStudentFee',
            'readStudentTransaction',
            'feeTypes'))
            ->with('student_id', $student_id);
    }

    public function showStudentPayment(Request $request)
    {
        $student_id = $request->student_id;
        return $this->payment('fee.payment', $student_id);
    }

    public function goPayment($student_id)
    {
        return $this->payment('fee.payment', $student_id);
    }

    public function savePayment(Request $request)
    {
        $studentFee  = StudentFee::create($request->all());

        $transaction = Transaction::create([
            'fee_id'        => $request->fee_id,
            'transact_date' => $request->transact_date,
            'user_id'       => $request->user_id,
            'student_id'    => $request->student_id,
            's_fee_id'      => $studentFee->s_fee_id,
            'paid'          => $request->paid,
            'remark'        => $request->remark,
            'description'   => $request->description,
        ]);
        $receipt_id = Receipt::autoNumber();

        ReceiptDetail::create([
            'receipt_id'   => $receipt_id,
            'student_id'   => $request->student_id,
            'transact_id'  => $transaction->transact_id,
        ]);

        return back();
    }

    public function createFee(Request $request)
    {
        if($request->ajax())
        {
            $fee = Fee::create($request->all());
            return response($fee);
        }
    }

    public function pay(Request $request)
    {
        if($request->ajax())
        {
            $studentFee = StudentFee::join('levels', 'levels.level_id', '=', 'studentfees.level_id')
                                    ->join('programs', 'programs.program_id', '=', 'levels.program_id')
                                    ->join('fees', 'fees.fee_id', '=', 'studentfees.fee_id')
                                    ->join('students', 'students.student_id', '=', 'studentfees.student_id')
                                    ->select('levels.level_id',
                                                    'levels.level',
                                                    'programs.program_id',
                                                    'programs.program',
                                                    'fees.fee_id',
                                                    'students.student_id',
                                                    'studentfees.s_fee_id',
                                                    'fees.amount as school_fee',
                                                    'studentfees.amount as student_amount',
                                                    'studentfees.discount')
                                    ->where('studentfees.s_fee_id', $request->s_fee_id)
                                    ->first();

            return response($studentFee);
        }
    }

    public function extraPay(Request $request)
    {
        $transaction = Transaction::create($request->all());

        if(count($transaction) != 0)
        {
            $transaction_id = $transaction->transact_id;
            $student_id = $transaction->student_id;
            $receipt_id = Receipt::autoNumber();

            ReceiptDetail::create(['receipt_id' => $receipt_id, 'student_id' => $student_id, 'transact_id' => $transaction_id]);
            return back();
        }
    }

    public function printInvoice($receipt_id = null)
    {
        $invoice = ReceiptDetail::join('receipts', 'receipts.receipt_id', '=', 'receiptdetails.receipt_id')
                                ->join('students', 'students.student_id', '=', 'receiptdetails.student_id')
                                ->join('transactions', 'transactions.transact_id', '=', 'receiptdetails.transact_id')
                                ->join('fees', 'fees.fee_id', '=', 'transactions.fee_id')
                                ->join('levels', 'levels.level_id', '=', 'fees.level_id')
                                ->join('programs', 'programs.program_id', '=', 'levels.program_id')
                                ->join('users', 'users.id', '=', 'transactions.user_id')
                                ->join('statuses', 'statuses.student_id', '=', 'students.student_id')
                                ->where('receipts.receipt_id', $receipt_id)
                                ->select('students.student_id',
                                    'students.first_name',
                                    'students.last_name',
                                    'students.sex',
                                    'fees.fee_id',
                                    'fees.amount as school_fee',
                                    'transactions.transact_date',
                                    'transactions.paid',
                                    'users.name',
                                    'receipts.receipt_id',
                                    'statuses.class_id',
                                    'transactions.s_fee_id',
                                    'levels.level_id')
                                ->first();

        $status = MyClass::join('levels', 'levels.level_id', '=', 'classes.level_id')
                        ->join('shifts', 'shifts.shift_id', '=', 'classes.shift_id')
                        ->join('times', 'times.time_id', '=', 'classes.time_id')
                        ->join('groups', 'groups.group_id', '=', 'classes.group_id')
                        ->join('batches', 'batches.batch_id', '=', 'classes.batch_id')
                        ->join('academics', 'academics.academic_id', '=', 'classes.academic_id')
                        ->join('programs', 'programs.program_id', '=', 'levels.program_id')
                        ->join('statuses', 'statuses.class_id', '=', 'classes.class_id')
                        ->where('levels.level_id', $invoice->level_id)
                        ->where('statuses.student_id', $invoice->student_id)
                        ->select(DB::raw('CONCAT("Program-", programs.program,
                                        " / Level-", levels.level,
                                        " / Shift-", shifts.shift,
                                        " / Time-", times.time,
                                        " / Group-", groups.group,
                                        " / Batch-", batches.batch,
                                        " / Academic-", academics.academic,
                                        " / Start Date-", classes.start_date,
                                        " / End Date", classes.end_date
                                        ) As detail'))
                        ->first();

        $studentFee = StudentFee::where('s_fee_id', $invoice->s_fee_id)->first();
        $totalPaid  = Transaction::where('s_fee_id', $invoice->s_fee_id)->sum('paid');

        return view('invoice.invoice', compact('invoice', 'status', 'totalPaid', 'studentFee'));

    }

    public function createStudentLevel()
    {
        Status::insert(['student_id' => 17, 'class_id' => 3]);
    }

    public function deleteTransaction($transaction_id)
    {
        Transaction::destroy($transaction_id);
        return back();
    }

    public function showStudentLevel(Request $request)
    {
        $status = MyClass::join('levels', 'levels.level_id', '=', 'classes.level_id')
                        ->join('shifts', 'shifts.shift_id', '=', 'classes.shift_id')
                        ->join('times', 'times.time_id', '=', 'classes.time_id')
                        ->join('groups', 'groups.group_id', '=', 'classes.group_id')
                        ->join('batches', 'batches.batch_id', '=', 'classes.batch_id')
                        ->join('academics', 'academics.academic_id', '=', 'classes.academic_id')
                        ->join('programs', 'programs.program_id', '=', 'levels.program_id')
                        ->join('statuses', 'statuses.class_id', '=', 'classes.class_id')
                        ->where('levels.level_id', $request->level_id)
                        ->where('statuses.student_id', $request->student_id)
                        ->select(DB::raw('CONCAT("Program-", programs.program,
                                                    " / Level-", levels.level,
                                                    " / Shift-", shifts.shift,
                                                    " / Time-", times.time,
                                                    " / Group-", groups.group,
                                                    " / Batch-", batches.batch) As detail'))
                        ->first();

        return response($status);
    }

    public function getFeeReport()
    {
        return view('fee.feeReport');
    }

    public function showFeeReport(Request $request)
    {
        $fees = $this->feeInfo()
            ->select('users.name',
                'students.student_id',
                'students.first_name',
                'students.last_name',
                'fees.amount as school_fee',
                'studentfees.amount as student_fee',
                'studentfees.discount',
                'transactions.transact_date',
                'transactions.paid')
            ->whereDate('transactions.transact_date', '>=', $request->from)
            ->whereDate('transactions.transact_date', '<=', $request->to)
            ->orderBy('students.student_id')
            ->get();
        return view('fee.feeList', compact('fees'));
    }

    public function feeInfo()
    {
        return Transaction::join('fees', 'fees.fee_id', '=', 'transactions.fee_id')
            ->join('students', 'students.student_id', '=', 'transactions.student_id')
            ->join('studentfees', 'studentfees.s_fee_id', '=', 'transactions.s_fee_id')
            ->join('users', 'users.id', '=', 'transactions.user_id');
    }

}
