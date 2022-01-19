<?php

use App\Models\Criteria;
use Tabuna\Breadcrumbs\Trail;
use Spatie\Permission\Models\Role;
use Tabuna\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for(
    'participan',
    fn (Trail $trail): Trail =>
    $trail->push('Partisipan', route('participan'))
);

Breadcrumbs::for(
    'criteria.index',
    fn (Trail $trail): Trail =>
    $trail->push('Kriteria', route('criteria.index'))
);

Breadcrumbs::for(
    'criteria.create',
    fn (Trail $trail): Trail =>
    $trail->parent('criteria.index')->push('Tambah', route('criteria.create'))
);

Breadcrumbs::for(
    'criteria.edit',
    fn (Trail $trail, Criteria $criterion): Trail =>
    $trail->parent('criteria.index')->push('Ubah', route('criteria.edit', $criterion->id))
);

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
    $trail->parent('setting.role.index')->push('Edit', route('setting.role.show', $role->id))->push($role->name)
);

Breadcrumbs::for(
    'setting.permission.index',
    fn (Trail $trail): Trail =>
    $trail->parent('setting.role.index')->push('Permission', route('setting.permission.index'))
);
