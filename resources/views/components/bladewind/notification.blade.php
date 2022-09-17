@props([
    // where do you want the notification displayed
    // available options are top right, top left, bottom right, bottom left
    // top center, bottom center
    'type' => 'success',
    'icon' => [
        'success'=>'M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z',
        'error' => 'M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 ',
    ],
    'colors' => [
        'success'=>'-green-',
        'error'=>'-red-',
    ],
    'position' => 'top right',
    'position_css' => [
        'top_right' => 'right-4 top-10',
        'right_top' => 'right-4 top-10',
        'top_left' => 'left-4 top-10',
        'left_top' => 'left-4 top-10',
        'bottom_right' => 'right-4 bottom-10',
        'right_bottom' => 'right-4 bottom-10',
        'bottom_left' => 'left-4 bottom-10',
        'left_bottom' => 'right-4 bottom-10',
        'top_center' => 'top-10', //FIXME::
        'center_top' => 'top-10',
        'bottom_center' => 'bottom-10', //FIXME::
        'center_bottom' => 'bottom-10',
    ]
])
<div class="fixed {{ $position_css[str_replace(' ', '_', $position)] }} z-50 hidden border-2 bw-notification bg-white shadow-lg p-4 rounded-lg w-11/12 sm:w-1/4">
    <div class="flex justify-start items-start gap-2">
        <div class="alert-icon flex items-center border-2 border{{$colors[$type]}}500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
				<span class="text{{$colors[$type]}}500">
					<svg fill="currentColor"
                         viewBox="0 0 20 20"
                         class="h-6 w-6">
						<path fill-rule="evenodd"
                              d="{{$icon[$type]}}"
                              clip-rule="evenodd"></path>
					</svg>
				</span>
        </div>
        <div class="flex-grow pb-1 pr-4 relative">
            <h1 class="font-semibold text{{$colors[$type]}}500 title"></h1>
            <div class="pt-1 text-sm !text-gray-600 message"></div>
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 absolute -right-1 cursor-pointer -top-1 text-gray-400 hover:bg-gray-200 p-1"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" onclick="hideNotification()">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
    </div>
</div>
<script>
    showNotification = (
        title='',
        message='',
        type='success',
        dismiss_in=10) => {
        let border_color = {
            "success" : "border-green-400/80",
            "error" : "border-red-400/80",
            "warning" : "border-yellow-400/80",
            "info" : "border-blue-400/80",
        };
        let dismiss_in_seconds = (dismiss_in*1000);
        dom_el('.bw-notification .title').innerText = title;
        dom_el('.bw-notification .message').innerHTML = message;
        changeCss('.bw-notification', `${border_color.success}, ${border_color.error}, ${border_color.info}, ${border_color.warning}`, 'remove');
        changeCss('.bw-notification', eval(`border_color.${type}`));
        changeCssForDomArray('.modal-icon', 'hidden');  // hide all modal icons
        unhide(`.bw-notification .modal-icon.${type}`); // show only the relevant modal icon
        animateCSS('.bw-notification','fadeInRight').then((message) => {
            setTimeout(function(){
                hideNotification();
            }, dismiss_in_seconds);
         });
    }

    hideNotification = function (){
        animateCSS('.bw-notification','fadeOutRight').then((message) => { hide('.bw-notification'); });
    }
</script>
