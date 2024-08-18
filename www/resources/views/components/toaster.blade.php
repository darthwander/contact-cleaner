@props([
    'status',
    'msg'
])

<script>
    toastr.options = {
        "progressBar": true,
        "closeButton": true,
    }
    toastr.{{ $status }}(" {{ $msg }} ")
</script>

