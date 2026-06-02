@extends('layouts.app')

@section('content')
@php
function getLevelBadgeColor($level) {
    return match(strtolower($level)) {
        'debug' => 'secondary',
        'info' => 'info',
        'notice' => 'info',
        'warning' => 'warning',
        'error' => 'danger',
        'critical' => 'danger',
        'alert' => 'danger',
        'emergency' => 'danger',
        default => 'secondary',
    };
}
@endphp
<div class="container py-5">
    @include('admin.partials.secondary-nav')

    <div class="card bg-dark text-white border-0 shadow-sm">
        <div class="card-header bg-dark border-bottom border-secondary">
            <h5 class="mb-0">Application Logs - Last 7 Days</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0">
                    <thead>
                        <tr class="border-bottom border-secondary">
                            <th class="ps-3" style="width: 180px;">Timestamp</th>
                            <th style="width: 100px;">Level</th>
                            <th style="width: 100px;">Channel</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                            <tr class="border-bottom border-secondary-subtle">
                                <td class="ps-3 text-muted" style="font-size: 0.85rem;">
                                    {{ $log['timestamp'] }}
                                </td>
                                <td>
                                    <span class="badge bg-{{ getLevelBadgeColor($log['level']) }} text-dark">
                                        {{ strtoupper($log['level']) }}
                                    </span>
                                </td>
                                <td class="text-muted" style="font-size: 0.85rem;">
                                    {{ $log['channel'] }}
                                </td>
                                <td style="word-wrap: break-word; word-break: break-word; max-width: 400px; font-size: 0.9rem;">
                                    <code class="text-info">{{ Str::limit($log['message'], 150, '...') }}</code>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    No logs found for the past 7 days.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if ($total > 0)
        <div class="mt-4 d-flex justify-content-between align-items-center">
            <p class="text-muted mb-0">Showing {{ ($page - 1) * 50 + 1 }} to {{ min($page * 50, $total) }} of {{ $total }} total logs</p>
            
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm mb-0">
                    @if ($page > 1)
                        <li class="page-item">
                            <a class="page-link bg-dark text-warning border-secondary" href="?page=1">First</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link bg-dark text-warning border-secondary" href="?page={{ $page - 1 }}">Previous</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link bg-dark border-secondary">First</span>
                        </li>
                        <li class="page-item disabled">
                            <span class="page-link bg-dark border-secondary">Previous</span>
                        </li>
                    @endif

                    @if ($page < $lastPage)
                        <li class="page-item">
                            <a class="page-link bg-dark text-warning border-secondary" href="?page={{ $page + 1 }}">Next</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link bg-dark text-warning border-secondary" href="?page={{ $lastPage }}">Last</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link bg-dark border-secondary">Next</span>
                        </li>
                        <li class="page-item disabled">
                            <span class="page-link bg-dark border-secondary">Last</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    @endif
</div>

@endsection
