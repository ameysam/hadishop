<?php

use App\Http\Controllers\Cedar\Admin\CedarController;
use App\Http\Controllers\Center\Admin\CenterController;
use App\Http\Controllers\Center\Admin\CenterMemberController;
use App\Http\Controllers\Center\Role\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Comment\Admin\CommentController;
use App\Http\Controllers\Event\Admin\EventController;
use App\Http\Controllers\Home\HomeAdminController;
use App\Http\Controllers\Meeting\Admin\MeetingController;
use App\Http\Controllers\Message\Admin\MessageController;
use App\Http\Controllers\Role\Admin\RoleController;
use App\Http\Controllers\Room\Admin\RoomController;
use App\Http\Controllers\Room\Admin\RoomScheduleController;
use App\Http\Controllers\Room\Admin\RoomTimingController;
use App\Http\Controllers\Schedule\Admin\ScheduleController;
use App\Http\Controllers\Search\Admin\AutoCompleteSearch;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Admin\UserController;
use App\Http\Controllers\User\Admin\UserRoleController;
use App\Http\Controllers\User\Profile\ProfileController;

Route::prefix('cp')->name('admin.')->group(function (){
// Route::group(['prefix' => 'cp', 'as' => 'admin.'], function () {
    // Route::get('/', function () {
    //     dd(auth()->user()->full_name);
    // });

    Route::prefix('')->name('home.')->group(function (){
        Route::get('', [HomeAdminController::class, 'index'])->name('index');
    });

    /**
     * Center
     */
    Route::prefix('centers')->name('center.')->group(function (){
        Route::get('', [CenterController::class, 'index'])->name('index');
        Route::post('items', [CenterController::class, 'items'])->name('items');
        Route::get('create', [CenterController::class, 'create'])->name('create');
        Route::post('', [CenterController::class, 'store'])->name('store');
        Route::post('center-roles/{ncid?}', [CenterController::class, 'roles'])->name('roles');

        Route::prefix('{cid}')->group(function (){
            Route::get('', [CenterController::class, 'show'])->name('show');
            Route::get('edit', [CenterController::class, 'edit'])->name('edit');
            Route::put('update', [CenterController::class, 'update'])->name('update');

            Route::prefix('rooms')->name('room.')->group(function (){
                Route::get('', [RoomController::class, 'index'])->name('index');
                Route::get('create', [RoomController::class, 'create'])->name('create');
                Route::post('', [RoomController::class, 'store'])->name('store');
                Route::prefix('{id1}')->group(function (){
                    Route::get('', [RoomController::class, 'show'])->name('show');
                    Route::get('edit', [RoomController::class, 'edit'])->name('edit');
                    Route::put('update', [RoomController::class, 'update'])->name('update');

                    Route::prefix('timings')->name('timing.')->group(function (){
                        Route::get('', [RoomTimingController::class, 'index'])->name('index');
                        Route::post('', [RoomTimingController::class, 'store'])->name('store');
                        Route::prefix('{id2}')->group(function (){
                            Route::get('edit', [RoomTimingController::class, 'edit'])->name('edit');
                            Route::put('', [RoomTimingController::class, 'update'])->name('update');
                            Route::delete('', [RoomTimingController::class, 'delete'])->name('delete');
                        });
                    });
                });

                Route::prefix('schedules')->name('schedule.')->group(function (){
                    Route::get('', [RoomScheduleController::class, 'index'])->name('index');
                    Route::post('', [RoomScheduleController::class, 'store'])->name('store');
                    Route::delete('', [RoomScheduleController::class, 'delete'])->name('delete');
                });
            });

            Route::prefix('schedules')->name('schedule.')->group(function (){
                Route::get('', [ScheduleController::class, 'index'])->name('index');
                Route::get('create', [ScheduleController::class, 'create'])->name('create');
                Route::post('', [ScheduleController::class, 'store'])->name('store');
                Route::prefix('{id1}')->group(function (){
                    Route::get('', [ScheduleController::class, 'show'])->name('show');
                    Route::get('edit', [ScheduleController::class, 'edit'])->name('edit');
                    Route::put('update', [ScheduleController::class, 'update'])->name('update');
                    Route::delete('', [ScheduleController::class, 'delete'])->name('delete');
                });
            });

            Route::prefix('roles')->name('role.')->group(function (){
                Route::get('', [AdminRoleController::class, 'index'])->name('index');
                Route::get('create', [AdminRoleController::class, 'create'])->name('create');
                Route::post('', [AdminRoleController::class, 'store'])->name('store');
                Route::post('search', [AdminRoleController::class, 'centerRoleSearch'])->name('search');
                Route::prefix('{id1}')->group(function (){
                    Route::get('', [AdminRoleController::class, 'show'])->name('show');
                    Route::get('edit', [AdminRoleController::class, 'edit'])->name('edit');
                    Route::put('update', [AdminRoleController::class, 'update'])->name('update');
                    Route::delete('', [AdminRoleController::class, 'delete'])->name('delete');
                });
            });
            Route::prefix('members')->name('member.')->group(function (){
                Route::get('', [CenterMemberController::class, 'index'])->name('index');
                Route::post('', [CenterMemberController::class, 'store'])->name('store');
                Route::get('{id1}', [CenterMemberController::class, 'show'])->name('show');
                Route::get('{id1}/edit', [CenterMemberController::class, 'edit'])->name('edit');
                Route::put('{id1}', [CenterMemberController::class, 'update'])->name('update');
                Route::post('assign-role', [CenterMemberController::class, 'assignRole'])->name('assign-role');
                Route::delete('{id1}', [CenterMemberController::class, 'delete'])->name('delete');
            });
        });
    });

    Route::prefix('comments')->name('comment.')->group(function (){
        Route::post('', [CommentController::class, 'store'])->name('store');
    });

    Route::prefix('meetings')->name('meeting.')->group(function (){
        Route::get('', [MeetingController::class, 'index'])->name('index');
        Route::prefix('{id}')->group(function (){
            Route::get('', [MeetingController::class, 'view'])->name('view');
            Route::post('', [MeetingController::class, 'show'])->name('show');
            Route::patch('predict', [MeetingController::class, 'predictUpdate'])->name('predict');
            // Route::patch('status', [MeetingController::class, 'statusUpdate'])->name('status');
            Route::patch('cancellation', [MeetingController::class, 'statusCancellation'])->name('status.cancellation');
            Route::prefix('preceedings')->name('preceedings.')->group(function (){
                Route::post('', [MeetingController::class, 'preceedingsView'])->name('view');
                Route::patch('', [MeetingController::class, 'preceedingsUpdate'])->name('update');
            });
        });
    });

    Route::prefix('events')->name('event.')->group(function (){
        Route::get('', [EventController::class, 'index'])->name('index');
        Route::post('items', [EventController::class, 'items'])->name('items');
        Route::post('', [EventController::class, 'store'])->name('store');
        Route::prefix('{id}')->group(function (){
            Route::get('', [EventController::class, 'view'])->name('view');
            Route::post('', [EventController::class, 'show'])->name('show');
            Route::put('', [EventController::class, 'update'])->name('update');
            Route::delete('', [EventController::class, 'delete'])->name('delete');
            Route::patch('status', [EventController::class, 'statusUpdate'])->name('status');
        });
    });

    Route::prefix('messages')->name('message.')->group(function (){
        Route::get('', [MessageController::class, 'index'])->name('index');
        Route::prefix('{id}')->group(function (){
            Route::post('', [MessageController::class, 'show'])->name('show');
            Route::delete('', [MessageController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('search')->name('search.')->group(function (){
        Route::prefix('auto')->name('auto.')->group(function (){
            Route::post('users', [AutoCompleteSearch::class, 'users'])->name('user');
            Route::post('centers-rooms', [AutoCompleteSearch::class, 'centersRooms'])->name('centers-rooms');
            // Route::post('roles', [AutoCompleteSearch::class, 'roles'])->name('role');
        });
    });

    Route::prefix('roles')->name('role.')->middleware(['role:admin'])->group(function (){
        Route::get('', [RoleController::class, 'index'])->name('index');
        Route::post('items', [RoleController::class, 'items'])->name('items');
        Route::get('create', [RoleController::class, 'create'])->name('create');
        Route::post('', [RoleController::class, 'store'])->name('store');
        Route::get('{id}', [RoleController::class, 'show'])->name('show');
        Route::get('{id}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::put('{id}', [RoleController::class, 'update'])->name('update');
        Route::delete('{ids}', [RoleController::class, 'delete'])->name('delete');
    });


    Route::prefix('users')->name('user.')->middleware(['role:admin'])->group(function (){
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::post('items', [UserController::class, 'items'])->name('items');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('', [UserController::class, 'store'])->name('store');

        Route::prefix('{id}')->group(function (){
            Route::get('', [UserController::class, 'show'])->name('show');
            Route::get('edit', [UserController::class, 'edit'])->name('edit');
            Route::put('', [UserController::class, 'update'])->name('update');

            Route::prefix('roles')->name('role.')->group(function (){
                Route::get('', [UserRoleController::class, 'index'])->name('index');
                Route::post('items', [UserRoleController::class, 'items'])->name('items');
                Route::post('assign-roles', [UserRoleController::class, 'assignRoles'])->name('assign-role');
                Route::delete('{ids}', [UserRoleController::class, 'delete'])->name('delete');
            });
        });

        Route::prefix('{ids}')->group(function (){
            Route::post('assign-roles', [UserController::class, 'assignRoles'])->name('assign');
            Route::patch('', [UserController::class, 'softDelete'])->name('soft');
            Route::delete('', [UserController::class, 'forceDelete'])->name('force');
        });
    });

    Route::prefix('profile')->name('profile.')->group(function (){
        Route::get('', [ProfileController::class, 'edit'])->name('edit');
        Route::put('', [ProfileController::class, 'update'])->name('update');
    });

    /**
     * Section Cedar
     */
    Route::prefix('map')->name('map.')->group(function (){
        Route::prefix('cedar')->name('cedar.')->group(function (){
            Route::post('call', [CedarController::class, 'direction'])->name('call.url');
        });
    });
});


