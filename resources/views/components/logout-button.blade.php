@props(['link','title','icon'])
<li {{ $attributes->merge(['class' => 'list']) }}>
    <b></b>
    <b></b>
    <a {{ $attributes }}>
        <span class="icon"><ion-icon name="{{ $icon }}"></ion-icon></span>
        <span class="title">{{ $title }}</span>
    </a>
</li>
