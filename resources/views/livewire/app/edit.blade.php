<div>
    <section class="content">
        <div class="container-fluid">
            <form role="form" method="post" enctype="multipart/form-data" action="{{ route('app.update', ['id' => $app->id]) }}">
                <div class="row">
                    <div class="col-xl-6 col-sm-12">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title"
                                   class="form-control @error('title') is-invalid @enderror" id="title"
                                   value="{{ old('title', $app->title) }}"
                                   placeholder="Title">
                        </div>
                        @if(sizeof($state['platforms']) !== 1 || !in_array(2, $state['platforms']))
                        <div class="form-group">
                            <label for="server_key">Server Key</label>
                            <input type="text" name="server_key"
                                   class="form-control @error('server_key') is-invalid @enderror" id="server_key"
                                   value="{{ old('server_key', $app->server_key) }}"
                                   placeholder="Server Key">
                        </div>

                        <div class="form-group">
                            <label for="sender_id">Sender Id</label>
                            <input type="number" name="sender_id"
                                   class="form-control @error('sender_id') is-invalid @enderror" id="sender_id"
                                   value="{{ old('sender_id', $app->sender_id) }}"
                                   placeholder="Sender Id">
                        </div>
                        @endif
                        @if(in_array(2, $state['platforms']))
                            <div class="form-group">
                                <label for="private_key">Private Key</label>
                                <input type="text" name="private_key"
                                       class="form-control @error('private_key') is-invalid @enderror" id="private_key"
                                       value="{{ old('private_key', $app->private_key) }}"
                                       placeholder="Private Key">
                            </div>
                            <div class="form-group">
                                <label for="certificate">Certificate P12</label>
                                <input type="file" name="certificate"
                                       accept="application/pkcs12"
                                       class="form-control @error('certificate') is-invalid @enderror" id="certificate"
                                       placeholder="Certificate">
                            </div>
                        @endif
                    </div>
                    <!-- /.col -->
                    @if(count($platforms))
                        <div class="col-xl-6 col-sm-12">
                            <div class="form-group mt-3 platform-group text-center">
                                @foreach($platforms as $platform)
                                    <label class="radio-image me-4">
                                        <input type="checkbox" wire:model="state.platforms" name="platforms[]"  value="{{ $platform->id }}">
                                        <img src="{{ $platform->image }}" width="150" alt="{{ $platform->name }}">
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.col -->
                    @endif
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary mt-1">Submit</button>
                    </div>

                </div>
                <!-- /.row -->
            </form>
        </div><!-- /.container-fluid -->
    </section>
</div>
