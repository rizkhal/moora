<?php

use Tabuna\Breadcrumbs\Trail;
use Tabuna\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for(
    'participan',
    fn (Trail $trail): Trail =>
    $trail->push('Partisipan', route('participan'))
);

Breadcrumbs::for(
    'setting.role.index',
    fn (Trail $trail): Trail =>
    $trail->push('Hak Akses', route('setting.role.index'))
);

Breadcrumbs::for(
    'setting.role.create',
    fn (Trail $trail): Trail =>
    $trail->parent('setting.role.index')->push('Tambah', route('setting.role.create'))
);

Breadcrumbs::for(
    'setting.permission.index',
    fn (Trail $trail): Trail =>
    $trail->parent('setting.role.index')->push('Permission', route('setting.permission.index'))
);
