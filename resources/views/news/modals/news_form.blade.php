<div class="modal fade" id="newsModal" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title form_title">Edit News</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">

                                {!! Form::open(array('url'=>'news/'.$id_sport, 'method'=>'POST', 'files'=>true)) !!}
                                {{ Form::hidden('news_invisible_image', null, ['id' => 'news_invisible_image']) }}
                                {{ Form::hidden('news_invisible_action', null, ['id' => 'news_invisible_action']) }}

                                <img id="photo" height="100"
                                     src="http://images5.fanpop.com/image/photos/28100000/david-david-hasselhoff-28104576-400-300.jpg">

                                <div class="control-group">
                                    <div class="controls">
                                        {!! Form::label('title', 'Select Image:', ['class' => 'control-label']) !!}
                                        {!! Form::file('image') !!}
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group select_sport">
                    {!! Form::label('title', 'Sport:', ['class' => 'control-label']) !!}
                    {{ Form::select('sport_id[]', $sports, null, ['class' => 'form-control', 'id' => 'sport_id', 'style' => 'width: 100%', 'multiple']) }}
                    {!! Form::label('title[]', 'Level:', ['class' => 'control-label']) !!}
                    {{ Form::select('level_id[]', $levelcreate, null, ['class' => 'form-control', 'id' => 'level_id', 'style' => 'width: 100%', 'multiple']) }}

                    {!! Form::label('title', 'Roster:', ['class' => 'control-label']) !!}
                    {{ Form::select('roster_id[]', $rosters, null, ['class' => 'form-control','id' => 'roster_id', 'style' => 'width: 100%', 'multiple']) }}
                    {!! Form::label('title', 'Game:', ['class' => 'control-label']) !!}
                    {{ Form::select('game_id[]', $games, null, ['class' => 'form-control','id' => 'game_id', 'style' => 'width: 100%', 'multiple']) }}

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {{ Form::hidden('news_invisible_id', null, ['id' => 'news_invisible_id']) }}

                                {!! Form::label('title', 'Title:', ['class' => 'control-label']) !!}
                                {!! Form::text('title', null, ['class' => 'form-control', 'id'=> 'title']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Date:', ['class' => 'control-label']) !!}
                                {{ Form::text('news_date', '', ['class' => 'form-control','id' => 'news_date']) }}
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Content:', ['class' => 'control-label']) !!}
                                {{ Form::textarea('content', null, ['class' => 'form-control','id' => 'content']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                <br>
                                @if ($errors->has())
                                    <div class="alert alert-danger">

                                        @foreach(Session::get('message') as $er)
                                            {{ $er }} <br>
                                        @endforeach
                                    </div>
                                @endif

                                {!! Form::submit('Update news', ['class' => 'submit_news_modal btn btn-primary']) !!}
                                &nbsp;
                                <button style="vertical-align: center;" type="button" class="btn btn-default"
                                        data-dismiss="modal">Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>