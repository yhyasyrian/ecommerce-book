<div class="mt-2 bg-white">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 sm:gap-2 md:gap-4 lg:gap-8 mx-auto container p-4">
        <div class="md:col-span-2">
            <h2 class="heading-footer">{{config('app.name')}}</h2>
            <p class="leading-8 max-w-2xl">
                {{config('app.description')}}
            </p>
        </div>
        <div>
            <h2 class="heading-footer">التصنيفات</h2>
            <nav class="navigation-footer">
                @foreach($footerCategories as $footerCategory)
                    <a class="link-effect" href="{{route('categories.show',['category'=>$footerCategory->slug])}}">{{$footerCategory->name}}</a>
                @endforeach
            </nav>
        </div>
    </div>
    <div id="copyRigth" class="text-center p-2 mt-2 border-t w-full text-lg">
        جميع الحقوق محفظوطة &copy; لـ
        <span class="text-blue-600 font-bold">{{config('app.name')}}</span>
    </div>
</div>
