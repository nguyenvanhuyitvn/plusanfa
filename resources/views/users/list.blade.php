<h1>List Users</h1>
@foreach ($data as $item)
    @foreach ($item as $item1)
        {{$item1['user']->email}}
    @endforeach
@endforeach