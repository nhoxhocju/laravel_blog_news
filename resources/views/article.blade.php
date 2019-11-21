{{-- <h1>{{ $article->name }}</h1>
{{ $article->text }} --}}
@foreach ($article as $item)
    {{$item->name}}
    {{$item->text}}
@endforeach