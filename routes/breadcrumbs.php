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
    $trail->push($category->title, route('categories.edit',['category' => $category]));
});

//Dashboard > Categories > Detail
Breadcrumbs::for('detail_category', function ($trail, $category) {
    $trail->parent('categories');
    $trail->push('Detail', route('categories.show', ['category' => $category]));
});

//Dashboard > Categories > Detail Category > Title
Breadcrumbs::for('detail_category_title', function ($trail, $category) {
    $trail->parent('detail_category', $category);
    $trail->push($category->title, route('categories.show',['category' => $category]));
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
    $trail->push('Edit', route('tags.edit', ['tag'=>$tag] ));
    $trail->push($tag->title, route('tags.edit', ['tag'=>$tag] ));
});


//Dashboard > Posts
Breadcrumbs::for('posts', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Posts', route('posts.index'));
});