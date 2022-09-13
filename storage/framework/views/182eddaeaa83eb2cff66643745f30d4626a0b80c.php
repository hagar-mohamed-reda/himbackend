<?php echo $__env->make("services.print", ['name' => $template->name], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript" src="<?php echo e(url('/js/jquery-3.2.1.min.js')); ?>" ></script>
<script>

    function toggleModal(action) {
        var modal = document.getElementById('printModal');

        modal.style.display = action=='show'? 'block' : 'none';
    }

    function printPage() {
        toggleModal('hide');
        window.print();
    }

</script>
<?php /**PATH /home/pnpskkmy/public_html/him/resources/views/services/footer.blade.php ENDPATH**/ ?>