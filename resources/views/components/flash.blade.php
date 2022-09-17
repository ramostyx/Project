@if (session('error'))
    <x-bladewind.notification type="error" />
    <script>
        showNotification('Error', '{{session('error')}}','error');
    </script>
@elseif(session('success'))
    <x-bladewind.notification type="success" />
    <script>
        showNotification('Success', '{{session('success')}}','success');
    </script>
@endif
