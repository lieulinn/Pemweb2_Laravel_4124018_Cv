<script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ url('assets/js/userprofile.js') }}"></script>

@php
    
    /**
     *  Alert
     */
    $message = '';
    $icon = '';
    
    if (!empty($errors->all())) {
        $icon = 'error';
        $message = $errors->first();
    } elseif (session()->has('success')) {
        $icon = 'success';
        $message = session()->get('success');
    } elseif (session()->has('error')) {
        $icon = 'error';
        $message = session()->get('error');
    } elseif (!empty($success)) {
        $icon = 'success';
        $message = $success;
    }
    
@endphp

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 3000
    });
    var message = '{{ $message }}';
    var icon = '{{ $icon }}';
    if (message.length > 0) {
        Toast.fire({
            icon: icon,
            title: message
        });
    }
</script>

<script>
    // Delete Confirmation
    function confirm_form_delete(element) {
        var form = $(element).closest("form");

        Swal.fire({
            title: `Apakah Anda yakin ingin menghapus profil ini?`,
            text: "Jika Anda menghapusnya, data ini akan hilang selamanya.",
            customClass: {
                cancelButton: 'btn btn-danger'
            },
            showCancelButton: true,
            cancelButtonText: 'Batal',
            cancelButtonColor: '#ce4242',
            confirmButtonColor: '#004A99',
            confirmButtonText: `Ya, Hapus`,
            closeOnConfirm: false
        }).then((result) => {

            if (!result.isConfirmed) return;

            jQuery(form).submit();

        });
    }
    
    function saverecord() {
        $("#submitbtn").trigger('click');
    }

    /**
     *  Display Image 
     */
    function display_image(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();
            reader.onload = function(e) {

                $(input).closest('div').find('.box-image-preview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }

    }
</script>
</body>

</html>
