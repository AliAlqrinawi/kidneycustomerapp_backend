@php
if(isset($formField->id)){
$id=$formField->id;
}else{
$id=@$formField_id;
}

if(!isset($type)){
$type=$formField->type;
}
   @endphp
<div class="fild">
   <input type="hidden" value="{{$id}}" name="ids[]"/>
   <div class="btn-remove">
      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
         <path id="Icon_material-cancel" data-name="Icon material-cancel" d="M18,3A15,15,0,1,0,31.367,24.822,14.664,14.664,0,0,0,33,18,14.986,14.986,0,0,0,18,3Zm7.5,20.385L23.385,25.5,18,20.115,12.615,25.5,10.5,23.385,15.885,18,10.5,12.615,12.615,10.5,18,15.885,23.385,10.5,25.5,12.615,20.115,18Z" transform="translate(-3 -3)" fill="#cf6c6c"></path>
      </svg>
   </div>
   <div class="form-group m-form__group row mb-25">
      <label for="example-text-input" class="col-2 col-form-label">اسم الحقل
      </label>
      <div class="col-8">
         @if(@$type!='hint')
         <input class="form-control m-input" type="text"  name="names[]"
            value="{{@$formField->name}}"
            placeholder="الاسم " required>
         @else
         <textarea class="form-control summernote_editor_" id="summernote_editor"   name="names[]"
            rows="5">{{@$formField->name}}</textarea>
         @endif
      </div>
   </div>
 
   @if($type=="checkboxs" || $type=='radio' || $type=='select')
   <div class="form-group m-form__group row mb-25">
      <label for="example-text-input" class="col-2 col-form-label">
         <h3>الخيارات </h3>
      </label>
   </div>
   <div class="all_options">
      <div class="options">
         @if(!isset($formField))
         <div class="form-group m-form__group row mb-25 option">
            <label for="example-text-input" class="col-2 col-form-label">الخيار 
            </label>
            <div class="col-8">
               <input class="form-control m-input" type="text"  name="options[{{$id}}][]"
                  value=""
                  placeholder="الاسم " required>
            </div>
         </div>
         @else
         @php
         $options=json_decode($formField->options, true);
         @endphp
         @foreach($options as $option)
         <div class="form-group m-form__group row mb-25 option">
            <label for="example-text-input" class="col-2 col-form-label">الخيار 
            </label>
            <div class="col-8">
               <input class="form-control m-input" type="text"  name="options[{{$id}}][]"
                  value="{{$option}}"
                  placeholder="الاسم " required>
            </div>
         </div>
         @endforeach
         @endif
      </div>
      
      <div class="row">
         <div class="col-12">
            <button class="bg-transparent add-option btn" type="button" data-id="{{$id}}">
               <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                  <g id="Icon_feather-plus" data-name="Icon feather-plus" transform="translate(-6 -6)">
                     <path id="Path_12705" data-name="Path 12705" d="M18,7.5v12" transform="translate(-4.5)" fill="none" stroke="#777" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></path>
                     <path id="Path_12706" data-name="Path 12706" d="M7.5,18h12" transform="translate(0 -4.5)" fill="none" stroke="#777" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></path>
                  </g>
               </svg>
               إضافة
            </button>
         </div>
      </div>
   </div>
   @endif

   <div class="form-group m-form__group row mb-25">
      <label for="example-text-input" class="col-2 col-form-label">نوع الحقل  
      </label>
      <div class="col-8">
         <select class="form-control" name="types[]"   >
            <option value="" disabled >اختر نوع الحقل</option>
            <option value="input" {{isset($formField)?(@$formField->type=='input'?'selected':'') : (@$type=='input'?'selected':'')}}>حقل إدخال</option>
            <option value="textarea" {{isset($formField)?(@$formField->type=='textarea'?'selected':'') : (@$type=='textarea'?'selected':'')}}>حقل نصي</option>
            <option value="checkboxs" {{isset($formField)?(@$formField->type=='checkboxs'?'selected':'') : (@$type=='checkboxs'?'selected':'')}}>متعدد الاجابات</option>
            <option value="radio" {{isset($formField)?(@$formField->type=='radio'?'selected':'') : (@$type=='radio'?'selected':'')}}>أختر من متعدد</option>
            <option value="file" {{isset($formField)?(@$formField->type=='file'?'selected':'') : (@$type=='file'?'selected':'')}}>مرفقات </option>
            <option value="hint" {{isset($formField)?(@$formField->type=='hint'?'selected':'') : (@$type=='hint'?'selected':'')}}>ملاحظة نصية </option>
            <option value="select" {{isset($formField)?(@$formField->type=='select'?'selected':'') : (@$type=='select'?'selected':'')}}>قائمة منسدلة  </option>
         </select>
      </div>
   </div>

   <div class="form-group m-form__group row mb-25">
      <label for="example-text-input" class="col-2 col-form-label">حجم الحقل  
      </label>
      <div class="col-8"  >
         <select class="form-control" name="class_cols[]">
            <option value="" disabled>اختر حجم الحقل</option>
            <option value="col-lg-12" {{isset($formField)?(@$formField->class_col=='col-lg-12'?'selected':'') : ''}}>كامل السطر</option>
            <option value="col-lg-6"  {{isset($formField)?(@$formField->class_col=='col-lg-6'?'selected':'') : 'selected'}}>نصف السطر </option>
            <option value="col-lg-4"  {{isset($formField)?(@$formField->class_col=='col-lg-4'?'selected':'') : ''}}> ثلث السطر</option>
            <option value="col-lg-3"  {{isset($formField)?(@$formField->class_col=='col-lg-3'?'selected':'') : ''}}>ربع السطر</option>
         </select>
      </div>
   </div>

   <div class="form-group m-form__group row mb-25">
      <label for="example-text-input" class="col-8 col-form-label">اختياري/اجباري
      </label>
      <div class="col-2">
         <span class="status" style="float: left"> 
         <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--brand ">
         <label class="mb-0">
         <input type="checkbox" @if(@$formField->required==1) checked  @endif class="chnage_required" >
         <input value='{{@$formField->required}}' type="hidden" class="requireds" name="requireds[]">
         <span></span>
         </label>
         </span>
      </div>
   </div>

</div>