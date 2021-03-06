<?php // routes/breadcrumbs.php

//Dashboard


// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
// use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Beranda', route('dashboard.index'));
});

//Dashboard > Home
Breadcrumbs::for('dashboard_home', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Home', '#');
});

//Dashboard > Categories
Breadcrumbs::for('categories', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Kategori', route('categories.index'));
});

//Dashboard > Categories > Add Category
Breadcrumbs::for('add_category', function ($trail) {
    $trail->parent('categories');
    $trail->push('Tambah Kategori', route('categories.create'));
});

//Dashboard > Categories > Edit Category
Breadcrumbs::for('edit_category', function ($trail, $category) {
    $trail->parent('categories');
    $trail->push('Edit', route('categories.edit', ['category' => $category]));
});

//Dashboard > Categories > Edit Category > Title
Breadcrumbs::for('edit_category_title', function ($trail, $category) {
    $trail->parent('edit_category', $category);
    $trail->push($category->title, route('categories.edit', ['category' => $category]));
});

//Dashboard > Categories > Detail
Breadcrumbs::for('detail_category', function ($trail, $category) {
    $trail->parent('categories');
    $trail->push('Detail', route('categories.show', ['category' => $category]));
});

//Dashboard > Categories > Detail Category > Title
Breadcrumbs::for('detail_category_title', function ($trail, $category) {
    $trail->parent('detail_category', $category);
    $trail->push($category->title, route('categories.show', ['category' => $category]));
});

//Dashboard > Tags
Breadcrumbs::for('tags', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Tags', route('tags.index'));
});

//Dashboard > Tags > Tambah Tags
Breadcrumbs::for('add_tag', function ($trail) {
    $trail->parent('tags');
    $trail->push('Tambah Tag', route('tags.create'));
});

//Dashboard > Tags > Edit > [judul]
Breadcrumbs::for('edit_tag', function ($trail, $tag) {
    $trail->parent('tags');
    $trail->push('Edit', route('tags.edit', ['tag' => $tag]));
    $trail->push($tag->title, route('tags.edit', ['tag' => $tag]));
});


//Dashboard > Posts
Breadcrumbs::for('posts', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Posts', route('posts.index'));
});

//Dashboard > Posts > Add
Breadcrumbs::for('add_post', function ($trail) {
    $trail->parent('posts');
    $trail->push('Tambah Post', route('posts.create'));
});

//Dashboard > Posts > Detail > [title]
Breadcrumbs::for('detail_post', function ($trail, $post) {
    $trail->parent('posts');
    $trail->push('Detail', route('posts.show', ['post' => $post]));
    $trail->push($post->title, route('posts.show', ['post' => $post]));
});

//Dashboard > Posts > Edit > [title]

Breadcrumbs::for('edit_post', function ($trail, $post) {
    $trail->parent('posts');
    $trail->push('Edit', route('posts.edit', ['post' => $post]));
    $trail->push($post->title, route('posts.edit', ['post' => $post]));
});

//Dashboard > File manager
Breadcrumbs::for('file_manager', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('File Manager', route('filemanager.index'));
});

//Dashboard > Roles
Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Roles', route('posts.index'));
});

//Dashboard > Roles >tambah role
Breadcrumbs::for('add_role', function ($trail) {
    $trail->parent('roles');
    $trail->push('Tambah Roles', route('roles.create'));
});

//Dashboard > Roles > Detail > [title]
Breadcrumbs::for('detail_role', function ($trail, $role) {
    $trail->parent('roles');
    $trail->push('Detail', route('roles.show', ['role' => $role]));
    $trail->push($role->name, route('roles.show', ['role' => $role]));
});

//Dashboard > Roles > Edit > [title]

Breadcrumbs::for('edit_role', function ($trail, $role) {
    $trail->parent('roles');
    $trail->push('Edit', route('roles.edit', ['role' => $role]));
    $trail->push($role->name, route('roles.edit', ['role' => $role]));
});

//Dashboard > Users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('users.index'));
});

//Dashboard > Users >tambah user
Breadcrumbs::for('add_user', function ($trail) {
    $trail->parent('users');
    $trail->push('Tambah User', route('users.create'));
});

//Dashboard > Users > Edit > [title]

Breadcrumbs::for('edit_user', function ($trail, $user) {
    $trail->parent('users');
    $trail->push('Edit', route('users.edit', ['user' => $user]));
    $trail->push($user->name, route('users.edit', ['user' => $user]));
});


//Dashboard > Donatur
Breadcrumbs::for('donors', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Donatur', route('donors.index'));
});
