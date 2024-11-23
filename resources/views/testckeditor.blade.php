<div>
    <form wire:submit.prevent='save' enctype="multipart/form-data">


        <div class="mb-1 col-md-12">
            <label class="form-label" for="ck">CkEditor</label>
            <x-ck wire:model='ck' name="ck" id="ck" />
            @error('ck')
                <span class="error" style="color: red">{{ $message }}</span>
            @enderror
        </div>
  
        <div class="card-footer">
            <button wire:loading.attr="disabled" type="submit" class="btn btn-success btn-submit">حفظ</button>
        </div>
    </form>
</div>
