@extends('layouts.layout')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Push Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Push Users</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('pushUser.index') }}" class="d-flex filters-wrapper mb-2">
                    <div class="form-group">
                        <label for="limit">Limit</label>
                        <input type="number" class="form-control" value="{{ request()->get('limit') }}" id="limit" name="limit">
                    </div>
                    <div class="form-group">
                        <label for="segments">Segments</label>
                        <select multiple name="segments[]" class="tokenize2" id="segments" aria-label="Segments">
                            @foreach($segments as $segment)
                            <option @if(in_array($segment->id, request()->get('segments', []))) selected @endif value="{{ $segment->id }}">{{ $segment->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="apps">Applications</label>
                        <select multiple name="apps[]" class="tokenize2" id="apps" aria-label="Applications">
                            @foreach($apps as $app)
                            <option @if(in_array($app->id, request()->get('apps', []))) selected @endif value="{{ $app->id }}">{{ $app->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="countries">Countries</label>
                        <select multiple name="countries[]" class="tokenize2" id="countries" aria-label="Countries">
                            @foreach($countries as $country)
                            <option @if(in_array($country->id, request()->get('countries', []))) selected @endif value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="languages">Languages</label>
                        <select multiple name="languages[]" class="tokenize2" id="languages" aria-label="Languages">
                            @foreach($languages as $language)
                            <option @if(in_array($language->id, request()->get('languages', []))) selected @endif value="{{ $language->id }}">{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="platforms">Platforms</label>
                        <select multiple name="platforms[]" class="tokenize2" id="platforms" aria-label="Platforms">
                            @foreach($platforms as $platform)
                            <option @if(in_array($platform->id, request()->get('platforms', []))) selected @endif value="{{ $platform->id }}">{{ $platform->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-select" id="status" aria-label="Status">
                            <option value="">Select status</option>
                            <option @if(\request()->get('status') === \App\Models\PushUser::SUBSCRIBED_STATUS) selected @endif value="{{ \App\Models\PushUser::SUBSCRIBED_STATUS }}">Subscribed</option>
                            <option @if(\request()->get('status') === \App\Models\PushUser::UNSUBSCRIBED_STATUS) selected @endif value="{{ \App\Models\PushUser::UNSUBSCRIBED_STATUS }}">Unsubscribed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                @if (count($pushUsers))
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 30px">#</th>
                                <th>Internal Id</th>
                                <th>App</th>
                                <th>Country</th>
                                <th>Language</th>
                                <th>Timezone</th>
                                <th>Time In App</th>
                                <th>Sessions Count</th>
                                <th>First Session</th>
                                <th>Last Session</th>
                                <th>Status</th>
                                <th>Device Model</th>
                                <th>Platform</th>
                                <th>Tags</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pushUsers as $pushUser)
                            <tr>
                                <td>{{ $pushUser->id }}</td>
                                <td>{{ $pushUser->uuid }}</td>
                                <td>{{ $pushUser->app->title }}</td>
                                <td>{{ $pushUser->country->name }}</td>
                                <td>{{ $pushUser->language->name }}</td>
                                <td>{{ $pushUser->timezone->name }}</td>
                                <td>{{ $pushUser->time_in_app }}</td>
                                <td>{{ $pushUser->sessions_count }}</td>
                                <td>{{ \App\Libraries\Helpers\TimezoneHelper::convertTimeToClientTimezone($pushUser->created_at) }}</td>
                                <td>{{ \App\Libraries\Helpers\TimezoneHelper::convertTimeToClientTimezone($pushUser->active_at) }}</td>
                                <td>{{ $pushUser->status }}</td>
                                <td>{{ $pushUser->device_model }}</td>
                                <td>{{ $pushUser->platform->name }}</td>
                                <td>{{ $pushUser->tags ? json_encode($pushUser->tags) : '' }}</td>
                                <td class="d-flex justify-content-around" style="gap: 5px;">
                                    <form action="{{ route('pushUser.destroy', ['id' => $pushUser->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="height: 100%;" class="btn btn-danger btn-sm" onclick="return confirm('Submit deleting...')">
                                            <ion-icon name="trash" class="action-icon"></ion-icon>
                                        </button>
                                    </form>
                                    @if($pushUser->is_test)
                                    <form action="{{ route('pushUser.make.default', ['id' => $pushUser->id]) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" style="height: 100%;" class="btn btn-success btn-sm">
                                            D
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('pushUser.make.test', ['id' => $pushUser->id]) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" style="height: 100%;" class="btn btn-success btn-sm">
                                            T
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p>Total: {{$pushUsers->total()}}</p>
                @else
                <p>No push users yet...</p>
                @endif

                {{ $pushUsers->links("pagination::bootstrap-4") }}


            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('scripts')
<script>
    let entities = $('.tokenize2')
    entities.tokenize2({
        dataSource: 'select',
    })
</script>
@endsection