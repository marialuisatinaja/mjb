<script src="../assets/js/vendor.min.js"></script>

<!-- knob plugin -->
<script src="../assets/libs/jquery-knob/jquery.knob.min.js"></script>
<script src="{{ asset('admin/assets/js/sweetalert2.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/rt-plugins.js') }}"></script> 
 <script src="{{ asset('admin/assets/js/app.js') }}"></script>

<script>
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
    $('#responsive-datatable').DataTable({
        responsive: true,
        // Additional configurations can be added here
    });
});
</script>
@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const errorMessagesDiv = document.getElementById('error-messages');
        if (errorMessagesDiv) {
            let errorMessageHtml = `
                <div class="alert alert-danger alert-dismissible d-flex align-items-center" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            errorMessagesDiv.innerHTML = errorMessageHtml;

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1800,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "Something went wrong!!"
            });
        }
    });
</script>
@endif

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessageDiv = document.getElementById('success-message');
        if (successMessageDiv) {
            const successMessage = @json(session('success')); // Retrieve the success message from the session

            let successMessageHtml = `
                <div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
                    <div>${successMessage}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            successMessageDiv.innerHTML = successMessageHtml;

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1800,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: successMessage
            });
        }
    });
</script>
@endif