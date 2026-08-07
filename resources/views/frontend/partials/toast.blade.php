@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof showToast === 'function') {
                showToast('{{ addslashes(session('success')) }}', 'success');
            }
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof showToast === 'function') {
                showToast('{{ addslashes(session('error')) }}', 'error');
            }
        });
    </script>
@endif

@if(session('warning'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof showToast === 'function') {
                showToast('{{ addslashes(session('warning')) }}', 'error');
            }
        });
    </script>
@endif

@if(session('info'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof showToast === 'function') {
                showToast('{{ addslashes(session('info')) }}', 'success');
            }
        });
    </script>
@endif

@if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof showToast === 'function') {
                @foreach($errors->all() as $error)
                    showToast('{{ addslashes($error) }}', 'error');
                @endforeach
            }
        });
    </script>
@endif
