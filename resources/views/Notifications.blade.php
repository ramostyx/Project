
<x-app-layout>
    <x-slot name="modal">
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        Notifications
                                    </div>

                                    <div class="card-body">
                                            @forelse($notifications as $notification)
                                                <div class="alert alert-success" role="alert">
                                                    {{ $notification->data['firstName'] }} {{ $notification->data['message'] }}.
                                                    <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                                                        Mark as read
                                                    </a>
                                                </div>
                                                @if($loop->last)
                                                    <a href="#" id="mark-all">
                                                        Mark all as read
                                                    </a>
                                                @endif
                                            @empty
                                                There are no new notifications
                                            @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function sendMarkRequest(id = null) {
            return $.ajax("{{ route('markNotification') }}", {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                data: {
                    id,
                }
            });
        }
        $(function() {
            $('.mark-as-read').click(function() {
                let request = sendMarkRequest($(this).data('id'));
                request.done(() => {
                    $(this).parents('div.alert').remove();
                });
            });

            $('#mark-all').click(function() {
                let request = sendMarkRequest();
                request.done(() => {
                    $('div.alert').remove();
                });
            });
        });
    </script>
</x-app-layout>

