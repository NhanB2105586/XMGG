<?php
$router->get('/admin/contacts', '\App\Controllers\Admin\ManageContactController@index');
$router->post('/admin/contacts/mark-contacted', '\App\Controllers\Admin\ManageContactController@markAsContacted');
$router->post('/admin/contacts/delete', '\App\Controllers\Admin\ManageContactController@delete');
?> 
