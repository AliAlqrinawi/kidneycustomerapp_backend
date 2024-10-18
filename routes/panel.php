<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\LoginController;
use App\Http\Controllers\Panel\HomeController;
use App\Http\Controllers\Panel\ProfileController;
use App\Http\Controllers\Panel\AdminsController;
use App\Http\Controllers\Panel\AiTestController;
use App\Http\Controllers\Panel\AppointmentsController;
use App\Http\Controllers\Panel\AreasController;
use App\Http\Controllers\Panel\SettingController;
use App\Http\Controllers\Panel\RolesController;
use App\Http\Controllers\Panel\PagesController;
use App\Http\Controllers\Panel\SectionTextsController;
use App\Http\Controllers\Panel\ConstantsController;
use App\Http\Controllers\Panel\InboxController;
use App\Http\Controllers\Panel\InstitutionsController;
use App\Http\Controllers\Panel\PostsController;
use App\Http\Controllers\Panel\ProductsController;
use App\Http\Controllers\Panel\ProviderController;
use App\Http\Controllers\Panel\UsersController;
use App\Http\Controllers\Panel\QuestionnaireFormsController;


//login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/admin-logout', [LoginController::class, 'loggedOut'])->name('logout');



Route::group(['middleware' => 'admin'], function () {

    //home
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/lang/{lang}', [HomeController::class, 'changeLang'])->name('home.changeLang');

    //profile
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/', [ProfileController::class, 'update'])->name('update');
        Route::post('/reset-password', [ProfileController::class, 'resetPassword'])->name('resetPassword');
    });

    //roles
    Route::group(['prefix' => 'roles', 'as' => 'roles.', 'middleware' => 'permission:show_roles,admin'], function () {
        Route::group(['prefix' => 'create', 'as' => 'create.'], function () {
            Route::get('/', [RolesController::class, 'create'])->name('index');
            Route::post('/', [RolesController::class, 'store'])->name('store');
        });
        Route::group(['prefix' => 'edit', 'as' => 'edit.'], function () {
            Route::get('/{id}', [RolesController::class, 'edit'])->name('index');
            Route::post('/{id}', [RolesController::class, 'update'])->name('update');
        });
        Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
            Route::get('/', [RolesController::class, 'index'])->name('index');
            Route::get('/data', [RolesController::class, 'getDataTable'])->name('data');
        });
        Route::delete('/{id}', [RolesController::class, 'delete'])->name('delete');
    });


    //admin
    Route::group(['prefix' => 'admins', 'as' => 'admins.', 'middleware' => 'permission:show_admins,admin'], function () {
        Route::group(['prefix' => 'create', 'as' => 'create.'], function () {
            Route::get('/', [AdminsController::class, 'create'])->name('index');
            Route::post('/', [AdminsController::class, 'store'])->name('store');
        });
        Route::group(['prefix' => 'edit', 'as' => 'edit.'], function () {
            Route::get('/{id}', [AdminsController::class, 'edit'])->name('index');
            Route::post('/{id}', [AdminsController::class, 'update'])->name('update');
        });
        Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
            Route::get('/', [AdminsController::class, 'index'])->name('index');
            Route::get('/data', [AdminsController::class, 'getDataTable'])->name('data');
        });
        Route::delete('/{id}', [AdminsController::class, 'delete'])->name('delete');
    });

    //settings
    Route::group(['prefix' => 'settings', 'as' => 'settings.', 'middleware' => 'permission:show_settings,admin'], function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::put('/', [SettingController::class, 'update'])->name('update');
    });


    //Pages
    Route::group(['prefix' => 'pages', 'as' => 'pages.', 'middleware' => 'permission:show_pages,admin'], function () {
        Route::group(['prefix' => 'create', 'as' => 'create.'], function () {
            Route::get('/', [PagesController::class, 'create'])->name('index');
            Route::post('/', [PagesController::class, 'store'])->name('store');
        });

        Route::group(['prefix' => 'edit', 'as' => 'edit.'], function () {
            Route::get('/{id}', [PagesController::class, 'edit'])->name('index');
            Route::post('/{id}', [PagesController::class, 'update'])->name('update');
        });

        Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
            Route::get('/', [PagesController::class, 'index'])->name('index');
            Route::get('/data', [PagesController::class, 'getDataTable'])->name('data');
        });

        Route::delete('/{id}', [PagesController::class, 'delete'])->name('delete');
    });


    //section texts
    Route::group(['prefix' => 'section-texts', 'as' => 'sectionTexts.'], function () {
        Route::group(['prefix' => 'edit', 'as' => 'edit.'], function () {
            Route::get('/{section}', [SectionTextsController::class, 'edit'])->name('index');
            Route::post('/{section}', [SectionTextsController::class, 'update'])->name('update');
        });
    });

    //constants
    Route::group(['prefix' => 'constants/{parent}', 'as' => 'constants.'], function () {
        Route::group(['prefix' => 'create', 'as' => 'create.'], function () {
            Route::get('/', [ConstantsController::class, 'create'])->name('index');
            Route::post('/', [ConstantsController::class, 'store'])->name('store');
        });

        Route::group(['prefix' => 'edit', 'as' => 'edit.'], function () {
            Route::get('/{id}', [ConstantsController::class, 'edit'])->name('index');
            Route::post('/{id}', [ConstantsController::class, 'update'])->name('update');
        });

        Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
            Route::get('/', [ConstantsController::class, 'index'])->name('index');
            Route::get('/data', [ConstantsController::class, 'getDataTable'])->name('data');
        });

        Route::delete('/{id}', [ConstantsController::class, 'delete'])->name('delete');
    });



    //inbox
    Route::group(['prefix' => 'inbox', 'as' => 'inbox.', 'middleware' => 'permission:show_inbox,admin'], function () {
        Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
            Route::get('/', [InboxController::class, 'index'])->name('index');
            Route::get('/data', [InboxController::class, 'getDataTable'])->name('data');
        });

        Route::group(['prefix' => 'view/{id}', 'as' => 'view.'], function () {
            Route::get('/', [InboxController::class, 'view'])->name('index');
            Route::post('/', [InboxController::class, 'replay'])->name('replay');
        });

        Route::delete('/{id}', [InboxController::class, 'delete'])->name('delete');
    });


    //posts
    Route::group(['prefix' => 'posts', 'as' => 'posts.', 'middleware' => 'permission:show_posts,admin'], function () {
        Route::group(['prefix' => 'create', 'as' => 'create.'], function () {
            Route::get('/', [PostsController::class, 'create'])->name('index');
            Route::post('/', [PostsController::class, 'store'])->name('store');
        });

        Route::group(['prefix' => 'edit', 'as' => 'edit.'], function () {
            Route::get('/{id}', [PostsController::class, 'edit'])->name('index');
            Route::post('/{id}', [PostsController::class, 'update'])->name('update');
        });

        Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
            Route::get('/', [PostsController::class, 'index'])->name('index');
            Route::get('/data', [PostsController::class, 'getDataTable'])->name('data');
        });

        Route::delete('/{id}', [PostsController::class, 'delete'])->name('delete');
    });

    //products
    Route::group(['prefix' => 'products', 'as' => 'products.', 'middleware' => 'permission:show_products,admin'], function () {
        Route::group(['prefix' => 'create', 'as' => 'create.'], function () {
            Route::get('/', [ProductsController::class, 'create'])->name('index');
            Route::post('/', [ProductsController::class, 'store'])->name('store');
        });

        Route::group(['prefix' => 'edit', 'as' => 'edit.'], function () {
            Route::get('/{id}', [ProductsController::class, 'edit'])->name('index');
            Route::post('/{id}', [ProductsController::class, 'update'])->name('update');
        });

        Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
            Route::get('/', [ProductsController::class, 'index'])->name('index');
            Route::get('/data', [ProductsController::class, 'getDataTable'])->name('data');
        });

        Route::delete('/{id}', [ProductsController::class, 'delete'])->name('delete');
    });


    //users
    Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'permission:show_users,admin'], function () {
        Route::group(['prefix' => 'create', 'as' => 'create.'], function () {
            Route::get('/', [UsersController::class, 'create'])->name('index');
            Route::post('/', [UsersController::class, 'store'])->name('store');
        });
        Route::group(['prefix' => 'edit', 'as' => 'edit.'], function () {
            Route::get('/{id}', [UsersController::class, 'edit'])->name('index');
            Route::post('/{id}', [UsersController::class, 'update'])->name('update');
        });
        Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
            Route::get('/', [UsersController::class, 'index'])->name('index');
            Route::get('/data', [UsersController::class, 'getDataTable'])->name('data');
        });
        Route::delete('/{id}', [UsersController::class, 'delete'])->name('delete');
    });

    //questionnaireForms
    Route::group([
        'prefix' => 'questionnaire-forms',
        'as' => 'questionnaireForms.',
        'middleware' => 'permission:show_questionnaire_forms,admin'
    ], function () {
        Route::group(['prefix' => 'create', 'as' => 'create.'], function () {
            Route::get('/', [QuestionnaireFormsController::class, 'create'])->name('index');
            Route::post('/', [QuestionnaireFormsController::class, 'store'])->name('store');
        });
        Route::group(['prefix' => 'edit', 'as' => 'edit.'], function () {
            Route::get('/{id}', [QuestionnaireFormsController::class, 'edit'])->name('index');
            Route::post('/{id}', [QuestionnaireFormsController::class, 'update'])->name('update');
        });
        Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
            Route::get('/', [QuestionnaireFormsController::class, 'index'])->name('index');
            Route::get('/data', [QuestionnaireFormsController::class, 'getDataTable'])->name('data');
        });
        Route::delete('/{id}', [QuestionnaireFormsController::class, 'delete'])->name('delete');

        Route::get('/render-filds', [QuestionnaireFormsController::class, 'renderFilds'])->name('render.filds');
        Route::get('/render-option', [QuestionnaireFormsController::class, 'renderOption'])->name('render.option');
    });

    //institutions
    Route::group(['prefix' => 'institutions', 'as' => 'institutions.', 'middleware' => 'permission:show_institutions,admin'], function () {
        Route::group(['prefix' => 'create', 'as' => 'create.'], function () {
            Route::get('/', [InstitutionsController::class, 'create'])->name('index');
            Route::post('/', [InstitutionsController::class, 'store'])->name('store');
        });
        Route::group(['prefix' => 'edit', 'as' => 'edit.'], function () {
            Route::get('/{id}', [InstitutionsController::class, 'edit'])->name('index');
            Route::post('/{id}', [InstitutionsController::class, 'update'])->name('update');
        });
        Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
            Route::get('/', [InstitutionsController::class, 'index'])->name('index');
            Route::get('/data', [InstitutionsController::class, 'getDataTable'])->name('data');
        });
        Route::delete('/{id}', [InstitutionsController::class, 'delete'])->name('delete');
    });


    //areas
    Route::group(['prefix' => 'areas', 'as' => 'areas.', 'middleware' => 'permission:show_areas,admin'], function () {
        Route::group(['prefix' => 'create', 'as' => 'create.'], function () {
            Route::get('/', [AreasController::class, 'create'])->name('index');
            Route::post('/', [AreasController::class, 'store'])->name('store');
        });
        Route::group(['prefix' => 'edit', 'as' => 'edit.'], function () {
            Route::get('/{id}', [AreasController::class, 'edit'])->name('index');
            Route::post('/{id}', [AreasController::class, 'update'])->name('update');
        });
        Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
            Route::get('/', [AreasController::class, 'index'])->name('index');
            Route::get('/data', [AreasController::class, 'getDataTable'])->name('data');
        });
        Route::delete('/{id}', [AreasController::class, 'delete'])->name('delete');
    });

    //providers
    Route::group(['prefix' => 'providers', 'as' => 'providers.', 'middleware' => 'permission:show_providers,admin'], function () {
        Route::group(['prefix' => 'create', 'as' => 'create.'], function () {
            Route::get('/', [ProviderController::class, 'create'])->name('index');
            Route::post('/', [ProviderController::class, 'store'])->name('store');
        });
        Route::group(['prefix' => 'edit', 'as' => 'edit.'], function () {
            Route::get('/{id}', [ProviderController::class, 'edit'])->name('index');
            Route::post('/{id}', [ProviderController::class, 'update'])->name('update');
        });
        Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
            Route::get('/', [ProviderController::class, 'index'])->name('index');
            Route::get('/data', [ProviderController::class, 'getDataTable'])->name('data');
        });
        Route::delete('/{id}', [ProviderController::class, 'delete'])->name('delete');
    });

    //aiTest
    Route::group(['prefix' => 'aiTest', 'as' => 'aiTest.', 'middleware' => 'permission:show_aiTests,admin'], function () {
        Route::group(['prefix' => 'show', 'as' => 'show.'], function () {
            Route::get('/{id}', [AiTestController::class, 'show'])->name('index');
            Route::get('/data/{id}', [AiTestController::class, 'getDataTable'])->name('data');
        });
    });

    //appointments
    Route::group(['prefix' => 'appointments', 'as' => 'appointments.', 'middleware' => 'permission:show_appointments,admin'], function () {
        Route::group(['prefix' => 'create', 'as' => 'create.'], function () {
            Route::post('/', [AppointmentsController::class, 'store'])->name('store');
        });
    });
});

//
