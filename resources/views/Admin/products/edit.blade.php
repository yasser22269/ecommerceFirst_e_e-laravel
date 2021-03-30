@extends('layouts.admin')
@section('title','products  Edit')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">


   <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/'. getFolder() .'/plugins/file-uploaders/dropzone.css')}}">


@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">products </h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Products.index') }}">products </a>
            </li>
            <li class="breadcrumb-item active">products  Edit
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="card-content">
    <div class="card-body">
      <ul class="nav nav-tabs nav-top-border no-hover-bg">
        <li class="nav-item">
          <a class="nav-link active" id="base-tab11" data-toggle="tab" aria-controls="tab11" href="#tab11" aria-expanded="true">General</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="base-tab12" data-toggle="tab" aria-controls="tab12" href="#tab12" aria-expanded="false">Special Price</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="base-tab13" data-toggle="tab" aria-controls="tab13" href="#tab13" aria-expanded="false">Image</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="base-tab14" data-toggle="tab" aria-controls="tab14" href="#tab14" aria-expanded="false">Stoke</a>
          </li>
      </ul>
      <div class="tab-content px-1 pt-1">
        <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true" aria-labelledby="base-tab11">
            <form class="form" method="POST" action="{{ route('Products.update',$Products->id) }}">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">General Product Info</h4>
                  <input type="hidden"  name="id" value="{{ $Products->id }}">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">Slug</label>
                        <input type="text" id="projectinput1" class="form-control" placeholder="slug" name="slug" value="{{ $Products->slug }}">
                        @error('slug')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                  </div>
                  <div class="row">

                    @foreach($Products->translations as $ProductNameName)


                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">Name:{{  $ProductNameName->locale }}</label>
                          <input type="text" id="projectinput2" class="form-control" placeholder="{{  $ProductNameName->locale }}Name" name="{{  $ProductNameName->locale }}[name]" value="{{  $ProductNameName->name }}">
                        </div>
                          @error("$ProductNameName->locale.name")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>


                    @endforeach

                  </div>

                  <div class="row">

                    @foreach($Products->translations as $ProductNameName)


                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">description:{{  $ProductNameName->locale }}</label>

                          <textarea  name="{{  $ProductNameName->locale }}[description]" id="description"
                            class="form-control"
                            placeholder=" description"
                                >{{  $ProductNameName->description }}</textarea>
                        </div>
                          @error("$ProductNameName->locale.description")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>


                    @endforeach

                  </div>
                  <div class="row">

                    @foreach($Products->translations as $ProductNameName)


                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">short description:{{  $ProductNameName->locale }}</label>

                          <textarea  name="{{  $ProductNameName->locale }}[short_description]" id="short_description"
                          class="form-control"
                          placeholder="short description"
                              >{{  $ProductNameName->short_description }}</textarea>
                        </div>
                          @error("$ProductNameName->locale.short_description")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>


                    @endforeach

                  </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="projectinput1"> Price
                            </label>
                            <input type="number" id="price"
                                   class="form-control"
                                   placeholder="price"
                                   value="{{ $Products->price }}"
                                   name="price">
                            @error("price")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row" >
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="projectinput1"> اختر القسم
                            </label>
                            <select name="categories[]" class="select2 form-control" multiple>
                                <optgroup label="من فضلك أختر القسم ">

                                    @if($categories && $categories -> count() > 0)
                                        @foreach($categories as $category)
                                            <option
                                            @foreach($Products->category as $Productcategory)
                                            {{ ($category->id == $Productcategory->id) ? "selected" : ''}}
                                             @endforeach
                                                value="{{$category->id }}">{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            </select>
                            @error('categories.0')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="projectinput1"> اختر ألعلامات الدلالية
                            </label>
                            <select name="tags[]" class="select2 form-control" multiple>
                                <optgroup label=" اختر ألعلامات الدلالية ">

                                    @if($tags && $tags -> count() > 0)
                                        @foreach($tags as $tag)
                                            <option
                                            @foreach($Products->tags as $Producttags)
                                            {{ ($tag->id == $Producttags->id) ? "selected" : ''}}
                                            @endforeach

                                                value="{{$tag->id }}">{{$tag->name}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            </select>
                            @error('tags')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="projectinput1"> اختر ألماركة
                            </label>
                            <select name="brand_id" class="select2 form-control">
                                <optgroup label="من فضلك أختر الماركة ">

                                    @if($brands && $brands -> count() > 0)
                                        @foreach($brands as $brand)
                                            <option
                                            {{ ($brand->id == $Products->brand_id) ? "Selected" : ''}}
                                                value="{{$brand->id }}">{{$brand->name}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            </select>
                            @error('brand_id')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>


                  <div class="row">
                    <div class="col-md-12">
                            <label for="switcheryColor4"
                                   class="card-title ">Status </label>
                            <input type="checkbox" value="1"
                                   name="is_active"
                                    {{ $Products ->is_active == 1 ? 'checked': ""}}
                                   id="switcheryColor4"
                                   class="switchery" data-color="success"
                                   />

                            @error("is_active")
                            <span class="text-danger">{{$message }}</span>
                            @enderror
                        </div>



                  </div>

                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Save
                  </button>
                </div>
              </form>




        </div>
      </div>
        <div class="tab-pane" id="tab12" aria-labelledby="base-tab12">
            <form class="form" method="POST" action="{{ route('Products.Priceupdate',$Products->id) }}">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">Price Product Info</h4>
                  <input type="hidden"  name="product_id" value="{{ $Products->id }}">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> سعر  المنتج
                            </label>
                            <input type="number" id="price"
                                   class="form-control"
                                   placeholder="  "
                                   value="{{ $Products->price }}"
                                   name="price" disabled>
                            @error("price")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                {{-- <hr> --}}
                <h1 class="form-section"> عرض خاص</h1>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> سعر خاص
                            </label>
                            <input type="number"
                                   class="form-control"
                                   value="{{ $offer->special_price  ?? old('special_price') }}"
                                   name="special_price">
                            @error("special_price")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1">نوع السعر
                            </label>
                            <select name="special_price_type" class=" form-control" >
                                <optgroup label="من فضلك أختر النوع ">
                                    <option></option>
                                    <option value="percent" {{ $offer->special_price_type =="percent" ? "Selected" : '' }}>precent</option>
                                    <option value="fixed"  {{ $offer->special_price_type =="fixed" ? "Selected" : '' }}>fixed</option>
                                </optgroup>
                            </select>
                            @error('special_price_type')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>


                </div>


                <div class="row" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> تاريخ البداية
                            </label>

                            <input type="date"
                                   class="form-control"
                                   value="{{ $offer->special_price_start ??
                                   $offer->special_price_start  }}"
                                   name="special_price_start"
                                   >
                           {{-- {{ $offer->special_price_start ?? date_format($offer->special_price_start ,'Y-m-d') }} --}}
                            @error('special_price_start')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> تاريخ البداية
                            </label>
                            <input type="date"
                                   class="form-control"
                                   value="{{ $offer->special_price_end ??
                                    $offer->special_price_end }}"
                                   name="special_price_end">
                                   {{-- {{ $offer->special_price_end ??
                                    date_format($offer->special_price_end ,'Y-m-d' )  }} --}}
                            @error('special_price_end')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Save
                  </button>
                </div>
              </form>




          </div>
    </div>
        <div class="tab-pane" id="tab13" aria-labelledby="base-tab13">
            <form
            action="{{route('Products.imageupdate.db',$Products->id)}}"
            method="POST" enctype="multipart/form-data" >
          @csrf
{{-- class="form" --}}
          <input type="hidden" name="product_id" value="{{$Products->id}}">


                        <h4 class="form-section"><i class="ft-image"></i> اداره الصور   </h4>


                            <div class="form-body">

                                <div class="form-group form">
                                    <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                        <div class="dz-message" style="position: sticky;">يمكنك رفع اكثر من صوره هنا</div>
                                    </div>
                                    <br><br>
                                </div>


                            </div>



                    <div class="form-actions">

                        <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> تحديث
                        </button>
                    </div>
        </form>







        <div class="row">
            @foreach ($Products->Images as  $Product)
            <div class="col-md-3" style="margin-bottom: 20px">

            <form action="{{route('admin.products.imagedeleteId',$Product->id)}}"
            method="POST" enctype="multipart/form-data" >
              @csrf

          <input type="hidden" name="id" value="{{$Product->id}}">
{{-- asset('images/products/'.$Product->photo )  --}}
                    <img src="{{ $Product->photo}}" alt="" width="150px" style="border-style: dashed;" >

                    <input type="hidden" name="photo" value="{{ $Product->photo }}">

                <button type="submit" class="btn btn-danger" style="width: 150px;">
                   حذف
                </button>
            </form>
           </div>
            @endforeach

        </div>


        </div>

    <div class="tab-pane" id="tab14" aria-labelledby="base-tab14">

        <form class="form"
            action="{{route('Products.stockupdate',$Products->id)}}"
            method="POST" >
          @csrf

          <input type="hidden" name="id" value="{{$Products->id}}">


                        <h4 class="form-section"><i class="ft-home"></i> اداره المستودع   </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> كود  المنتج
                                    </label>
                                    <input type="text" id="sku"
                                            class="form-control"
                                            placeholder="  "
                                            value="{{$ManageStock->sku}}"
                                            name="sku">
                                    @error("sku")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">حالة المنتج
                                    </label>
                                    <select name="in_stock" class="form-control" >

                                            <option {{($ManageStock->in_stock) ==0 ? "Selected " :'' }}value="0">غير متاح </option>
                                            <option {{($ManageStock->in_stock) ==1 ? "Selected " :'' }}value="1">متاح</option>


                                    </select>
                                    @error('in_stock')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- QTY  -->



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">تتبع المستودع
                                    </label>
                                    <select name="manage_stock" class="form-control" id="manageStock">
                                            <option  {{($ManageStock->manage_stock) ==0 ? "Selected " :'' }}value="0" >عدم اتاحه التتبع</option>
                                            <option {{($ManageStock->manage_stock) ==1 ? "Selected " :'' }}value="1">اتاحة التتبع</option>


                                    </select>
                                    @error('manage_stock')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6" style="{{($ManageStock->manage_stock) ==0 ? 'display:none;' :'' }} "  id="qtyDiv">
                                <div class="form-group">
                                    <label for="projectinput1">الكمية
                                    </label>
                                    <input type="text" id="sku"
                                            class="form-control"
                                            placeholder="  "
                                            value="{{$ManageStock->qty}}"
                                            name="qty">
                                    @error("qty")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>



                    <div class="form-actions">

                        <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> تحديث
                        </button>
                    </div>
        </form>
    </div>
      </div>
    </div>
  </div>


      {{-- <div class="card">
          <div class="container">
            </div>
         </div> --}}


         @endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script src="{{asset('/')}}app-assets/js/scripts/navs/navs.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $(".select2").select2();
        });
</script>
{{-- stock --}}
<script>
    $(document).on('change','#manageStock',function(){
       if($(this).val() == 1 ){
            $('#qtyDiv').show();
       }else{
           $('#qtyDiv').hide();
       }
    });
</script>

{{-- image --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.js"defer></script> --}}
<script src="{{asset('/')}}app-assets/js/scripts/extensions/dropzone.js" type="text/javascript"></script>
<script src="{{asset('app-assets/vendors/js/extensions/dropzone.min.js')}}" type="text/javascript"></script>
<script>
    var uploadedDocumentMap = {}
   Dropzone.options.dpzMultipleFiles = {
       paramName: "dzfile", // The name that will be used to transfer the file
       //autoProcessQueue: false,
       maxFilesize: 5, // MB
       clickable: true,
       addRemoveLinks: true,
       acceptedFiles: 'image/*',
       dictFallbackMessage: " المتصفح الخاص بكم لا يدعم خاصيه تعدد الصوره والسحب والافلات ",
       dictInvalidFileType: "لايمكنك رفع هذا النوع من الملفات ",
       dictCancelUpload: "الغاء الرفع ",
       dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
       dictRemoveFile: "حذف الصوره",
       dictMaxFilesExceeded: "لايمكنك رفع عدد اكثر من هضا ",
       headers: {
           'X-CSRF-TOKEN':
               "{{ csrf_token() }}"
       }

       ,
       url: "{{ route('Products.imageupdate') }}", // Set the url
       success:
           function (file, response) {
               $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
               uploadedDocumentMap[file.name] = response.name
           }
       ,
       removedfile: function (file) {
        file.previewElement.remove();
        var name = '';
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name;
        } else {
            name = uploadedDocumentMap[file.name];
        }
        $('form').find('input[name="document[]"][value="' + name + '"]').remove();
        // Add this code in removedfile dropzone
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.products.images.delete') }}',
            data: {
                fileName: name
            },
            dataType: 'html',
            headers: {
                'X-CSRF-TOKEN':
                    "{{ csrf_token() }}"
            },
            success: function(data){
                var rep = JSON.parse(data);
            }
        });
    },
       // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
       init: function () {

               @if(isset($event) && $event->document)
           var files =
           {!! json_encode($event->document) !!}
               for (var i in files) {
               var file = files[i]
               this.options.addedfile.call(this, file)
               file.previewElement.classList.add('dz-complete')
               $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
           }
           @endif
       }
   }


</script>

@endsection
