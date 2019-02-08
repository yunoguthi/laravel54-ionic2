@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="row">
        {!!  Button::primary('Novo usuário')->asLinkTo(route('admin.users.create')) !!}
    </div>

    <div class="row">

        {!! Table::withContents($users->items())->striped()
            ->callback('Ações', function($field, $user){
                $linkEdit = route('admin.users.edit', ['user' => $user->id]);
                $linkShow = route('admin.users.show', ['user' => $user->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                Button::link(Icon::create('remove'))->asLinkTo($linkShow);
            })
        !!}

    </div>

    {!! $users->links() !!}

</div>
@endsection
