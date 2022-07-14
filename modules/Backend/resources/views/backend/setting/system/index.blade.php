@extends('cms::layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                @foreach($forms as $key => $form)
                <a class="list-group-item @if($key == $component) active @endif" href="{{ route('admin.setting.form', [$key]) }}">{{ $form->get('name') }}</a>
                @endforeach
            </div>
        </div>

        <div class="col-md-9">
            <form action="{{ route('admin.setting.save') }}" method="post" class="form-ajax">
                <input type="hidden" name="form" value="general">

                <div class="card">
                    @if($forms[$component]['header'] ?? true)
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group float-right">
                                    <button type="submit" class="btn btn-success"> Save </button>
                                    <button type="reset" class="btn btn-default"> Reset </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="card-body">
                        @if(isset($forms[$component]['view']))
                            @if(is_string($forms[$component]['view']))
                                @if(view()->exists($forms[$component]['view']))
                                    @include($forms[$component]['view'])
                                @endif
                            @else
                                {{ $forms[$component]['view'] }}
                            @endif
                        @endif

                        @foreach($configs as $key => $config)
                            @php
                                $config['data'] = $config;
                                if ($config['type'] == 'checkbox') {
                                    $config['data']['value'] = $config['data']['value'] ?? 1;
                                    $config['data']['checked'] = get_config($key) == ($config['data']['value'] ?? '');
                                } else {
                                    $config['data']['value'] = get_config($key);
                                }

                                $config['name'] = $key;
                            @endphp

                            {{ Field::fieldByType($config) }}
                        @endforeach
                    </div>

                    @if($forms[$component]['footer'] ?? true)
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6"></div>

                            <div class="col-md-6">
                                <div class="btn-group float-right">
                                    <button type="submit" class="btn btn-success">
                                         {{ trans('cms::app.save') }}
                                    </button>

                                    <button type="reset" class="btn btn-default">
                                         {{ trans('cms::app.reset') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
