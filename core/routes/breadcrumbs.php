<?php

Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Beranda', route('admin.home'));
});

Breadcrumbs::register('user', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('User', route('user'));
});
Breadcrumbs::register('user.new', function($breadcrumbs)
{
    $breadcrumbs->parent('user');
    $breadcrumbs->push('New', route('user.new'));
});
Breadcrumbs::register('user.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('user');
    $breadcrumbs->push('Edit', route('user.edit', $data->id));
});

Breadcrumbs::register('slider', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Slider', route('slider'));
});
Breadcrumbs::register('slider.new', function($breadcrumbs)
{
    $breadcrumbs->parent('slider');
    $breadcrumbs->push('New', route('slider.new'));
});
Breadcrumbs::register('slider.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('slider');
    $breadcrumbs->push('Edit', route('slider.edit', $data->id));
});

Breadcrumbs::register('contact', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Contact', route('contact'));
});
Breadcrumbs::register('contact.new', function($breadcrumbs)
{
    $breadcrumbs->parent('contact');
    $breadcrumbs->push('New', route('contact.new'));
});
Breadcrumbs::register('contact.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('contact');
    $breadcrumbs->push('Edit', route('contact.edit', $data->id));
});
Breadcrumbs::register('contact.show', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('contact');
    $breadcrumbs->push('Details', route('contact.show', $data->id));
});

Breadcrumbs::register('article', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Article', route('article'));
});
Breadcrumbs::register('article.new', function($breadcrumbs)
{
    $breadcrumbs->parent('article');
    $breadcrumbs->push('New', route('article.new'));
});
Breadcrumbs::register('article.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('article');
    $breadcrumbs->push('Edit', route('article.edit', $data->id));
});
Breadcrumbs::register('article.show', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('article');
    $breadcrumbs->push('Details', route('article.show', $data->id));
});

Breadcrumbs::register('event', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Event', route('event'));
});
Breadcrumbs::register('event.new', function($breadcrumbs)
{
    $breadcrumbs->parent('event');
    $breadcrumbs->push('New', route('event.new'));
});
Breadcrumbs::register('event.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('event');
    $breadcrumbs->push('Edit', route('event.edit', $data->id));
});
Breadcrumbs::register('event.show', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('event');
    $breadcrumbs->push('Details', route('event.show', $data->id));
});

Breadcrumbs::register('drinks', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Drinks', route('drinks'));
});
Breadcrumbs::register('drinks.new', function($breadcrumbs)
{
    $breadcrumbs->parent('drinks');
    $breadcrumbs->push('New', route('drinks.new'));
});
Breadcrumbs::register('drinks.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('drinks');
    $breadcrumbs->push('Edit', route('drinks.edit', $data->id));
});
Breadcrumbs::register('drinks.show', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('drinks');
    $breadcrumbs->push('Details', route('drinks.show', $data->id));
});

Breadcrumbs::register('about', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('About', route('about'));
});
Breadcrumbs::register('about.new', function($breadcrumbs)
{
    $breadcrumbs->parent('about');
    $breadcrumbs->push('New', route('about.new'));
});
Breadcrumbs::register('about.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('about');
    $breadcrumbs->push('Edit', route('about.edit', $data->id));
});
Breadcrumbs::register('about.show', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('about');
    $breadcrumbs->push('Details', route('about.show', $data->id));
});

Breadcrumbs::register('menus', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Menus', route('menus'));
});
Breadcrumbs::register('menus.new', function($breadcrumbs)
{
    $breadcrumbs->parent('menus');
    $breadcrumbs->push('New', route('menus.new'));
});
Breadcrumbs::register('menus.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('menus');
    $breadcrumbs->push('Edit', route('menus.edit', $data->id));
});
Breadcrumbs::register('menus.show', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('menus');
    $breadcrumbs->push('Details', route('menus.show', $data->id));
});

Breadcrumbs::register('main-dishes', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Main Dishes', route('main-dishes'));
});
Breadcrumbs::register('main-dishes.new', function($breadcrumbs)
{
    $breadcrumbs->parent('main-dishes');
    $breadcrumbs->push('New', route('main-dishes.new'));
});
Breadcrumbs::register('main-dishes.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('main-dishes');
    $breadcrumbs->push('Edit', route('main-dishes.edit', $data->id));
});
Breadcrumbs::register('main-dishes.show', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('main-dishes');
    $breadcrumbs->push('Details', route('main-dishes.show', $data->id));
});

Breadcrumbs::register('appetizer', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Appetizer', route('appetizer'));
});
Breadcrumbs::register('appetizer.new', function($breadcrumbs)
{
    $breadcrumbs->parent('appetizer');
    $breadcrumbs->push('New', route('appetizer.new'));
});
Breadcrumbs::register('appetizer.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('appetizer');
    $breadcrumbs->push('Edit', route('appetizer.edit', $data->id));
});
Breadcrumbs::register('appetizer.show', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('appetizer');
    $breadcrumbs->push('Details', route('appetizer.show', $data->id));
});

Breadcrumbs::register('desserts', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Desserts', route('desserts'));
});
Breadcrumbs::register('desserts.new', function($breadcrumbs)
{
    $breadcrumbs->parent('desserts');
    $breadcrumbs->push('New', route('desserts.new'));
});
Breadcrumbs::register('desserts.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('desserts');
    $breadcrumbs->push('Edit', route('desserts.edit', $data->id));
});
Breadcrumbs::register('desserts.show', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('desserts');
    $breadcrumbs->push('Details', route('desserts.show', $data->id));
});

Breadcrumbs::register('facility', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Facility', route('facility'));
});
Breadcrumbs::register('facility.new', function($breadcrumbs)
{
    $breadcrumbs->parent('facility');
    $breadcrumbs->push('New', route('facility.new'));
});
Breadcrumbs::register('facility.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('facility');
    $breadcrumbs->push('Edit', route('facility.edit', $data->id));
});

Breadcrumbs::register('news_event', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('News Event', route('news_event'));
});
Breadcrumbs::register('news_event.new', function($breadcrumbs)
{
    $breadcrumbs->parent('news_event');
    $breadcrumbs->push('New', route('news_event.new'));
});
Breadcrumbs::register('news_event.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('news_event');
    $breadcrumbs->push('Edit', route('news_event.edit', $data->id));
});
Breadcrumbs::register('news_event.show', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('news_event');
    $breadcrumbs->push('Details', route('news_event.show', $data->id));
});

Breadcrumbs::register('gallery', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Gallery', route('gallery'));
});
Breadcrumbs::register('gallery.new', function($breadcrumbs)
{
    $breadcrumbs->parent('gallery');
    $breadcrumbs->push('New', route('gallery.new'));
});
Breadcrumbs::register('gallery.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('gallery');
    $breadcrumbs->push('Edit', route('gallery.edit', $data->id));
});

Breadcrumbs::register('building', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Building', route('building'));
});
Breadcrumbs::register('building.new', function($breadcrumbs)
{
    $breadcrumbs->parent('building');
    $breadcrumbs->push('New', route('building.new'));
});
Breadcrumbs::register('building.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('building');
    $breadcrumbs->push('Edit', route('building.edit', $data->id));
});

Breadcrumbs::register('location', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Location', route('location'));
});
Breadcrumbs::register('location.new', function($breadcrumbs)
{
    $breadcrumbs->parent('location');
    $breadcrumbs->push('New', route('location.new'));
});
Breadcrumbs::register('location.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('location');
    $breadcrumbs->push('Edit', route('location.edit', $data->id));
});

Breadcrumbs::register('floorplan', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Floorplan', route('floorplan'));
});
Breadcrumbs::register('floorplan.new', function($breadcrumbs)
{
    $breadcrumbs->parent('floorplan');
    $breadcrumbs->push('New', route('floorplan.new'));
});
Breadcrumbs::register('floorplan.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('floorplan');
    $breadcrumbs->push('Edit', route('floorplan.edit', $data->id));
});

Breadcrumbs::register('career', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Career', route('career'));
});
Breadcrumbs::register('career.new', function($breadcrumbs)
{
    $breadcrumbs->parent('career');
    $breadcrumbs->push('New', route('career.new'));
});
Breadcrumbs::register('career.edit', function($breadcrumbs, $data)
{
    $breadcrumbs->parent('career');
    $breadcrumbs->push('Edit', route('career.edit', $data->id));
});
