<?php

namespace App\Http\Controllers;

use App\Models\Reqruitment;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Enums\AnnouncementStatus;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AnnouncementRequest;
use App\Jobs\AnnouncementJob;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user()->can('lihat-pengumuman')) {
            abort(403);
        }

        return inertia('announcement/index')
            ->with([
                'filters' => [
                    'reqruitments' => Reqruitment::all(['id', 'name'])
                ],
                'announcements' => Announcement::query()->default()->filter($request)->latest()->paginate(10)
            ])
            ->title('Kelola Pengumuman');
    }

    public function create()
    {
        return inertia('announcement/create')
            ->with(['reqruitments' => Reqruitment::all(['id', 'name'])])
            ->title('Tambah Pengumuman');
    }

    public function store(AnnouncementRequest $request)
    {
        DB::transaction(function () use ($request) {
            $announcement = Announcement::create($request->getData());
            $announcement->reqruitments()->sync([
                'reqruitment_id' => $request->reqruitment,
            ]);
        });
        
        return back();
    }

    /**
     * Add mark for announcement
     *
     * @param Announcement $announcement
     * @param int $status
     * @return void
     */
    public function addMark(Announcement $announcement, int $status)
    {
        $announcement->status === $status
            ? $announcement->update(['status' => AnnouncementStatus::DEFAULT->value])
            : $announcement->update(['status' => $status]);

        return back();
    }

    public function stared(Request $request)
    {
        return inertia('announcement/stared')
            ->with([
                'filters' => [
                    'reqruitments' => Reqruitment::all(['id', 'name'])
                ],
                'announcements' => Announcement::query()->stared()->filter($request)->latest()->paginate(10)
            ])
            ->title('Pengumuman Berbintang');
    }

    public function draft(Request $request)
    {
        return inertia('announcement/draft')
            ->with([
                'filters' => [
                    'reqruitments' => Reqruitment::all(['id', 'name'])
                ],
                'announcements' => Announcement::query()->draft()->filter($request)->latest()->paginate(10)
            ])
            ->title('Pengumuman Draft');
    }

    public function trash(Request $request)
    {
        return inertia('announcement/trash')
            ->with([
                'filters' => [
                    'reqruitments' => Reqruitment::all(['id', 'name'])
                ],
                'announcements' => Announcement::query()->onlyTrashed()->filter($request)->latest()->paginate(10)
            ])
            ->title('Pengumuman Dihapus');
    }

    public function delete(Announcement $announcement)
    {
        $announcement->delete();
        return back();
    }

    public function restore(Request $request)
    {
        Announcement::onlyTrashed()->whereId($request->id)->restore();
        return back();
    }
}
