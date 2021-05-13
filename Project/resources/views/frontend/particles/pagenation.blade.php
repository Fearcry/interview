@if ($tasks->totalPage > 1)
    <nav aria-label="Task pages">
        <ul class="pagination">
            <li class="page-item {{ $tasks->currentPage() - 1 <= 0 ? 'disabled' : '' }}"><a class="page-link"
                    href="{{ $tasks->currentPage() - 1 > 0 ? route('home-task-paged', ['page' => $tasks->currentPage() - 1]) : '#' }}"><</a>
            </li>
            @if ($tasks->totalPage <= 4)
                @for ($i = 1; $i <= $tasks->totalPage; $i++) <li
                    class="page-item {{ $i == $tasks->currentPage() ? 'active' : '' }}"><a
                    class="page-link"
                    href="{{ route('home-task-paged', ['page' => $i]) }}">{{ $i }}</a></li> @endfor

                @else
                    @for ($i = 1; $i <= $tasks->totalPage; $i++)
                        @if ($i == 1)
                            <li class="page-item {{ $i == $tasks->currentPage() ? 'active' : '' }}"><a
                                    class="page-link"
                                    href="{{ route('home-task-paged', ['page' => $i]) }}">{{ $i }}</a></li>


                            @elseif(($i==$tasks->currentPage()-1 || $i==$tasks->currentPage()+1) &&($i!=$tasks->totalPage) )
                            <li class="page-item {{ $i == $tasks->currentPage() ? 'active' : '' }}"><a
                                    class="page-link" href="{{ route('home-task-paged', ['page' => $i]) }}">...</a>
                            </li>


                            @elseif( $i==$tasks->totalPage)
                            <li class="page-item {{ $i == $tasks->currentPage() ? 'active' : '' }}"><a
                                    class="page-link"
                                    href="{{ route('home-task-paged', ['page' => $i]) }}">{{ $i }}</a>
                            </li>

                        @elseif( $i==$tasks->currentPage())
                            <li class="page-item {{ $i == $tasks->currentPage() ? 'active' : '' }}"><a
                                    class="page-link"
                                    href="{{ route('home-task-paged', ['page' => $i]) }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endfor
            @endif
            <li class="page-item {{ $tasks->currentPage() >= $tasks->total() ? 'disabled' : '' }}"><a
                    class="page-link"
                    href="{{ $tasks->currentPage() + 1 <= $tasks->total() ? route('home-task-paged', ['page' => $tasks->currentPage() + 1]) : '#' }}">></a>
            </li>
        </ul>
    </nav>
@endif
