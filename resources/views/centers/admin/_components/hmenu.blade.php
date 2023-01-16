<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-center bd-highlight mb-3 bg-dark">
            @hasp('schedule-list', $g_center)
                <div class="p-2 bd-highlight">
                    <a href="{{ route('admin.center.schedule.index', $g_center->id) }}" class="btn btn-outline-warning py-1 px-3">زمان‌بندی رزرو</a>
                </div>
            @endhasap
            @hasp('room-list', $g_center)
                <div class="p-2 bd-highlight">
                    <a href="{{ route('admin.center.show', $g_center->id) }}" class="btn btn-outline-warning py-1 px-3">اتاق‌ها</a>
                    {{-- <a href="{{ route('admin.center.room.index', $g_center->id) }}" class="btn btn-outline-warning py-1 px-3">اتاق‌ها</a> --}}
                </div>
            @endhasap
            @hasp('schedule-assign', $g_center)
                <div class="p-2 bd-highlight">
                    <a href="{{ route('admin.center.room.schedule.index', $g_center->id) }}" class="btn btn-outline-warning py-1 px-3">تخصیص زمانبدی به اتاق‌ها</a>
                </div>
            @endhasap
            @hasp('center-edit', $g_center)
                <div class="p-2 bd-highlight">
                    <a href="{{ route('admin.center.member.index', $g_center->id) }}" class="btn btn-outline-warning py-1 px-3">اعضا</a>
                </div>
            @endhasap
            @hasp('role-show', $g_center)
                <div class="p-2 bd-highlight">
                    <a href="{{ route('admin.center.role.index', $g_center->id) }}" class="btn btn-outline-warning py-1 px-3">نقش‌ها(چارت سازمانی)</a>
                </div>
            @endhasap
        </div>
    </div>
</div>
