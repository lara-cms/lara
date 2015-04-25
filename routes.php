<?php
//
//'middleware' => 'LaraCmsLara',
Route::group(['prefix' => config('lara-cms.lara.master.prefix')], function()
{
    $controllers = config('lara-cms.lara.master.controllers');

    if (is_array( $controllers ))
    {

        foreach ($controllers as $key=>$val)
        {    
            Route::controller($key, $val);
        }
  
    }

});


