@if ($errors->any())
    <x-bladewind.notification type="error" />
    <script>
        @foreach ($errors->all() as $error)
            @if($error == 'The designation has already been taken.')
                showNotification('Whoops! Something went wrong.', 'Choose another class name this one is already taken.','error');
            @else
                showNotification('Whoops! Something went wrong.', '{{$error}}','error');
            @endif
        @endforeach
    </script>
@endif
