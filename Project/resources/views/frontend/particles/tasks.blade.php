<div class="w-100 mt-2">
    <div class="card m-2">
        <div class="card-header">
            <h4 class="card-title">Task List</h4>
        </div>
        <div class="card-body">
            <div>
                <form action="{{ route('post-task') }}" method="POST">
                    @csrf
                    <div x-data="{length:200}" x-init="length=200-$refs.task.value.length">
                        <div class="form-group d-flex flex-column  mb-0">
                            <label for="">New Task</label>
                            @error('content') <span class="error text-danger">{{ $message }}</span> @enderror
                            <textarea x-on:input="length=200-$refs.task.value.length" x-ref="task" type="text"
                                name="content" id="" class="form-control " x-bind:class="{'is-invalid': length<0 }"
                                placeholder="" required>{{ old('content') }}</textarea>

                            <small id="helpId" x-text="length"
                                x-bind:class="{'text-danger': length<0 ,'text-muted':length>=0}"
                                class=" ml-auto mt-1"></small>

                        </div>
                        <div class="form-group">
                            <button type="submit"
                                class="mt-2 mt-md-0 col-12 col-md-auto btn btn-outline-primary mb-3">Add New
                                Task</button>
                        </div>
                    </div>
                </form>
            </div>
            <ul class="list-group">
                @if (!count($tasks))
                    <li class="list-group-item d-flex flex-column flex-md-row text-center ">
                        <div class="mx-auto"> No task added yet...</div>
                    </li>
                @else
                    @foreach ($tasks as $task)
                        <li class="list-group-item d-flex flex-column flex-md-row task">
                            <div class="content">{{ $task->content }}</div>
                            <div class="control mt-3 mt-md-0 ml-auto p-1 my-auto">
                                <div class="w-100"><a role="button"
                                        href="{{ route('get-task-delete', ['id' => $task->id]) }}"
                                        data-id="{{ $task->id }}"
                                        class="btn btn-sm btn-outline-danger btn-block">Remove</a>
                                </div>
                                <div class=""><small>Create At:
                                        <time datetime="{{ $task->created_at }}">
                                            {{ \Carbon\Carbon::parse($task->created_at)->diffForHumans() }}
                                        </time></small>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="mt-2 ">
                @include('frontend.particles.pagenation')
            </div>
        </div>
    </div>
    @push('scripts')

    @endpush
</div>
