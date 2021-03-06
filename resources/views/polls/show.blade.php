@extends('app')

@section('content')
  <h1>{{ $poll->name }}</h1>
  {!! Form::model(new App\Word, ['route' => ['polls.words.store', $poll->id], 'class' => 'form-inline']) !!}
    @include('words/partials/_form', ['submit_text' => 'Create Word'])
  {!! Form::close() !!}
  <p>{{ $poll->description or 'no description' }}</p>

    @if ( !$poll->words->count() )
        Your poll has no words.
    @else
        <ul>
            @foreach( $poll->words as $word )
                <li>
                    {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('polls.words.destroy', $poll->id, $word->id))) !!}
                        <a href="{{ route('polls.words.show', [$poll->id, $word->id]) }}">{{ $word->word }}</a>
                        (
                            {!! link_to_route('polls.words.edit', 'Edit', array($poll->id, $word->id), array('class' => 'btn btn-info')) !!},

                            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                        )
                    {!! Form::close() !!}
                </li>
            @endforeach
        </ul>
    @endif

    <p>
        {!! link_to_route('polls.index', 'Back to Polls') !!} |
        {!! link_to_route('polls.words.create', 'Create Word', $poll->id) !!}
    </p>
@endsection