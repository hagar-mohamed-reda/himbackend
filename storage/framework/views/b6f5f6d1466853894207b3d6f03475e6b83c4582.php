
<div class="container">
    <div class="row">
        <div class="text-center">
            الطلاب المتقدمين للمستوى <?php echo e(optional($level)->name); ?> تخصص <?php echo e(optional($division)->name); ?>

        </div>
        <div class="text-center">
            العام الدراسى <?php echo e(optional($academicYear)->name); ?>

        </div>


    </div>
    <br>
    	            <div style="display:none"><?php echo e($variable = 1); ?></div>

    <table id="report3" class="table table-bordered text-center">
        <thead>
            <tr>
                <td>#</td>
                <td>id </td>
                 <td>اسم الطالب </td>
                <td>المؤهل</td>
                <td>سنة المؤهل</td>
                <td>رقم الجلوس</td>
                <td>المجموع</td>
                <td>حالة القيد</td>
                <td>نوع القيد</td>
                <td>رقم الموافقه</td>
                <td>تاريخ الموافقه</td>
                <td>كود الطالب</td>
                <td>الرقم القومي</td>
                <td>المستوي</td>
                <td>التخصص</td>
                <td>رقم الهاتف</td>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($student->id); ?></td>
                <td><?php echo e($student->name); ?></td>
                <td><?php echo e(optional($student->qualification)->name); ?></td>
                <td><?php echo e($student->qualification_date); ?></td>
                <td><?php echo e($student->set_number); ?></td>
                <td><?php echo e($student->toAcademicStudent()->getCurrentRegisterCourseQuery()->sum('student_degree')); ?></td>

                <td><?php echo e(optional($student->constraint_status)->name); ?></td>
                <td><?php echo e(optional($student->case_constraint)->name); ?></td>
                <td><?php echo e($student->acceptance_code); ?></td>
                <td><?php echo e($student->acceptance_date); ?></td>
                <td><?php echo e($student->code); ?></td>
                <td><?php echo e($student->national_id); ?></td>
                <td><?php echo e(optional($student->level)->name); ?></td>
                <td><?php echo e(optional($student->division)->name); ?></td>
                <td><?php echo e($student->phone_1); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<link href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css'>
<link href='https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css'>

//
// <script>

// $(document).ready( function () {
//     $('#report3').DataTable({
//       dom: 'Bfrtip',
//       "sorting": true,
//           buttons: [
//                 'copyHtml5',
//                 'excelHtml5',
//                 'csvHtml5',
//                 'pdfHtml5'
//             ],
//       paging: false,

//   });
// });
    
// </script>
<!--<script src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
<!--<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>-->
<!--<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>--><?php /**PATH F:\company\himback\himbackend\resources\views/report/report3.blade.php ENDPATH**/ ?>