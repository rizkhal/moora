<?php

use App\Models\Criteria;
use App\Models\Reqruitment;
use Illuminate\Support\Str;
use Tabuna\Breadcrumbs\Trail;
use Spatie\Permission\Models\Role;
use Tabuna\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for(
    'reqruitment.index',
    fn (Trail $trail): Trail =>
    $trail->push('Penerimaan', route('reqruitment.index'))
);

Breadcrumbs::for(
    'reqruitment.create',
    fn (Trail $trail): Trail =>
    $trail->parent('reqruitment.index')->push('Tambah', route('reqruitment.create'))
);

Breadcrumbs::for(
    'reqruitment.edit',
    fn (Trail $trail, Reqruitment $reqruitment): Trail =>
    $trail->parent('reqruitment.index')->push(Str::title($reqruitment->name), route('reqruitment.show', $reqruitment->id))->push('Ubah')
);

Breadcrumbs::for(
    'reqruitment.show',
    fn (Trail $trail, Reqruitment $reqruitment): Trail =>
    $trail->parent('reqruitment.index')->push(Str::title($reqruitment->name))
);

Breadcrumbs::for(
    'reqruitment.criteria.create',
    fn (Trail $trail, Reqruitment $reqruitment): Trail =>
    $trail->parent('reqruitment.index')->push(Str::title($reqruitment->name), route('reqruitment.show', $reqruitment->id))->push('Tambah Kriteria')
);

Breadcrumbs::for(
    'reqruitment.criteria.show',
    fn (Trail $trail, Reqruitment $reqruitment, Criteria $criteria): Trail =>
    $trail->parent('reqruitment.index')->push(Str::title($reqruitment->name), route('reqruitment.show', $reqruitment->id))->push(Str::title($criteria->name))
);

Breadcrumbs::for(
    'reqruitment.criteria.edit',
    fn (Trail $trail, Reqruitment $reqruitment, Criteria $criteria): Trail =>
    $trail->parent('reqruitment.index')
        ->push(Str::title($reqruitment->name), route('reqruitment.show', $reqruitment->id))
        ->push(Str::title($criteria->name), route('reqruitment.criteria.show', ['reqruitment' => $reqruitment->id, 'criteria' => $criteria->id]))
        ->push('Ubah')
);

Breadcrumbs::for(
    'reqruitment.users',
    fn (Trail $trail, Reqruitment $reqruitment) =>
    $trail->push($reqruitment->name, route('reqruitment.index'))
        ->push('Daftar Peserta')
);

Breadcrumbs::for(
    'reqruitment.ranks',
    fn (Trail $trail, Reqruitment $reqruitment) =>
    $trail->push($reqruitment->name, route('reqruitment.index'))
        ->push('Daftar Peserta', route('reqruitment.users', $reqruitment->id))->push('Rangking')
);

//------------------------------------------

Breadcrumbs::for(
    'setting.general.index',
    fn (Trail $trail): Trail =>
    $trail->push('Umum', route('setting.general.index'))
);

Breadcrumbs::for(
    'setting.user.index',
    fn (Trail $trail): Trail =>
    $trail->push('Pengguna', route('setting.user.index'))
);

Breadcrumbs::for(
    'setting.role.index',
    fn (Trail $trail): Trail =>
    $trail->push('Role', route('setting.role.index'))
);

Breadcrumbs::for(
    'setting.role.create',
    fn (Trail $trail): Trail =>
    $trail->parent('setting.role.index')->push('Tambah', route('setting.role.create'))
);

Breadcrumbs::for(
    'setting.role.show',
    fn (Trail $trail, Role $role): Trail =>
    $trail->parent('setting.role.index')->push($role->name)
);

Breadcrumbs::for(
    'setting.permission.index',
    fn (Trail $trail): Trail =>
    $trail->parent('setting.role.index')->push('Permission', route('setting.permission.index'))
);
