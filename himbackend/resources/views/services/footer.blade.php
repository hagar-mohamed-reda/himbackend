@include("services.print", ['name' => $template->name])

<script type="text/javascript" src="{{ url('/js/jquery-3.2.1.min.js') }}" ></script>
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
