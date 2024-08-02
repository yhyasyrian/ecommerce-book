@extends('dashboard.layouts.app')
@section('title','إضافة كتاب')
@section('content')
    <div class="row overflow-x-auto pb-4">
        <div class="col-8 mx-auto">
            <form action="{{routeDashboard('books.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <x-dashboard.input name="title" label="الاسم"/>
                <x-dashboard.input type="textarea" name="description" label="الوصف"/>
                <x-dashboard.input name="isbn" label="الرقم التسلسلي" type="number" min="0"/>
                <x-dashboard.input list="years" name="date_publish" label="سنة النشر" type="number" min="1900" max="2099" />
                <x-dashboard.input name="pages" label="عدد الصفحات" type="number" min="0"/>
                <x-dashboard.input name="copies" label="عدد النسخ" type="number" min="0"/>
                <x-dashboard.input name="price" label="السعر" type="number" min="0.1" step="0.1"/>
                <x-dashboard.input onchange="previewImage(this)" name="thumbnail" label="صورة" type="file" class="form-control-file" />
                <div class="form-group container">
                    <img class="mx-auto w-50" alt="الرجاء وضع صورة للكتاب" id="photoBook">
                </div>
                <x-dashboard.input name="category_id" label="التصنيف" type="select" :options="$categories->map(fn ($category) => [$category->id ,$category->name])"  />
                <x-dashboard.input name="publisher_id" label="الناشر" type="select" :options="$publishers->map(fn ($category) => [$category->id ,$category->name])"  />
                <x-dashboard.input name="authors" multiple label="المؤلفون" type="select" :options="$authors->map(fn ($category) => [$category->id ,$category->name])"  />
                <button class="btn btn-success d-block mx-auto" style="width: 100%;">
                    إضافة
                </button>
                <datalist id="years">
                    @for($year=now()->addYears(-20)->format('Y');$year<=now()->addYears(2)->format('Y');$year++)
                        <option value="{{$year}}">{{$year}}</option>
                    @endfor
                </datalist>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.getElementById('photoBook');
                img.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            // Handle case when no file is selected
            const img = document.getElementById('photoBook');
            img.src = ''; // Clear the preview image
        }
    }
</script>
@endsection
