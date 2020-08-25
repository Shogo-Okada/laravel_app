@extends ('layouts.app')
@section ('content')


<h2 class="mb-3">ToDo作成</h2>
{!! Form::open(['route' => 'todo.store']) !!} <!-- 変更 -->
  <div class="form-group">
    {!! Form::input('text', 'title', null, ['required', 'class' => 'form-control', 'placeholder' => 'ToDo内容']) !!}
    <!-- 第一引数にはtype指定 第二はフィールド名 第三は初期値(=value) []内はオプション -->
  </div>
  {!! Form::submit('追加', ['class' => 'btn btn-success float-right']) !!} <!-- 変更 -->
{!! Form::close() !!} <!-- 変更 -->

@endsection