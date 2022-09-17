<div class="container">
    <div class="text-left">
        <h4>طبعت بتاريخ 2021/09/07</h4>
    </div>
    <div class="row">
        <div class="text-left col-md-4 col-sm-4 col-xs-4 col-lg-4">
            <h4>العام الدراسي <?php echo e($academicYear->name); ?></h4>
        </div>
        <div class="text-center col-md-4 col-sm-4 col-xs-4 col-lg-4">
            <h2>كشوف عناوين وتليفونات الطلاب</h2>
        </div>

    </div>
    <div class="text-center">
        <p style="display: inline;"><?php echo e($level->name); ?> </p>
        <p style="display: inline; margin-right: 40px;"><?php echo e($division->name); ?></p>
    </div>
    <table id="report2" class="table table-bordered text-center">
        <thead>
            <tr>
                <td>#</td>
                <td>اسم الطالب </td>
                <td>تليفون</td>
                <td>تليفون ولى الامر</td>
                <td>العنوان</td>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($student->name); ?></td>
                <td><?php echo e($student->phone_1); ?></td>
                <td><?php echo e($student->parent_phone); ?></td>
                <td><?php echo e($student->address); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<script>

$(document).ready( function () {
    $('#report2').DataTable({
      dom: 'Bfrtip',
      "sorting": true,
          buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
      paging: true,

  });
});
    
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script><?php /**PATH /home/pnpskkmy/public_html/him/resources/views/report/report2.blade.php ENDPATH**/ ?>