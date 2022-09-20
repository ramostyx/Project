<x-app-layout>
    <x-slot name="modal">

    </x-slot>


    <div class="flex-col flex gap-2 col-span-2">
        <div class="relative w-[90%] p-6 mx-auto rounded-lg text-gray-700">
            <div class="absolute top-3 right-3">
                <span class="font-semibold">Date: </span>{{$lesson->created_at}}
            </div>
            <h2 class="font-semibold text-3xl mb-5">{{$lesson->title}}</h2>
            <p class="break-words">
                {{$lesson->body}}
            </p>
            <hr class="my-6 border-gray-600/40 rounded-xl" />
            @if($lesson->attachments->first())
                <span class="font-semibold">Attachments:</span>
                @foreach($lesson->attachments as $attachment)
                    <div class="ml-2 w-fit bg-white px-2 py-2.5 rounded-3xl flex justify-start items-center">
                        <a href="{{route('download',$attachment->id)}}">
                            {{$attachment->filename}}
                        </a>
                        <form method="POST" action="{{route('attachment.delete',$attachment->id)}}">
                            @method('DELETE')
                            @csrf
                            <button>
                                <ion-icon  name="close-outline" class="hover:bg-gray-400 rounded-xl"></ion-icon>
                            </button>
                        </form>
                    </div>
                @endforeach
                <hr class="my-6 border-gray-600/40" />
            @endif
            @if($lesson->comments->first())
                <span class="font-semibold">Comments:</span>
                @foreach($lesson->comments as $comment)
                    <div class="mt-2 p-4 relative rounded-lg  border-white bg-white border-2">
                        <div class="flex flex-wrap w-full justify-between items-center">
                            <div>
                                <span class="font-bold">{{$comment->user->fullName()}}:</span>
                                {{$comment->body}}
                            </div>
                            <div class="absolute top-1.5 bottom-1.5 right-2">
                                <form action="{{route('lesson.comment.delete',$comment->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-none" >
                                        <ion-icon name="trash-outline" class="p-3 text-lg hover:bg-red-100 hover:text-red-400 rounded-lg"></ion-icon>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                <hr class="my-6 border-gray-600/40" />
            @endif

            <form action="{{route('lesson.comment.post',$lesson->id)}}" method="POST" class="flex gap-2">
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

        </div>

    </x-slot>
</x-app-layout>


