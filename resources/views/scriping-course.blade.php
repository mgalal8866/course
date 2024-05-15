<div>
    {{-- <div wire:loading>

        <x-loading ></x-loading>
    </div> --}}

    <div class="row">
        <button class="btn btn-success" wire:click='getcourse()'>getcourse</button>
        <button class="btn btn-success" wire:click='save()'>Save</button>

    </div>
    <div class="row">

        @if (session()->has('status'))
        <div class="alert alert-success" role="alert"> {{ session('status') ?? '' }}</div>
        @endif


    </div>
    <div class="row">

        <textarea  style="width:100%" rows=3>{{ json_encode( $data ,JSON_UNESCAPED_UNICODE| JSON_PRETTY_PRINT) }}</textarea>
    </div>

</div>
