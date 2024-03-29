@extends('wrap')
@section('title',$data['title'])
@section('content')

    <div class="background" style="background-image: url('{{asset('public/storage/'.$data['background'])}}')">

    </div>
    <h1 class="center form-name">{{$data['title']}}</h1>
    <form action="{{route('questionnaire')}}" method="POST">
        @method('POST')
        @csrf
        {{-- {{dd($data)}} --}}
        <input type="hidden" name="id" value="{{$data['id']}}">
        @foreach ($data['page'] as $item1)
            <div class="none page-{{$item1['page']}}">
                @foreach ($item1['questions'] as $item)
                    <div class="question-block ">
                        <div class="red">
                            @if ($item['required']=='1')
                                <p>
                                    *
                                </p>
                            @endif
                        </div>
                        <div>
                            {{-- {{dd($item)}} --}}
                            @if ($item['type']=='title' || $item['type']=='text')
                                @if ($item['type']=='title')
                                    <h2>{{$item['question']}}</h2>
                                @else
                                    <p class="title">{{$item['question']}}</p>
                                @endif
                            @else
                                @if ($item['type']=='agreement')
                                    <input type="hidden" name="question[{{$item['id']}}][id]" value="{{$item['id']}}">
                                @else
                                    <p class="title">{{$item['question']}}</p>
                                    <input type="hidden" name="question[{{$item['id']}}][id]" value="{{$item['id']}}">
                                @endif
                            @endif

                            @if ($item['type']=='text_short' || $item['type']=='email' || $item['type']=='data')
                                <input class="{{($item['required'] == '1') ? 'required-'.$item1['page'] :''}}" type="{{($item['type'] == 'text_short') ? 'text' : (($item['type'] == 'email') ? 'email' : (($item['type'] == 'data') ? 'date' : ''))}}" name="question[{{$item['id']}}][value][]" {{($item['required'] == '1') ? 'required' :''}}>
                            @elseif($item['type']=='text_long')
                                <textarea class="{{($item['required'] == '1') ? 'required-'.$item1['page'] :''}}" name="question[{{$item['id']}}][value][]" rows="6" {{($item['required'] == '1') ? 'required' :''}}></textarea>
                            @elseif($item['type']=='checkbox')
                                @foreach ($item['option'] as $item2)
                                    <label class="option" for="question-{{$item['id']}}-{{$loop->index}}">
                                        <div>
                                            <input type="checkbox" class="checkbox {{($item['required'] == '1') ? 'checkbox required-'.$item1['page'] :''}}" id="question-{{$item['id']}}-{{$loop->index}}" name="question[{{$item['id']}}][value][]" value="{{$item2}}" {{($item['required'] == '1') ? 'required' :''}}>
                                        </div>
                                        <div>
                                            {{$item2}}
                                        </div>
                                    </label>
                                @endforeach
                            @elseif($item['type']=='radio')
                                @foreach ($item['option'] as $item2)
                                    <label class="option" for="question-{{$item['id']}}-{{$loop->index}}">
                                        <div>
                                            <input type="radio" id="question-{{$item['id']}}-{{$loop->index}}" class="radio {{($item['required'] == '1') ? 'required-'.$item1['page'] :''}}" name="question[{{$item['id']}}][value][]" value="{{$item2}}" {{($item['required'] == '1') ? 'required' :''}}>
                                        </div>
                                        <div>
                                            {{$item2}}
                                        </div>
                                    </label>
                                @endforeach
                            @elseif($item['type']=='select')
                                <select class="{{($item['required'] == '1') ? 'required-'.$item1['page'] :''}}" name="question[{{$item['id']}}][value][]" {{($item['required'] == '1') ? 'required' :''}}>
                                    <option value="" disabled selected>-</option>
                                    @foreach ($item['option'] as $item1)
                                        <option value="{{$item1}}">{{$item1}}</option>
                                    @endforeach
                                </select>
                            @elseif($item['type']=='agreement')
                                <label class="option" for="question-{{$item['id']}}-{{$loop->index}}">
                                    <div>
                                        <input type="checkbox" class="checkbox {{($item['required'] == '1') ? 'required-'.$item1['page'] :''}}" id="question-{{$item['id']}}-{{$loop->index}}" name="question[{{$item['id']}}][value][]" value="Согласен" {{($item['required'] == '1') ? 'required' :''}}>
                                    </div>
                                    <div>
                                        {{$item['question']}}
                                    </div>
                                </label>
                            @endif

                            @if ($item['comment']!=null)
                                <p class="comment">
                                    {{$item['comment']}}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        <div class="submit-block">
            <div class="previous-block">
                <div class="submit previous none" onclick="previous(1,{{count($data['page'])}})">Назад</div>
            </div>
            <div class="next-block">
                <div class="submit next {{count($data['page'])==1?'none':'block'}}" onclick="next(1,{{count($data['page'])}})">Далее</div>
            </div>
            <div class="send-block">
                <input type="submit" class="submit send {{count($data['page'])==1?'block':'none'}}" value="Отправить" style="width: 150px">
            </div>
        </div>
    </form>
@endsection
