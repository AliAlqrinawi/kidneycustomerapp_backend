<button class="btn btn-primary  font-medium d-flex 
                        align-items-center
                        justify-content-center {{@$other_class}}" type="{{@$type_button ? $type_button : 'submit'}}"
    id="btn_submit">
    <div class="spinner-border  ml-2" style="display:none ;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <span class="px-2">
        {{$btn_submit_text}}
    </span>
</button>