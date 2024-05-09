<x-app-layout>
    @foreach($books as $book)
        {{$book->title}}<br>
    @endforeach
</x-app-layout>
