@if( $errors->any() )
<script id="script-target" hx-swap-oob="true">
    const errorsHtml = ${{ json_encode($errors->all()) }}.map(error => `<div>${error}</div>`).join('');
    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        icon: 'error',
        title: 'Errors',
        html: errorsHtml,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
</script>
@endif
