@props(['color', 'bgColor' => 'white'])



<div {{ $attributes
    ->merge(['lang' => 'ka'])
    ->class("card card-test-$color card-bg-$bgColor") }} >
    <div {{ $title->attributes->class("card-header") }}>
        {{ $title }}
    </div>
    @if ($slot->isEmpty())
        <P>please provide some content</P>
    @else
        {{ $slot }}
    @endif
    <div class="card-footer">{{ $footer }}</div>
</div>
