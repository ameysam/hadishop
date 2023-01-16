@extends('_layouts.admin.index')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="box-title mb-2">نقش‌های من</h4>

                <table class="table table-striped table-bordered">
                    <thead class="bg-secondary">
                        <tr>
                            <th class="text-white text-center">نقش</th>
                            <th class="text-white text-center">مرکز</th>
                            <th class="text-white text-center">دسترسی ها</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($records as $record)
                        <tr>
                            <td class="text-center">{{ $record->role_name }}</td>
                            <td class="text-center">{{ $record->center_full_name ?? '' }}</td>
                            <td class="">{{ $record->permissions_names ?? '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $records->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
