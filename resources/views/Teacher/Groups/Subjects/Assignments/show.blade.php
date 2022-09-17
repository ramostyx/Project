<x-app-layout>
    <x-slot name="modal">

        <x-bladewind.modal
            name="upload-work" size="large" title="Upload Your Work"
            show_action_buttons="false">
            <form method="POST" action="{{route('students.assignments.upload',$assignment->id)}}" enctype="multipart/form-data">
                @csrf
                <x-label for="work" value="Work:" />
                <input
                    name="work"
                    type="file"
                    class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="work"
                />
                <div class="flex items-center justify-end mt-8 ">
                    <x-button class="ml-4" >
                        {{ __('Upload') }}
                    </x-button>
                </div>
            </form>
        </x-bladewind.modal>
    </x-slot>


        <div class="flex-col flex gap-2 col-span-2">
            <div class="relative w-[90%] p-6 mx-auto rounded-lg text-gray-700">
                <div class="absolute top-3 right-3">
                    <span class="font-semibold">Due Date: </span>{{$assignment->dueDate}}
                </div>
                <h2 class="font-semibold text-3xl mb-5">{{$assignment->title}}</h2>
                <p class="break-words">
                    {{$assignment->body}}
                </p>
                <hr class="my-6 border-gray-600/40 rounded-xl" />
                @if($assignment->comments->first())
                    <span class="font-semibold">Comments:</span>
                    @foreach($assignment->comments as $comment)
                        <div class="mt-2 p-2 rounded-lg  border-white bg-white border-2">
                            <div class="flex flex-wrap w-full justify-between items-center">
                                <div>
                                    <span class="font-bold">{{$comment->user->fullName()}}:</span>
                                    {{$comment->body}}
                                </div>
                                <div class="flex gap-2">
                                    <form action="{{route('comment.delete',$comment->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-none" >
                                            <ion-icon name="trash-outline" class="p-4 text-lg hover:bg-red-100 hover:text-red-400 rounded-lg"></ion-icon>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <hr class="my-6 border-gray-600/40" />
                @endif
                <form action="{{route('assignment.comment.post',$assignment->id)}}" method="POST" class="flex gap-2">
                    @csrf
                    <input
                        name="comment"
                        type="text"
                        class="form-control rounded-sm w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="comment"
                        placeholder="Make a Comment"
                    />
                    <div class="flex items-center justify-end mt-2 ">
                        <button class="bg-none" type="submit">
                            <ion-icon name="send-outline" class="p-4 text-lg hover:bg-blue-100 text-blue-700 rounded-lg"></ion-icon>
                        </button>
                    </div>
                </form>
            </div>
        </div>






    <x-slot name="header">
        <div class="flex gap-2">
            <div class="bg-white mb-2 rounded-lg shadow-lg w-fit p-4 ">
                Status: {{$status}}
            </div>
            <button class="bg-none" type="submit" onclick="showModal('upload-work')">
                <ion-icon name="cloud-upload-outline" class="p-4 text-lg hover:bg-blue-100 text-blue-700 rounded-lg"></ion-icon>
            </button>
        </div>

    </x-slot>
</x-app-layout>


