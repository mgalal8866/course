<div>
    <form wire:submit.prevent='save' enctype="multipart/form-data">

    <div class="mb-1 col-md-12">
        <label class="form-label" for="summernote">Summernote Editor</label>
        <x-summernote wire:model='summernote' name="summernote" id="summernote" />
        @error('summernote')
        <span class="error" style="color: red">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-1 col-md-12">
        <label class="form-label" for="ck">CkEditor</label>
        <x-ck wire:model='ck' name="ck" id="ck" />
        @error('ck')
        <span class="error" style="color: red">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-1 col-md-12">
        <label class="form-label" for="ammath">ammath </label>
        <x-sammath wire:model='ammath' name="ammath" id="ammath" />
        @error('ammath')
        <span class="error" style="color: red">{{ $message }}</span>
        @enderror
    </div>
    <div class="card-footer">
        <button wire:loading.attr="disabled" type="submit" class="btn btn-success btn-submit">حفظ</button>
    </div>
</form>
</div>
